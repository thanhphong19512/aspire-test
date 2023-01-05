<?php

namespace Database\Factories;

use App\Shared\LoanConstant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduledRepaymentsLoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'loan_id' => $this->faker->numerify(),
            'debt' => 10000,
            'interest' => 1000,
            'total' => 11000,
            'payment_period' => 1,
            'payment_term' => date('Y-m-d H:i:s'),
            'loan_state' => LoanConstant::LOAN_STATE_PENDING
        ];
    }
}
