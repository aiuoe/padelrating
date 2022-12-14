<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QaMessage extends Model
{
    protected $fillable = [
        'topic_id',
        'sender_id',
        'content',
        'read_at',
    ];

    protected $dates = [
        'sent_at',
    ];

    public function topic()
    {
        return $this->belongsTo(QaTopic::class);
    }

    public function sender()
    {
        return $this->hasOne(Player::class, 'id', 'sender_id')->withTrashed();
    }
}
