<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
        public $search = '';
    public $selectedCategory = '';
    public $categories = ['guitar', 'drum', 'keyboard', 'amplifier', 'accessories', 'other'];
    public $products = [];

    public function mount()
    {
        $this->products = Product::all();

                $productsQuery = Product::query();

        if ($this->search) {
            $productsQuery->where('name', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%");
        }

        if ($this->selectedCategory) {
            $productsQuery->where('category', $this->selectedCategory);
        }

        $this->products = $productsQuery->get();

    }

    public function render()
    {
        return view('livewire.home');
    }
}
