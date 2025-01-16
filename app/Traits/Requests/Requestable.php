<?php

namespace App\Traits\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\UnauthorizedException;

trait Requestable
{
    public function failedAuthorization() {

        throw new UnauthorizedException('This action is unauthorized.', Response::HTTP_UNAUTHORIZED);
    }

    protected function failedValidation(Validator $validator)
    {
        throw ValidationException::withMessages($validator->errors()->toArray());
    }
}
