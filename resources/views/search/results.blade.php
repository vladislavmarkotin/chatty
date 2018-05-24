@extends('...templates.default')
     @section('content')
         <p><h3>Your search for: {{ Request::input('search') }}</h3></p>

         <div class="row">
            <div class="col-lg-12">

                @if (!$users->count())
                    <p>No results, sorry</p>
                @else
                    @foreach ($users as $user)
                        @include('...user.partials.userblock')
                    @endforeach
                @endif
            </div>

         </div>
     @stop