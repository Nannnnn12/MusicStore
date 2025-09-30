<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $selectedBrand = '';
    public $minPrice = '';
    public $maxPrice = '';
    public $stockStatus = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';

    public $categories = ['guitar', 'drum', 'keyboard', 'amplifier', 'accessories', 'other'];
    public $brands = [];

    // Remove button properties as they are not used in the blade now
    // public $selectedCategoryButton = 'all';
    // public $selectedBrandButton = 'all';
    // public $selectedStockStatusButton = 'all';
    // public $selectedSortByButton = 'name';
    // public $selectedSortDirectionButton = 'asc';

    public function mount()
    {
        $this->loadBrands();
    }

    public function loadBrands()
    {
        $this->brands = Product::distinct()->pluck('brand')->filter()->values()->toArray();
    }

    public function getProducts()
    {
        $productsQuery = Product::query()
            ->active()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                      ->orWhere('description', 'like', "%{$this->search}%")
                      ->orWhere('brand', 'like', "%{$this->search}%");
                });
            })
            ->when($this->selectedCategory !== '', function ($query) {
                $query->where('category', $this->selectedCategory);
            })
            ->when($this->selectedBrand !== '', function ($query) {
                $query->where('brand', $this->selectedBrand);
            })
            ->when($this->minPrice, function ($query) {
                $query->where('price', '>=', $this->minPrice);
            })
            ->when($this->maxPrice, function ($query) {
                $query->where('price', '<=', $this->maxPrice);
            })
            ->when($this->stockStatus !== '', function ($query) {
                if ($this->stockStatus === 'in_stock') {
                    $query->where('stock_quantity', '>', 0);
                } elseif ($this->stockStatus === 'out_of_stock') {
                    $query->where('stock_quantity', '=', 0);
                } elseif ($this->stockStatus === 'low_stock') {
                    $query->whereBetween('stock_quantity', [1, 10]);
                }
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        return $productsQuery->paginate(12);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatedSelectedBrand()
    {
        $this->resetPage();
    }

    public function updatedMinPrice()
    {
        $this->resetPage();
    }

    public function updatedMaxPrice()
    {
        $this->resetPage();
    }

    public function updatedStockStatus()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        // No need to do anything, render will handle it
    }

    public function updatedSortDirection()
    {
        // No need to do anything, render will handle it
    }


    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->selectedBrand = '';
        $this->minPrice = '';
        $this->maxPrice = '';
        $this->stockStatus = '';
        $this->sortBy = 'name';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->getProducts()
        ]);
    }
}
