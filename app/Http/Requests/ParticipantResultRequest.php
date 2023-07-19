<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantResultRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'result' => 'required|numeric|min:0|max:10',
            'participant_id' => 'required|exists:users,id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
