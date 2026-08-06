<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'title' => 'required|string|max:255',

        'description' => 'required|string',

        'report_date' => 'required|date',

        'project_id' => 'nullable|exists:projects,id',

        'task_id' => 'nullable|exists:tasks,id',

        'files.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,mp4,docx,xlsx|max:20480',
    ];
}
}
