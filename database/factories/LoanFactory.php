<?php

namespace Database\Factories;

use App\Shared\LoanConstant;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numerify(),
            'interest_rate' => LoanConstant::DEFAULT_INTEREST_RATE,
            'amount' => 10000,
            'term' => LoanConstant::DEFAULT_LOAN_TERM,
            'payment_cycle' => LoanConstant::DEFAULT_PAYMENT_CYCLE,
            'loan_state' => LoanConstant::LOAN_STATE_PENDING,
            "approved_user_id" => null,
            "approved_at" => null
        ];
    }
}
