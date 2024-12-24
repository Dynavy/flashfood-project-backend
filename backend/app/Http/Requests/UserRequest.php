<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
  // Allow the request to be authorized.
  public function authorize()
  {
    return true;
  }

  // Define validation rules for the request data.
  public function rules(): array
  {
    $rules = [
      'name' => 'sometimes|string|max:100',
      'email' => 'sometimes|email|unique:users,email,' . $this->user,
      'password' => 'sometimes|string|min:8|confirmed',
    ];


    if ($this->isMethod('patch')) {
      $rules['password'] = 'nullable|string|min:8|confirmed';
    }

    return $rules;
  }

  // Handle validation failure and return a structured error response.
  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(
      response()->json([
        'message' => 'The given data was invalid.',
        'errors' => $validator->errors(),
      ], 422)
    );
  }
}