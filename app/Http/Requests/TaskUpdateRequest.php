<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\NextStatus;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $currentStatus = $this->route('task')->status; 

        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000', 
            'category' => 'nullable|exists:categories,id', 
            'status' => [
                'required',
                Rule::in(config('task.status_sequence')),
                new NextStatus($currentStatus),
            ],
        ];
    }
}
