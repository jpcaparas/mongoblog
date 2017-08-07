<?php

namespace App\Http\Requests\Post;

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
            'title' => 'bail|required|max:255',
            'content' => 'max:4294967295',
            'excerpt' => 'max:65535',
            'is_published' => 'required|boolean',
            'user_id' => 'required',
            'categories' => 'array|exists:categories,_id',
            'tags' => 'array|exists:tags,_id',
        ];
    }

    protected function prepareForValidation()
    {
        $input = $this->all();
        $input['is_published'] = $input['is_published'] ?? 0;

        $this->replace($input);
    }
}
