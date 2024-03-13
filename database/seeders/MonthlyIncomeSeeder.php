<?php

namespace Database\Seeders;
use App\Models\MonthlyIncome;
use Illuminate\Database\Seeder;

class MonthlyIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['monthly_income' => '10k to 25k'],
            ['monthly_income' => '25k to 50k'],
            ['monthly_income' => '50k to 100k'],
            ['monthly_income' => '100k to 300k'],
            ['monthly_income' => 'Above 300k'],
        ];

        // Insert options using model
        foreach ($options as $option) {
            MonthlyIncome::create($option);
        }
    }
}
