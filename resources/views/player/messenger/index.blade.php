@extends('layouts.player')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="list-group">
            @php($myplayer_id = \Auth::user()->userPlayers()->first()->id)
            @forelse($topics as $topic)
                @php($otherplayer_id = ($topic->creator_id==$myplayer_id)?$topic->receiver_id:$topic->creator_id)
                @php($otherplayer = \App\Models\Player::find($otherplayer_id))
                <div class="row list-group-item d-flex">
                    <div class="col-5">
                        <a href="{{ route('player.messenger.conversation', [$otherplayer_id]) }}">
                                @if($topic->hasUnreads())
                                    <strong>
                                        {{ $otherplayer !== null ? $otherplayer->name." ".$otherplayer->surname : '' }}
                                    </strong>
                                @else
                                    {{ $otherplayer !== null ? $otherplayer->name." ".$otherplayer->surname : '' }}
                                @endif
                        </a>
                    </div>
                    <div class="col-4 text-right">{{ $topic->created_at->diffForHumans() }}</div>
                    <div class="col-2 text-center">
                        <form action="{{ route('player.messenger.destroyTopic', [$topic->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                        </form>
                    </div>
                </div>
                @empty
                <div class="row list-group-item">
                    {{ trans('global.you_have_no_messages') }}
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection