<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Club extends Model
{
    use SoftDeletes;

    public $table = 'clubs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'city',
        'indoor_courts',
        'outdor_courts',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function clubTournaments()
    {
        return $this->hasMany(Tournament::class, 'club_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
