<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        if( $this->_method == 'PUT' ) {
            $logo = 'mimes:png|max:2048|dimensions:max_width=100,max_height=100';
        }else {
            $logo = 'required|mimes:png|max:2048|dimensions:max_width=100,max_height=100';
        }
        return [
            'name'    => 'required|min:2',
            'email'   => 'required',
            'website' => 'required|url',
            'logo'    => $logo,
            // 'logo'  => 'required|mimes:png|max:2048|dimensions:max_width=100,max_height=100',
        ];
    }
}
