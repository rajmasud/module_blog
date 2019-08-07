<?php



namespace Modules\Blog\Http\Requests\Admin\PostCat;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Extend\Traits\FormRequestTrait;

class StorePost extends FormRequest
{
    use FormRequestTrait;

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
        ];
    }
}
