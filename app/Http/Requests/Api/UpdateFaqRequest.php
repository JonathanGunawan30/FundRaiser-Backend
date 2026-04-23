<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;

class UpdateFaqRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question' => ['sometimes', 'required', 'string', 'max:500'],
            'answer' => ['sometimes', 'required', 'string'],
            'is_active' => ['sometimes', 'required', 'boolean'],
            'order_index' => ['sometimes', 'required', 'integer'],
        ];
    }
}
