<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'position' => $this->faker->randomElement(['Store Manager','Assistant Store Manager','Store Supervisor','Sales Associate','Senior Sales Associate','Cashier','Head Cashier','Customer Service Representative','Stock Clerk','Inventory Clerk','Warehouse Associate','Administrative Assistant','Security Guard','Maintenance Staff','Delivery Driver']),
            'store_id' => $this->faker->numberBetween(100, 119),
            'is_active' => $this->faker->boolean()
        ];
    }
}
