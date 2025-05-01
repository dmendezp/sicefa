<?php

namespace Modules\LOMBRISOFT\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WormBedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'number' => 'required|string|max:50|unique:worm_beds,number,'.$this->route('wormBed'),
            'status' => 'required|in:activa,inactiva,mantenimiento',
            'start_date' => 'required|date'
        ];
    }

    /**
     * Get custom messages for validator errors.
     * @return array
     */
    public function messages()
    {
        return [
            'number.required' => 'El número de cama es obligatorio',
            'number.unique' => 'Este número de cama ya existe',
            'status.required' => 'El estado es obligatorio',
            'start_date.required' => 'La fecha de inicio es obligatoria'
        ];
    }
}