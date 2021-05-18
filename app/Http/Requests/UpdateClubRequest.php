<?php

namespace App\Http\Requests;

use App\Models\Club;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClubRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('club_edit');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'city'          => [
                'string',
                'required',
            ],
            'indoor_courts' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'outdor_courts' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'users.*'       => [
                'integer',
            ],
            'users'         => [
                'array',
            ],
        ];
    }
}
