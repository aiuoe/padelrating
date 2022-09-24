<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Score extends Model
{
    use SoftDeletes;

    public $table = 'scores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tournament_id',
        'team_1_player_1_id',
        'team_1_player_2_id',
        'team_2_player_1_id',
        'team_2_player_2_id',
        'set_1_team_1',
        'set_1_team_2',
        'set_2_team_1',
        'set_2_team_2',
        'set_3_team_1',
        'set_3_team_2',
        'observations',
        'location_club_id',
        'other_location',
        'start',
        'end',
        'verified_by',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function team_1_player_1()
    {
        return $this->belongsTo(Player::class, 'team_1_player_1_id');
    }

    public function team_1_player_2()
    {
        return $this->belongsTo(Player::class, 'team_1_player_2_id');
    }

    public function team_2_player_1()
    {
        return $this->belongsTo(Player::class, 'team_2_player_1_id');
    }

    public function team_2_player_2()
    {
        return $this->belongsTo(Player::class, 'team_2_player_2_id');
    }
}
