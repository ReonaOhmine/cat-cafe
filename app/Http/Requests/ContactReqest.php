<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactReqest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => ['required', 'string', 'max:255'],
            'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ロワンヴー]*$/u'],
            'phone' => ['nullable', 'regex:/^0(\d-?\d{4}|\d{2}-?\d{3}|\d{3}-?\d{2}|\d{4}-?\d|\d0-?\d{4})-?\d{4}$/'],
            'email' => ['required', 'email'],
            'body' => ['required', 'string', 'max:2000'],

        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '名前',
            'name_kana' => '名前（フリガナ）',
            'phone' => '電話番号',
            'email' => 'メールアドレス',
            'body' => 'お問い合わせ内容',
        ];
    }

    public function messages()
    {
        return [
            'name_kana.regex' => ':attributeは全角カタカナで入力してください',
            'phone.regex' => ':attributeはハイフンを含む半角数字で入力してください',
        ];
    }
}
