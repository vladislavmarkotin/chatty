@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <!-- Userinfo and status-->
             @include('user.partials.userblock')
            <hr>
            @if($statuses !== "There is no statuses yet!")
                <p><h3>Status: {{ $statuses }} </h3></p>
                <ul class="list-inline">
                    <li><a href="">Like</a> </li>
                    <li>0 likes</li>
                 </ul>
                 @if (\Illuminate\Support\Facades\Auth::id() != $user->GetId())
                   <form role="form" action="" method="post">
                     <div class="form-group">
                        <textarea name="reply-comment" class="form-control" rows="2" placeholder="Reply"></textarea>
                     </div>
                                                             <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                                             <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
            @endif
            @else
                    <p><h5>There is no statuses yet!</h5></p>
            @endif
        </div>
        <div class="col-lg-4 col-lg-offset-3">
        <!-- Friends and friend`s requste -->
        <h4>{{ $user->getName() }}'s friends</h4>

        @if(!$user->friends()->count())
            <h5>{{ $user->getName() }} has no friends</h5>
        @else
            @foreach($user->friends() as $user)
                @include ('user/partials/userblock')
            @endforeach

        @endif
        <a href="" class="btn btn-primary">Add</a>

        </div>
    </div>
    <div class="col-lg-7">

    </div>
@stop