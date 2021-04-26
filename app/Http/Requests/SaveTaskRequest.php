<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class SaveTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'projectId' => 'integer',
            'name' => 'required|max:50|min:2',
            //'name' => ['required', 'max:50', 'min:2', Rule::unique('tasks')->ignore($this->task)],
            'description' => 'required',
            'statusId' => 'integer',
            'priorityId' => 'required|integer',
            'date' => 'nullable|date',
            'estimation' => 'nullable|string',
            'taskTypeId' => 'required|integer',
            'blocked' => 'boolean',
            'milestoneId' => 'nullable|integer',
            'users' => 'nullable|array'
        ];
    }

    /**
     * Return validation errors in json format.
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
