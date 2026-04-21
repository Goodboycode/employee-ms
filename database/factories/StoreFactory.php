<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Store_name' => $this->faker->randomElement(['NovaMart', 'GreenLeaf Store', 'Urban Basket', 'BrightBuy Shop', 'QuickPick Market', 'Sunrise Goods', 'PrimeChoice Store', 'BlueCart Mart', 'Everyday Essentials', 'Metro Supply Hub']),
            'address' => $this->faker->city(),
        ];
    }
}
