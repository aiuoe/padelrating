<?php
namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Http\Requests\QaTopicCreateRequest;
use App\Http\Requests\QaTopicReplyRequest;
use App\Models\QaTopic;
use App\Models\User;
use App\Models\Player;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function index()
    {
        $topics = QaTopic::where(function ($query) {
            $query
                ->where('creator_id', Auth::user()->userPlayers()->first()->id)
                ->orWhere('receiver_id', Auth::user()->userPlayers()->first()->id);
        })
            ->orderBy('created_at', 'DESC')
            ->get();

        $title   = trans('global.all_messages');
        $unreads = Auth()->user()->userPlayers()->first()->unreadTopics();

        return view('player.messenger.index', compact('topics', 'title', 'unreads'));
    }

    public function createTopic()
    {
        $users = User::all()
            ->except(Auth::user()->userPlayers()->first()->id);

        $unreads = $this->unreadTopics();

        return view('player.messenger.create', compact('users', 'unreads'));
    }

    public function storeTopic(QaTopicCreateRequest $request)
    {
        $topic = QaTopic::create([
            'subject'     => $request->input('subject'),
            'creator_id'  => Auth::user()->userPlayers()->first()->id,
            'receiver_id' => $request->input('recipient'),
        ]);

        $topic->messages()->create([
            'sender_id' => Auth::user()->userPlayers()->first()->id,
            'content'   => $request->input('content'),
        ]);

        return redirect()->route('player.messenger.index');
    }

    public function showMessages(QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        foreach ($topic->messages as $message) {
            if ($message->sender_id !== Auth::user()->userPlayers()->first()->id && $message->read_at === null) {
                $message->read_at = Carbon::now();
                $message->save();
            }
        }

        $unreads = Auth()->user()->userPlayers()->first()->unreadTopics();

        return view('player.messenger.show', compact('topic', 'unreads'));
    }

    public function destroyTopic(QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        $topic->delete();

        return redirect()->route('player.messenger.index');
    }

    public function showInbox()
    {
        $topics = QaTopic::where('receiver_id', Auth::user()->userPlayers()->first()->id)
            ->orWhere('creator_id', Auth::user()->userPlayers()->first()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('player.messenger.index', compact('topics'));
    }

    public function showOutbox()
    {
        $title = trans('global.outbox');

        $topics = QaTopic::where('creator_id', Auth::user()->userPlayers()->first()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $unreads = $this->unreadTopics();

        return view('player.messenger.index', compact('topics', 'title', 'unreads'));
    }

    public function replyToTopic(QaTopicReplyRequest $request, QaTopic $topic)
    {
        $this->checkAccessRights($topic);
        $player_id = Auth::user()->userPlayers()->first()->id;

        $topic->messages()->create([
            'sender_id' => $player_id,
            'content'   => $request->input('content'),
        ]);

        return redirect()->route('player.messenger.conversation', ($player_id == $topic->receiver_id)?$topic->creator_id:$topic->receiver_id);
    }

    public function showReply(QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        $receiverOrCreator = $topic->receiverOrCreator();

        if ($receiverOrCreator === null || $receiverOrCreator->trashed()) {
            abort(404);
        }

        $unreads = $this->unreadTopics();

        return view('player.messenger.reply', compact('topic', 'unreads'));
    }

    public function getConversation(Player $player)
    {
        $myplayer = Auth::user()->userPlayers()->first();

        $topic = QaTopic::where(function($query) use ($myplayer, $player){
            $query->where('creator_id', $myplayer->id)->where('receiver_id', $player->id);
        })->orWhere(function($query) use ($myplayer, $player){
            $query->where('creator_id', $player->id)->where('receiver_id', $myplayer->id);
        })->first();
        if ($topic)
        {
            $this->checkAccessRights($topic);

            $receiverOrCreator = $topic->receiverOrCreator();

            if ($receiverOrCreator === null || $receiverOrCreator->trashed()) {
                abort(404);
            }

            foreach ($topic->messages as $message) {
                if ($message->sender_id !== Auth::user()->userPlayers()->first()->id && $message->read_at === null) {
                    $message->read_at = Carbon::now();
                    $message->save();
                }
            }

        }
        else
        {
            $topic = QaTopic::create([
                'subject'     => 'Messenger',
                'creator_id'  => Auth::user()->userPlayers()->first()->id,
                'receiver_id' => $player->id,
            ]);
        }

        return view('player.messenger.conversation', compact('player', 'topic'));
    }

    private function checkAccessRights(QaTopic $topic)
    {
        $player = Auth::user()->userPlayers()->first();

        if ($topic->creator_id !== $player->id && $topic->receiver_id !== $player->id) {
            return abort(401);
        }
    }
}
