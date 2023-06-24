<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use App\Rules\CanSetPostRating;
use App\Rules\CanSetPostCompany;
use App\Models\Post;

use Auth;

class PostUpdateRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        $post = Post::find($this->id);

        if(!$post){

            return false;
        }

        if(!$user->admin || !$user->admin->is_verified){

            if($post->creator->id != $user->id){

                return false;
            }

            return false;

            $currentTime = time();
            $createdAtTimestamp = strtotime($post->created_at);
            $timeDifference = $currentTime - $createdAtTimestamp;
            $maximumAllowedDuration = 24 * 60 * 60;

            if(isset($this->rating) || isset($this->company_id)){

                return false;
            }else if($timeDifference > $maximumAllowedDuration){

                return false;
            }

            return true;
        }

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
            'title' => 'required|string|max:200',
            'description' => 'string|required_without:audio_file',
            'audio_file' => 'file|required_without:description|mimes:mp3',
        ];
    }
}
