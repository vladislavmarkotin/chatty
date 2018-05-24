<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Statuses;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();

        if(Auth::check())
        {

            $statuses = Statuses::where( function ($query){
                return $query->where('user_id', Auth::user()->GetId() )
                    ->orWhereIn('user_id', Auth::user()->friends()->pluck('parent_id') );
            } )
                ->orderBy('created_at','desc')->get();

            //dd($statuses);

            return view('timeline.index')->with(['user' => $user, "statuses" => $statuses]);


        }

        return view('home')->with(['user' => $user]);
    }

    public function postStatus(Request $request)
    {
        if (isset($request))
        {
            $this->validate($request, [
                'body' => 'alpha|max:140',
            ]);

            $user_id = Auth::user()->id;
            $status = Statuses::find($user_id);

            Auth::user()->statuses()->create([
                'body' => $request->input('status'),
            ]);
        }
        return redirect()->route('home');
    }

    public function LogOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
