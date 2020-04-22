<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Authentication extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
//            'type' => ['required', new EnumValue(UserType::class)],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json(["error" => $validator->errors()], 422);
        throw new HttpResponseException($response);
    }
}
