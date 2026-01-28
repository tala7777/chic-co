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
    public $name, $description, $price, $discount_percentage = 0, $category_id, $image, $product_id, $aesthetic, $stock = 10, $status = 'active', $is_featured = false;
    public $colors = [];
    public $color_stock = [];

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
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'stock' => 'nullable|integer|min:0',
            'color_stock.*' => 'nullable|integer|min:0',
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
        $this->discount_percentage = $product->discount_percentage;
        $this->category_id = $product->category_id;
        $this->aesthetic = $product->aesthetic;
        $this->image = $product->image;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->is_featured = $product->is_featured;
        $this->colors = $product->colors ?? [];
        $this->color_stock = $product->color_stock ?? [];
        $this->selectedProduct = $product;

        $this->isEditMode = true;
        $this->showProductSidebar = true;
    }

    public function updatedColors()
    {
        // Ensure color_stock only contains valid selected colors
        // But preserve existing quantities for colors that are still selected
        $newColorStock = [];
        foreach ($this->colors as $color) {
            $newColorStock[$color] = $this->color_stock[$color] ?? 1; // Default to 1 for new selections
        }
        $this->color_stock = $newColorStock;
        $this->syncTotalStock();
    }

    public function updatedColorStock($value, $key)
    {
        // Key might be like '#000000'
        $this->syncTotalStock();
    }

    private function syncTotalStock()
    {
        if (!empty($this->colors)) {
            $this->stock = array_sum($this->color_stock);
        }
    }

    public function save()
    {
        $rules = [
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'aesthetic' => 'required|in:soft,alt,luxury,mix',
            'stock' => 'required|integer|min:0',
            'colors' => 'nullable|array',
            'color_stock' => 'nullable|array',
        ];

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'discount_percentage' => $this->discount_percentage ?: 0,
            'category_id' => $this->category_id ?: null,
            'aesthetic' => $this->aesthetic,
            'image' => $this->image ?? 'https://via.placeholder.com/300',
            'stock' => $this->stock,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
            'colors' => $this->colors,
            'color_stock' => $this->color_stock,
        ];

        // Ensure total stock equals sum of color quantities if colors are defined
        if (!empty($this->colors)) {
            $data['stock'] = array_sum($this->color_stock);
        }

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
        $this->reset(['name', 'description', 'price', 'discount_percentage', 'category_id', 'aesthetic', 'image', 'stock', 'status', 'is_featured', 'product_id', 'selectedProduct', 'colors', 'color_stock']);
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
