<?php

namespace App\Http\Requests\Tag;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'max:255',
                'required',
                Rule::unique('tags')->ignore($this->tag->id, '_id')
            ]
        ];
    }
}
