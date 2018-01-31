<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
            'name'         => 'required|between:3,25|unique:users,name,'.Auth::id(),
            'email'        => 'required|email',
            'introduction' => 'max:100',
            'avatar'       => 'mimes:jpeg,png,gif,jpg|dimensions:min_width=200,min_height=200'
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => '用戶名稱不能空白',
            'name.between'     => '用戶名稱長度需介於3到25字元',
            'name.unique'      => '已有重複的用戶名稱',
            'email.required'   => 'Email地址不能空白',
            'email.email'      => 'Email地址格式錯誤',
            'introduction.max' => '個人簡介不可超出100字元',
            'avatar.mimes'     => '頭像圖片檔只支援jpg、jpeg、png、gif',
            'avatar.dimensions'=> '頭像長寬最少需200px以上'
        ];
    }
}
