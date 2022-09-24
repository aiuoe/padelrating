<?php

namespace App\Http\Requests;

use App\Models\Score;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreScoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('score_create');
    }

    public function rules()
    {
        return [
            'team_1_player_1_id' => [
                'required',
                'integer',
            ],
            'team_1_player_2_id' => [
                'required',
                'integer',
            ],
            'team_2_player_1_id' => [
                'required',
                'integer',
            ],
            'team_2_player_2_id' => [
                'required',
                'integer',
            ],
            'set_1_team_1'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'set_1_team_2'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'set_2_team_1'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'set_2_team_2'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'set_3_team_1'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'set_3_team_2'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'observations'       => [
                'string',
                'nullable',
            ],
        ];
    }
}
