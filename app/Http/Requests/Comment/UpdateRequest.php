<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\ApiRequest;

class UpdateRequest extends ApiRequest
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
            'author' => 'bail|required|max:255',
            'author_email' => 'required|email',
            'author_url' => 'url',
            'author_ip' => 'ip',
            'author_agent' => 'max:255',
            'content' => 'required|max:4294967295',
            'post_id' => 'exists:posts,_id',
        ];
    }
}
