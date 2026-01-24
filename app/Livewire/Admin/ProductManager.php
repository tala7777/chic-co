<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
#[Title('Gallery Management')]
class ProductManager extends Component
{
    use WithPagination;

    // Search and Filters
    #[Url(as: 'search')]
    public $search = '';

    #[Url(as: 'category')]
    public $categoryFilter = '';

    #[Url(as: 'aesthetic')]
    public $aestheticFilter = '';

    #[Url(as: 'status')]
    public $statusFilter = '';

    // Form/Details
    public $name, $description, $price, $category_id, $image, $product_id, $aesthetic, $stock = 10, $status = 'active', $is_featured = false;
    public $colors = []; // Added colors property

    public $isEditMode = false;
    public $showProductSidebar = false;
    public $selectedProduct = null;

    // Sorting
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Selection
    public $selectAll = false;
    public $selectedRows = [];

    protected $paginationTheme = 'bootstrap';

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'nullable|min:3',
            'price' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'stock' => 'nullable|integer|min:0',
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedCategoryFilter()
    {
        $this->resetPage();
    }
    public function updatedAestheticFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = Product::pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function resetFilters()
    {
        $this->reset(['search', 'categoryFilter', 'aestheticFilter', 'statusFilter']);
        $this->resetPage();
    }

    public function openCreate()
    {
        $this->resetInputFields();
        $this->isEditMode = false;
        $this->showProductSidebar = true;
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->aesthetic = $product->aesthetic;
        $this->image = $product->image;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->is_featured = $product->is_featured;
        $this->colors = $product->colors ?? [];
        $this->selectedProduct = $product;

        $this->isEditMode = true;
        $this->showProductSidebar = true;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'aesthetic' => 'required|in:soft,alt,luxury,mix',
            'stock' => 'required|integer|min:0',
            'colors' => 'nullable|array',
        ];

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id ?: null,
            'aesthetic' => $this->aesthetic,
            'image' => $this->image ?? 'https://via.placeholder.com/300',
            'stock' => $this->stock,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
            'colors' => $this->colors,
        ];

        if ($this->isEditMode) {
            Product::find($this->product_id)->update($data);
            $message = 'Piece updated.';
        } else {
            Product::create($data);
            $message = 'New piece added to gallery.';
        }

        $this->showProductSidebar = false;
        $this->dispatch('swal:success', ['title' => 'Success', 'text' => $message, 'icon' => 'success']);
    }

    public function deleteProduct($id)
    {
        Product::find($id)->delete();
        $this->dispatch('swal:success', ['title' => 'Removed', 'text' => 'Piece deleted.', 'icon' => 'success']);
    }

    public function bulkDelete()
    {
        Product::whereIn('id', $this->selectedRows)->delete();
        $this->selectedRows = [];
        $this->selectAll = false;
        $this->dispatch('swal:success', ['title' => 'Bulk Action', 'text' => 'Selected pieces removed.', 'icon' => 'success']);
    }

    private function resetInputFields()
    {
        $this->reset(['name', 'description', 'price', 'category_id', 'aesthetic', 'image', 'stock', 'status', 'is_featured', 'product_id', 'selectedProduct', 'colors']);
    }

    public function render()
    {
        $query = Product::with('category');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        if ($this->aestheticFilter) {
            $query->where('aesthetic', $this->aestheticFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $products = $query->orderBy($this->sortField, $this->sortDirection)->paginate(10);

        $stats = [
            'total' => Product::count(),
            'stock' => Product::sum('stock'),
            'featured' => Product::where('is_featured', true)->count(),
        ];

        return view('livewire.admin.product-manager', [
            'products' => $products,
            'categories' => Category::all(),
            'stats' => $stats
        ]);
    }
}
