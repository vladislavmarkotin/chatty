@extends('templates.default')

@if (Route::has('login'))
   @if (Auth::check())
@section('content')

    <h3> Update your profile: </h3>

   <form class="form-vertical" method="post" action="">
   {{ csrf_field() }}
     <div class="control-group {{$errors->has('first_name') ? 'has-error': ''}}">
       <label class="control-label" for="inputEmail">First name</label>
       <div class="controls">
         <input type="text" id="inputEmail" name="first_name" placeholder="First name" value="{{ Auth::user()->first_name ?: Request::
          old('first_name') }}">
          @if ($errors->has('first_name'))
            <span class="help-block"></span>
          @endif
       </div>
     </div>
     <div class="control-group {{$errors->has('last_name') ? 'has-error': ''}}">
       <label class="control-label" for="inputPassword" >Last name</label>
       <div class="controls">
         <input type="text" name="last_name" id="inputPassword" placeholder="last name" value="{{ Auth::user()->last_name ?:
          Request::old('last_name') }}">
           @if ($errors->has('last_name'))
                <span class="help-block"></span>
           @endif                                                                                                                                            old('last_name') }}">
       </div>
     </div>
     <div class="control-group {{$errors->has('location') ? 'has-error': ''}}">
            <label class="control-label" for="inputPassword">Location</label>
            <div class="controls">
              <input type="text" name="location" id="inputPassword" value="{{ Auth::user()->location ?: Request::
                   old('location') }}" placeholder="Location">
                   @if ($errors->has('location'))
                                   <span class="help-block"></span>
                              @endif
            </div>
          </div>

       <div class="controls">

         <button type="submit" class="btn btn-default">Update</button>
          <input type="hidden" name="_token " value="{{ Session::token() }}" >
       </div>
     </div>
   </form>
@stop

   @endif
@endif
