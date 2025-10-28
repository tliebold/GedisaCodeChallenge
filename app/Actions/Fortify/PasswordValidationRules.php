<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        Password::defaults(Password::min(4));
        return ['required', 'string', Password::default(), 'confirmed'];
    }
}
