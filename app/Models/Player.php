<?php

namespace App\Models;

use Carbon\Carbon;
use Malhal\Geographical\Geographical;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Player extends Model
{
    use SoftDeletes;
    use Geographical;

    protected static $kilometers = true;
    public $table = 'players';
    private $questions;

    const GENRE_SELECT = [
        'male'   => 'Masculino',
        'female' => 'Femenino',
    ];

    protected $dates = [
        'birthdate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'surname',
        'genre',
        'birthdate',
        'license_number',
        'city',
        'description',
        'side',
        'bestshots',
        'pr',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function team1Player1Scores()
    {
        return $this->hasMany(Score::class, 'team_1_player_1_id', 'id');
    }

    public function team1Player2Scores()
    {
        return $this->hasMany(Score::class, 'team_1_player_2_id', 'id');
    }

    public function team2Player1Scores()
    {
        return $this->hasMany(Score::class, 'team_2_player_1_id', 'id');
    }

    public function team2Player2Scores()
    {
        return $this->hasMany(Score::class, 'team_2_player_2_id', 'id');
    }

    public function getBirthdateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions()
    {
        return $this->belongsToMany('App\Models\Question', 'questions_players', 'player_id', 'question_id')->withPivot('answer');
    }

    public function unreadTopics()
    {
        $topics = QaTopic::where(function ($query) {
            $query
                ->where('creator_id', $this->id)
                ->orWhere('receiver_id', $this->id);
        })
            ->with('messages')
            ->orderBy('created_at', 'DESC')
            ->get();

        $unreadCount  = 0;

        foreach ($topics as $topic) {
            foreach ($topic->messages as $message) {
                if ($message->sender_id !== $this->id
                    && $message->read_at === null
                ) {
                    $unreadCount++;
                }
            }
        }

        return $unreadCount;
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
