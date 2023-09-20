<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Make fields optional as we are using the same form for create and edit
        return [
            // make name sometimes requiresd
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'size' => 'sometimes|required|string|max:255',
            'brand' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
