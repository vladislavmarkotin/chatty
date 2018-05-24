@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <!-- YYour friends-->
             @include('user.partials.userblock')
            <hr>
        </div>
        <div class="col-lg-4">
        <!-- Friends and friend`s requste -->
        @if(Auth::user()->hasFriendRequestPending($user))
            <p>Waiting for {{ $user->getName() }}`s accept your request</p>
        @endif

        <h4>{{ $user->getName() }}'s friends</h4>

        @if(!$user->friends()->count())
            <h5>{{ $user->getName() }} has no friends</h5>

        @else
            @foreach($user->friends() as $user)
                @include ('user/partials/userblock')
            @endforeach
            <a href="" class="btn btn">Add as a friend</a>
        @endif
        </div>
        <div class="col-lg-6">
        <h4>Friend requests</h4>

        @if (!$requests->count())
            <p>You have no requests</p>
        @elseif (!Auth::user()->hasFriendRequestReceived($user))
            @foreach($requests as $user)
                 @include ('user.partials.userblock')
            @endforeach
             <a href="" class="btn btn-primary">Accept friend request</a>
         @endif
        </div>
    </div>
@stop