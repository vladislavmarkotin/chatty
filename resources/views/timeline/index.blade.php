@extends('templates.default')
@section('content')



@if (Auth::check())
    <div class="row">
        <div class="col-lg-6">
            <form method="post" action="" role="form">
                <div role="form-group {{ $errors->has('status') ? 'has-error': '' }}">
                    <textarea placeholder="what's up, {{ Auth::user()->getName() }}?" name="status" class="form-control" rows="2">

                    </textarea>
                    @if ($errors->has('status'))
                        <span class="help-block">{{ $errors->first('status') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Update Status</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
            <hr>
        </div>
    </div>

   <div class="row">
           <div class="col-lg-5">
               <!-- Statusies and replies -->
               <div class="col-lg-4 col-lg-offset-3">
                       <h4>Statuses:</h4>
                           <h5>@if ($statuses != '')</h5>
                           @foreach ($statuses as $s)
                            <div class="media">
                                <a class="pull-left" href="{{ route('profile.index',['id' => $s->user_id], ['parent_id' =>  $s->parent_id]) }}">
                                    <img src="{{ $user->getAvatarUrl() }}" class="media-object" alt="{{ $user->getName() }}"/>
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <a href="{{ route('profile.index',['id' => $s->user_id]) }}"> {{ $user->GetName() }} </a>
                                        @if($s->parent_id)
                                            <h5>Replied status</h5>
                                            <p>{{ $s->parent_id }}</p>
                                            <p>{{ $s->body }}</p>
                                            <ul class="list-inline">
                                                    <li>date: {{ $s->created_at }}</li>
                                                    <li><a href="">Like</a> </li>
                                                    <li>11 likes</li>
                                            </ul>
                                        @else
                                            <ul class="list-inline">
                                                <li>date: {{ $s->created_at }}</li>
                                                <li><a href="">Like</a> </li>
                                                <li>10 likes</li>
                                            </ul>
                                        @endif
                                </h5>
                                @if (\Illuminate\Support\Facades\Auth::id() != $user->GetId())
                                    <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <textarea name="reply" class="form-control" rows="2" placeholder="Reply"></textarea>
                                        </div>
                                            <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                     </form>
                                @endif
                            @endforeach
                            </div>

                               @else
                                  <h6> There os no statuses!</h6>
                             @endif
                </div>
           </div>
   </div>

   <!-- form for replies -->

@endif

@stop