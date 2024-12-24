<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FavoriteRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Define validation rules for the request data.
   *
   * @return array
   */
  public function rules(): array
  {
    $rules = [
      'user_id' => 'sometimes|integer|exists:users,id',
      'restaurant_id' => 'sometimes|integer|exists:restaurants,id',
    ];

    // If the request is a PATCH, make fields optional.
    if ($this->isMethod('patch')) {
      $rules['user_id'] = 'nullable|integer|exists:users,id';
      $rules['restaurant_id'] = 'nullable|integer|exists:restaurants,id';
    }

    return $rules;
  }

  /**
   * Handle validation failure and return a structured error response.
   *
   * @param Validator $validator
   * @throws HttpResponseException
   */
  protected function failedValidation(Validator $validator): void
  {
    throw new HttpResponseException(
      response()->json([
        'message' => 'The given data was invalid.',
        'errors' => $validator->errors(),
      ], 422)
    );
  }
}