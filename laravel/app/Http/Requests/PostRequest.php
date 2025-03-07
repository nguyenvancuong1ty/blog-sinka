<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class PostRequest extends FormRequest
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
            "title" => ["required", "string", "max:255"],
            "thumbnail" => ["required", "string", "max:255"],
            "category_id" => ["required", "int"],
            "description" => ["required","string", ]
        ];
        
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([   
            'code'      => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message'   => '',
            'errors'    => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
