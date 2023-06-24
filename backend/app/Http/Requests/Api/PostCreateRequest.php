<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class PostCreateRequest extends ApiFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_id' => 'integer|required_without:company_name|exists:companies,id',
            'company_name' => 'string|required_without:company_id',
            'title' => 'required|string|max:200',
            'rating' => 'required|integer|max:5',
            'description' => 'string|required_without:audio_file',
            'audio_file' => 'file|required_without:description|mimes:mp3',
        ];
    }
}
