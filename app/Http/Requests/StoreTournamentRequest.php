<?php

namespace App\Http\Requests;

use App\Models\Tournament;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTournamentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tournament_create');
    }

    public function rules()
    {
        return [
            'name'      => [
                'string',
                'required',
            ],
            'startdate' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'enddate'   => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'city'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
