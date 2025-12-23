<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // or any fake data
            'description' => $this->faker->sentence(),
            'is_active' => $this->faker->boolean(80), // 80% chance to be true
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }

    // public function electronics()
    // {
    //     return $this->state([
    //         'name' => 'Electronics',
    //         'description' => 'Electronic devices and gadgets',
    //     ]);
    // }
    
    // public function clothing()
    // {
    //     return $this->state([
    //         'name' => 'Clothing',
    //         'description' => 'Fashion and apparel',
    //     ]);
    // }
}
