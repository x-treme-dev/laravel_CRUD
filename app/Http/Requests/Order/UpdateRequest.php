<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'total'         => 'required|integer',
            'customer_id'   => 'required|integer',
            'email'     => 'required|email',
            'comment'   => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'total.integer'    => "Сумма должна быть числом",
            'total.required'    => "Укажите сумму заказа (руб)"
        ];
    }

}
