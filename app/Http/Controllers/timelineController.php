<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 17.10.2017
 * Time: 8:28
 */

namespace App\Http\Controllers;

use App\User;
use App\Statuses;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class timelineController extends Controller{

    public function timeline()
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
    }

    public function StatusTimeline()
    {
        $id = Auth::user()->getId() ;
        $parent_id = Auth::user()->statuses()->where('parent_id');

        $statuses = Auth::user()->statuses()->where()->first();
        return view('timeline.index')->with(['statuses' => $statuses]);
    }

    public function postStatus(Request $request)
    {
        $this->validate($request,
            [
                'status' => 'required|max:140'
            ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        return redirect()->route('home');
    }

    public function postReply(Request $request, $status_id)
    {
        dd('all ok!');
    }
} 