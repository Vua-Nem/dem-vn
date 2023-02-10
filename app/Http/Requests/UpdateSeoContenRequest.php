<?php

namespace App\Http\Requests;

use App\Models\SeoContent;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\SeoConten;

class UpdateSeoContenRequest extends FormRequest
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
        $rules = SeoContent::$rules;
        
        return $rules;
    }
}
