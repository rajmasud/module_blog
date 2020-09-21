<?php

namespace Modules\Blog\Rules;

/*
* https://appdividend.com/2017/09/02/laravel-5-5-validation-example-scratch/
* https://laravel-guide.readthedocs.io/en/latest/validation/
* https://www.codeclouds.com/blog/custom-validation-rules-laravel/
* //---- register to newsletter
* https://jasonmccreary.me/articles/test-validation-laravel-form-request-assertion/
*
* https://mattstauffer.com/blog/laravel-5.0-form-requests/
*
* //--  REGISTERING THE NEW VALIDATOR WITH SERVICE PROVIDER
* https://marabesi.com/php/2017/05/31/laravel-custom-validator.html
**/

use Illuminate\Contracts\Validation\Rule;

class FiveCharactersRule implements Rule {
    /**
     * Create a new rule instance.
     */
    public function __construct() {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value) {
        return 5 === strlen($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        //return 'The :attribute must be 5 characters';
        return trans('validation.only_uppercase');
    }
}

/*
protected $user;

public function __construct(User $user){
    $this->user = $user;
}

public function passes($attribute, $value){
    return Hash::check($value, $this->user->password);
}

-------------
return version_compare($this->model->version, $value, '<');
---------------
public function passes($attribute, $value)
{
    return str_word_count($value) <= 500;
}

public function message()
{
    return 'The :attribute cannot be longer than 500 words.';
}
*/
