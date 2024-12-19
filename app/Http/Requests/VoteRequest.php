<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'vote' => $this->route('poll')->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->vote;
        return [
            'option' => [
                'required',
                'integer',
                "exists:poll_options,id,poll_id,{$id}",
            ],
            'vote' => [
                'required',
                'integer',
                Rule::unique('votes', 'poll_id')->where('user_id', $this->user()->id),
            ]
        ];
    }
}
