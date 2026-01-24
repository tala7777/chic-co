<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users except admin
        $users = User::where('role', '!=', 'admin')->get();

        // If no regular users exist, create some
        if ($users->isEmpty()) {
            $users = User::factory()->count(5)->create();
        }

        // Create 20 orders
        foreach ($users->random(min(5, $users->count())) as $user) {
            // Each user gets 2-4 orders
            $orderCount = rand(2, 4);

            for ($i = 0; $i < $orderCount; $i++) {
                $order = Order::factory()->create([
                    'user_id' => $user->id,
                ]);

                // Add 1-5 items to each order
                $products = Product::inRandomOrder()->limit(rand(1, 5))->get();

                foreach ($products as $product) {
                    $quantity = rand(1, 3);
                    $order->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ]);
                }

                // Update order total and ensure some are paid
                $total = $order->items->sum(function ($item) {
                    return $item->price * $item->quantity;
                });

                $order->update([
                    'total_amount' => $total,
                    'payment_status' => rand(1, 10) > 3 ? 'paid' : 'unpaid'
                ]);
            }
        }
    }
}
