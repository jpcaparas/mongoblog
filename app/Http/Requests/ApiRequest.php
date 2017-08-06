<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class ApiRequest extends FormRequest
{
    /**
     * @param array $errors
     *
     * @return JsonResponse
     */
    public function response(array $errors)
    {
        return new JsonResponse($errors, 400);
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new BadRequestHttpException($validator->getMessageBag()->first());
    }
}
