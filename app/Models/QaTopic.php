<?php
namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class QaTopic extends Model
{
    protected $fillable = [
        'subject',
        'creator_id',
        'receiver_id',
        'sent_at',
    ];

    public function messages()
    {
        return $this->hasMany(QaMessage::class, 'topic_id')
            ->orderBy('created_at', 'asc');
    }

    public function hasUnreads()
    {
        return $this->messages()->whereNull('read_at')->where('sender_id', '!=', Auth::user()->userPlayers()->first()->id)->exists();
    }

    public function receiverOrCreator()
    {
        return $this->creator_id === Auth::user()->userPlayers()->first()->id
        ? Player::withTrashed()->find($this->receiver_id)
        : Auth::user()->userPlayers()->first();
    }

    public static function unreadCount()
    {
        $unreadCount = 0;
		
		$player = Auth::user()->userPlayers()->first();
		if ($player)
		{
			$topics = QaTopic::where(function ($query) {
				$query
					->where('creator_id', Auth::user()->userPlayers()->first()->id)
					->orWhere('receiver_id', Auth::user()->userPlayers()->first()->id);
			})
				->with('messages')
				->orderBy('created_at', 'DESC')
				->get();

			

			foreach ($topics as $topic) {
				foreach ($topic->messages as $message) {
					if ($message->sender_id !== Auth::user()->userPlayers()->first()->id && $message->read_at === null) {
						$unreadCount++;
					}
				}
			}
		}
		
        return $unreadCount;
    }
}
