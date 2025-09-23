<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create guitars
        Product::factory()->count(5)->guitar()->active()->create();

        // Create drums
        Product::factory()->count(3)->drum()->active()->create();

        // Create keyboards
        Product::factory()->count(4)->keyboard()->active()->create();

        // Create amplifiers
        Product::factory()->count(3)->amplifier()->active()->create();

        // Create accessories
        Product::factory()->count(10)->accessory()->active()->create();

        // Create some out of stock items
        Product::factory()->count(2)->outOfStock()->active()->create();

        // Create some inactive products
        Product::factory()->count(3)->create(['is_active' => false]);

        // Create some general products
        Product::factory()->count(5)->create();
    }
}
