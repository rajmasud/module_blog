<?php

namespace Modules\Blog\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
/*
-- molti esempi sanitize
https://www.codermen.com/blog/59/how-to-use-advance-validation-in-laravel-the-smart-way-
--- calendar
http://derekmd.com/2017/02/improving-laravel-validation-replacer-functions/
--- recaptcha
https://crnkovic.me/simple-and-reusable-recaptcha-validation-in-laravel/
https://m.dotdev.co/google-recaptcha-integration-with-laravel-ad0f30b52d7d
--- pincode
https://www.cedextech.com/blog/use-laravel-55-rule-object-to-validate-the-pincode
--- da leggere
https://www.sitepoint.com/data-validation-laravel-right-way/
--- backpack
https://backpackforlaravel.com/docs/3.6/crud-tutorial
---- macros
https://tighten.co/blog/the-magic-of-laravel-macros
---- failed validation JSON
http://www.coding4developers.com/laravel/customize-validation-error-response-in-laravel-5-5-how-i-can-return-a-customized-response-in-a-formrequest-class-in-laravel-5-5/
----
  public function validateMonthYear($attribute, $value, $parameters)
    {
        // Can have 3 letter month name as string followed by 4 letter year
        // number.
        return preg_match("/^(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sept|Oct|Nov|Dec)-[0-9]{4}$/i", $value);
    }

*/

class PivotRequiredRule implements Rule {
    /**
     * The source control provider instance.
     *
     * @var \App\Source
     */
    public $field_name; //il mio nome
    public $field_name_required; //il campo che deve essere obbligatorio

    /**
     * Create a new rule instance.
     */
    public function __construct($field_name = null, $field_name_required = null) {
        //ddd($field_name);
        $this->field_name = $field_name;
        $this->field_name_required = $field_name_required;
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
        $key_required = substr($attribute, 0, -strlen($this->field_name)).''.$this->field_name_required;
        //$data = (\Request::all());//phpstan
        $data = (request()->all()); //phpstan
        $value_required = Arr::get($data, $key_required);
        $value = (int) $value;
        if ($value && ! $value_required) {
            return false;
        }
        //return false;
        //ddd($data);
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return ':attribute must be checked.';
    }
}

/*
https://vegibit.com/how-to-validate-form-submissions-in-laravel/
https://medium.com/@kamerk22/the-smart-way-to-handle-request-validation-in-laravel-5e8886279271

'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/',
    ], [
        'password.regex' => 'Password must contain at least 1 lower-case and capital letter, a number and symbol.'
    ]);

*/
