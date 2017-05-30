<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class FormRequestExtended extends FormRequest
{
    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        
        if ($this->expectsJson()) {
            return new JsonResponse([
                'data' => $errors
            ], 422);
        }

        parent::response($errors);
    }
}
