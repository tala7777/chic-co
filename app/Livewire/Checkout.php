<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\UserAddress;
use App\Models\UserPaymentMethod;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\UserBehavior;
use App\Models\LoyaltyPoint;
use App\Models\ScheduledCommunication;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Checkout extends Component
{
    public $cart = [];
    public $total = 0;

    // Saved Data
    public $savedAddresses = [];
    public $selectedAddressId = 'new';
    public $savedPaymentMethods = [];
    public $selectedPaymentMethodId = 'new';

    // Form fields for New Address
    public $email;
    public $firstName;
    public $lastName;
    public $area;
    public $streetAddress;
    public $buildingNo;
    public $apartmentNo;
    public $phone;
    public $city = 'Amman';
    public $zip;

    // Form fields for New Payment
    public $paymentMethod = 'card'; // card, cod
    public $cardName;
    public $cardNumber;
    public $cardExpiry;
    public $cardCvc;

    protected function rules()
    {
        $rules = [
            'email' => 'required|email',
            'firstName' => ['required', 'regex:/^[a-zA-Z\s]{2,50}$/'],
            'lastName' => ['required', 'regex:/^[a-zA-Z\s]{2,50}$/'],
        ];

        if ($this->selectedAddressId === 'new') {
            $rules = array_merge($rules, [
                'area' => 'required',
                'streetAddress' => 'required',
                'phone' => ['required', 'regex:/^(07[789]\d{7})$/'],
            ]);
        }

        if ($this->paymentMethod === 'card' && $this->selectedPaymentMethodId === 'new') {
            $rules = array_merge($rules, [
                'cardName' => ['required', 'regex:/^[a-zA-Z\s]{2,50}$/'],
                'cardNumber' => ['required', 'regex:/^\d{16}$/'],
                'cardExpiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
                'cardCvc' => ['required', 'regex:/^\d{3}$/'],
            ]);
        }

        return $rules;
    }

    protected $messages = [
        'firstName.regex' => 'First name should only contain letters.',
        'lastName.regex' => 'Last name should only contain letters.',
        'phone.regex' => 'Phone number must be a valid Jordanian mobile (e.g., 079XXXXXXX).',
        'cardName.regex' => 'Cardholder name should only contain letters.',
        'cardNumber.regex' => 'Card number must be exactly 16 digits.',
        'cardExpiry.regex' => 'Expiry must be in MM/YY format.',
        'cardCvc.regex' => 'CVV must be exactly 3 digits.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $cartService = new \App\Services\CartService();
        $items = $cartService->getItems();

        $this->cart = $items->map(function ($item) {
            return [
                'id' => $item->product_id,
                'name' => $item->product->name,
                'image' => $item->product->image ?? ($item->product->images->first()?->url ?? asset('images/placeholder.jpg')),
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'color' => $item->color
            ];
        })->toArray();

        $this->calculateTotal();

        if (auth()->check()) {
            $user = auth()->user();
            $this->email = $user->email;
            $nameParts = explode(' ', trim($user->name));
            $this->firstName = $nameParts[0] ?? '';
            $this->lastName = count($nameParts) > 1 ? end($nameParts) : '';

            $this->savedAddresses = UserAddress::where('user_id', $user->id)->get();
            $defaultAddr = $this->savedAddresses->where('is_default', true)->first();
            if ($defaultAddr) {
                $this->selectedAddressId = $defaultAddr->id;
            } elseif ($this->savedAddresses->count() > 0) {
                $this->selectedAddressId = $this->savedAddresses->first()->id;
            }

            $this->savedPaymentMethods = UserPaymentMethod::where('user_id', $user->id)->get();
            $defaultPay = $this->savedPaymentMethods->where('is_default', true)->first();
            if ($defaultPay) {
                $this->selectedPaymentMethodId = $defaultPay->id;
                $this->paymentMethod = 'card';
            } elseif ($this->savedPaymentMethods->count() > 0) {
                $this->selectedPaymentMethodId = $this->savedPaymentMethods->first()->id;
                $this->paymentMethod = 'card';
            }
        }
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->cart as $item) {
            $this->total += ((float) ($item['price'] ?? 0)) * ($item['quantity'] ?? 1);
        }
    }

    public function selectAddress($id)
    {
        $this->selectedAddressId = $id;
    }

    public function selectPaymentMethod($id)
    {
        $this->selectedPaymentMethodId = $id;
        $this->paymentMethod = 'card';
    }

    public function placeOrder()
    {
        $this->validate();

        $user = auth()->user();
        $isGuest = !$user;

        // 1. Refresh cart from service one last time
        $cartService = new \App\Services\CartService();
        $this->mount(); // Refresh internal cart state

        if (empty($this->cart)) {
            $this->dispatch('swal:error', ['title' => 'Empty Bag', 'text' => 'Your selection has vanished. Please re-curate.']);
            return;
        }

        // 2. Handle Addresses if logged in
        if ($user && $this->selectedAddressId === 'new') {
            UserAddress::create([
                'user_id' => $user->id,
                'area' => $this->area,
                'street_address' => $this->streetAddress,
                'building_no' => $this->buildingNo,
                'apartment_no' => $this->apartmentNo,
                'phone' => $this->phone,
                'is_default' => UserAddress::where('user_id', $user->id)->count() === 0,
            ]);
        }

        // 3. Handle Payment Method if logged in
        if ($user && $this->paymentMethod === 'card' && $this->selectedPaymentMethodId === 'new') {
            UserPaymentMethod::create([
                'user_id' => $user->id,
                'type' => 'card',
                'provider' => 'Visa',
                'last_four' => substr($this->cardNumber, -4),
                'expiry' => $this->cardExpiry,
                'is_default' => UserPaymentMethod::where('user_id', $user->id)->count() === 0,
            ]);
        }

        // Pre-order stock check
        foreach ($this->cart as $item) {
            $product = Product::find($item['id']);
            if (!$product || $product->stock < $item['quantity']) {
                $this->dispatch('swal:error', [
                    'title' => 'Stock Insufficient',
                    'text' => 'Some items in your cart (' . ($product->name ?? 'Unknown') . ') have just been acquired by other clients.',
                    'icon' => 'error'
                ]);
                return;
            }
        }

        // 3. Create Order
        $order = Order::create([
            'user_id' => $isGuest ? null : $user->id,
            'order_number' => 'CHIC-' . strtoupper(Str::random(8)),
            'total_amount' => $this->total,
            'status' => 'pending',
            'payment_status' => $this->paymentMethod === 'card' ? 'paid' : 'pending',
            'payment_method' => $this->paymentMethod,
            'shipping_address' => $user ? ($this->selectedAddressId !== 'new' ? UserAddress::find($this->selectedAddressId)->street_address : $this->streetAddress) : $this->streetAddress,
            'tracking_number' => 'TRK-' . strtoupper(Str::random(10)),
        ]);

        // 4. Create Order Items & Update Product Stats
        $purchasedAesthetics = [];
        foreach ($this->cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'size' => $item['size'] ?? null,
                'color' => $item['color'] ?? null,
            ]);

            $product = Product::find($item['id']);
            if ($product) {
                $product->increment('discover_score', 50);
                $product->increment('recent_purchases', 1);
                $product->decrement('stock', $item['quantity']);

                if ($product->aesthetic) {
                    $purchasedAesthetics[] = $product->aesthetic;
                }

                if (!$isGuest) {
                    UserBehavior::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'action' => 'purchase',
                        'metadata' => ['order_id' => $order->id]
                    ]);
                }
            }
        }

        // 5. Update User Profile & Loyalty
        if (!$isGuest) {
            $user->update([
                'total_spent' => $user->total_spent + $this->total,
                'last_purchase_at' => now(),
                'preferred_aesthetics' => array_unique(array_merge($user->preferred_aesthetics ?? [], $purchasedAesthetics)),
            ]);

            LoyaltyPoint::create([
                'user_id' => $user->id,
                'points' => intval($this->total),
                'source' => 'purchase',
                'order_id' => $order->id,
                'expires_at' => now()->addYear(),
            ]);

            // Schedule Delivery Update
            ScheduledCommunication::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'type' => 'delivery_update',
                'scheduled_at' => now()->addDay(),
            ]);
        }

        // 6. Send Email Confirmation
        try {
            Mail::to($this->email)->send(new OrderConfirmation($order));
        } catch (\Exception $e) {
            // Log error but don't stop the flow
            \Log::error("Mail failed: " . $e->getMessage());
        }

        // 7. Finalize
        $cartService->clear();
        $this->dispatch('cart-updated');

        return redirect()->route('checkout.success', ['order' => $order->id]);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
