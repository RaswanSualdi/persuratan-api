<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditLettersRequest extends FormRequest
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
            'deskripsi'=>'required|max:300',
            'tgl_surat'=>'required',
            'link' => 'required|max:300',
            'company'=> 'required|integer',
            'editNoLetter'=>'required|integer'
        ];
    }
}