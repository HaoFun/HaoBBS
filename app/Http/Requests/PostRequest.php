<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'   =>   'required|min:3',
                    'body'    =>   'required|min:3',
                    'topic_id'=>   'required|numeric'
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            'title.required'    =>  '標題必須填寫',
            'title.min'         =>  '標題至少需3字元',
            'body.required'     =>  '內容必須填寫',
            'body.min'          =>  '內容至少需3字元',
            'topic_id.required' =>  '主題分類必須選擇',
            'topic_id.numeric'  =>  '主題分類選擇錯誤'
        ];
    }
}
