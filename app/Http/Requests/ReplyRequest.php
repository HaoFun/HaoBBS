<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
            'content' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '回覆內容必須填寫',
            'content.min'      => '回覆內容至少需三字元'
        ];
    }
}
