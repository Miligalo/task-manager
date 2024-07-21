<?php

namespace App\Http\Requests\Task;

use App\Http\Enums\TaskType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['nullable', 'string', 'min:1', 'max:255'],
            'status' => ['required', 'string', 'min:1', 'max:255', Rule::in(TaskType::getValues())],
            'team_id' => ['required', 'integer', 'exists:teams,id'],
            'user_id' => ['required', 'integer']
        ];
    }
}
