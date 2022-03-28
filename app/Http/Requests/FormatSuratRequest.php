<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormatSuratRequest extends FormRequest
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
            'deskripsi'=>'required|min:10|max:155',
            'tgl_surat'=>'required|date',
            'link' => 'required',
            // 'idkodesurat'=> 'required|integer',
            // 'idkodelembaga'=>'required|integer'
            

        ];
    }
}
