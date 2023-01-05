<?php

namespace App\Http\Requests;

use App\Shared\LoanConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric|gt:0',
            'term' => [
                'required',
                'integer',
                'gte:' . LoanConstant::MINIMUM_LOAN_STATE,
                'lte:' . LoanConstant::MAXIMUM_LOAN_STATE,
            ],
        ];
    }
}
