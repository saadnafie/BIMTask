<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric'],
            'payer' => ['required', 'exists:App\Models\User,id'],
            'due_on' => ['required','date'],
            'vat' => ['required','numeric'],
            'is_vat_inclusive' => ['required','boolean'],
        ];
    }
}
