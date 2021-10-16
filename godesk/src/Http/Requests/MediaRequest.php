<?php

namespace SpaceCode\GoDesk\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'search_text' => 'sometimes|nullable|string',
            'page' => 'sometimes|nullable|numeric',
            'per_page' => 'sometimes|nullable|numeric'
        ];
    }
}