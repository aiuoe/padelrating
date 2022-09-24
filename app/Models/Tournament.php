<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Tournament extends Model
{
    use SoftDeletes;

    public $table = 'tournaments';

    protected $dates = [
        'startdate',
        'enddate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'startdate',
        'enddate',
        'mens',
        'womens',
        'mix',
        'city',
        'club_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tournamentScores()
    {
        return $this->hasMany(Score::class, 'tournament_id', 'id');
    }

    public function getStartdateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartdateAttribute($value)
    {
        $this->attributes['startdate'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEnddateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEnddateAttribute($value)
    {
        $this->attributes['enddate'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}
