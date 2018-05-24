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
            hello
        </div>
    </div>

    <div class="row">
               <div class="col-lg-5">
                   <!-- Statusies and replies -->
                   <div class="col-lg-4 col-lg-offset-3">
                           <!-- Friends and friend`s requste -->
                           <h4>Statuses:</h4>
                               <h5>@if ($statuses != '')</h5>
                                <div class="media">
                                    <a class="pull-left" href="">
                                        <img src="" class="media-object" alt=""/>
                                    </a>
                                </div>
                                <div class="media-body">
                                <h4 class="media-heading">
                                    <a href=""> Dayle </a>
                                    @foreach ($statuses as $s)
                                        <p>{{ $s->body }}</p>
                                        <ul class="list-inline">
                                            <li>date</li>
                                            <li><a href="">Like</a> </li>
                                            <li>10 likes</li>
                                        </ul>
                                </h4>
                                @endforeach
                                </div>

                                   @else
                                      <h6> There os no statuses!</h6>
                                 @endif
                    </div>
               </div>
       </div>
@endif

@stop