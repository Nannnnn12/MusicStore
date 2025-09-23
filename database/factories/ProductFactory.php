<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['guitar', 'drum', 'keyboard', 'amplifier', 'accessories', 'other'];
        $brands = ['Yamaha', 'Fender', 'Gibson', 'Roland', 'Korg', 'Marshall', 'Ibanez', 'Pearl'];
        $category = fake()->randomElement($categories);

        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'sku' => strtoupper(fake()->unique()->bothify('???-#####')),
            'price' => fake()->numberBetween(500000, 50000000),
            'stock_quantity' => fake()->numberBetween(0, 100),
            'category' => $category,
            'brand' => fake()->randomElement($brands),
            'image' => null,
            'is_active' => fake()->boolean(90), // 90% chance of being active
        ];
    }

    /**
     * Indicate that the product is a guitar.
     */
    public function guitar(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'guitar',
            'name' => fake()->randomElement([
                'Electric Guitar Standard',
                'Acoustic Guitar Classic',
                'Bass Guitar Pro',
                'Classical Guitar Premium',
                'Electric Guitar Deluxe'
            ]),
            'brand' => fake()->randomElement(['Fender', 'Gibson', 'Ibanez', 'Yamaha']),
            'price' => fake()->numberBetween(2000000, 15000000),
        ]);
    }

    /**
     * Indicate that the product is a drum set.
     */
    public function drum(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'drum',
            'name' => fake()->randomElement([
                'Drum Set Standard 5-Piece',
                'Electronic Drum Kit',
                'Drum Set Professional',
                'Junior Drum Set'
            ]),
            'brand' => fake()->randomElement(['Pearl', 'Yamaha', 'Roland', 'Tama']),
            'price' => fake()->numberBetween(3000000, 25000000),
        ]);
    }

    /**
     * Indicate that the product is a keyboard.
     */
    public function keyboard(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'keyboard',
            'name' => fake()->randomElement([
                'Digital Piano 88 Keys',
                'Synthesizer Pro',
                'Keyboard Workstation',
                'Portable Keyboard'
            ]),
            'brand' => fake()->randomElement(['Yamaha', 'Korg', 'Roland', 'Casio']),
            'price' => fake()->numberBetween(2000000, 20000000),
        ]);
    }

    /**
     * Indicate that the product is an amplifier.
     */
    public function amplifier(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'amplifier',
            'name' => fake()->randomElement([
                'Guitar Amplifier 50W',
                'Bass Amplifier 200W',
                'Keyboard Amplifier',
                'Portable Amplifier'
            ]),
            'brand' => fake()->randomElement(['Marshall', 'Fender', 'Roland', 'Line 6']),
            'price' => fake()->numberBetween(1500000, 10000000),
        ]);
    }

    /**
     * Indicate that the product is an accessory.
     */
    public function accessory(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'accessories',
            'name' => fake()->randomElement([
                'Guitar Strings Set',
                'Drum Sticks Pair',
                'Guitar Strap',
                'Microphone Stand',
                'Cable 3m',
                'Guitar Pick Set',
                'Headphones Studio'
            ]),
            'brand' => fake()->randomElement(['DAddario', 'Ernie Ball', 'Planet Waves', 'Shure']),
            'price' => fake()->numberBetween(50000, 1000000),
        ]);
    }

    /**
     * Indicate that the product is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the product is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock_quantity' => 0,
        ]);
    }
}
