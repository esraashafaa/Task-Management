<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:3',
            'description' => 'nullable|string|max:1000',
            'project_id' => 'required|integer|exists:projects,id',
            'assigned_to' => 'nullable|integer|exists:users,id'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => __('validation.required', ['attribute' => __('validation.attributes.title')]),
            'title.string' => __('validation.string', ['attribute' => __('validation.attributes.title')]),
            'title.max' => __('validation.max.string', ['attribute' => __('validation.attributes.title'), 'max' => 255]),
            'title.min' => __('validation.min.string', ['attribute' => __('validation.attributes.title'), 'min' => 3]),
            'description.string' => __('validation.string', ['attribute' => __('validation.attributes.description')]),
            'description.max' => __('validation.max.string', ['attribute' => __('validation.attributes.description'), 'max' => 1000]),
            'project_id.required' => __('validation.required', ['attribute' => __('validation.attributes.project_id')]),
            'project_id.integer' => __('validation.integer', ['attribute' => __('validation.attributes.project_id')]),
            'project_id.exists' => __('validation.exists', ['attribute' => __('validation.attributes.project_id')]),
            'assigned_to.integer' => __('validation.integer', ['attribute' => __('validation.attributes.assigned_to')]),
            'assigned_to.exists' => __('validation.exists', ['attribute' => __('validation.attributes.assigned_to')])
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
