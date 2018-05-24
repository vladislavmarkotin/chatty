<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 12.09.2017
 * Time: 7:06
 */

namespace App\Http\Controllers;

use App\User;
use App\Statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class ProfileController extends Controller{

    private function update(Request $request)
    {

        $user = $request->user();
        /*$data['description'] = $request->input('description');
        $data['experience']=$request->input('experience');

        */

    }

    public function getProfile($id)
    {
        $user = User::where('id', $id)->first();
        //$statuses = Statuses::where('user_id', $id)->first();
        $statuses = DB::table('statuses')->where('user_id', $id)->orderBy('id', 'desc')->first();

        if(!$statuses)
            $statuses = "There is no statuses yet!";
        if (!$user){
            abort(404);
        }

        if($statuses !== 'There is no statuses yet!')
            return view('profile.index')->with(['user' => $user ])->with(['statuses' => $statuses->body]);
        else
            return view('profile.index')->with(['user' => $user ])->with(["statuses" => $statuses]);
    }

    public function getEdit($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user || $id != Auth::id()){
            abort(404);
        }


        return view('profile.edit');
    }

    private function updateAccount()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->first_name = Request::input('first_name');
        $user->last_name = Request::input('last_name');
        $user->location = Request::input('location');
        $user->save();
        return redirect()->route('home')->with('info', 'Your profilr has been updated!');
    }

    public function postEdit(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'alpha|max:50',
            'last_name' => 'alpha|max:50',
            'location' => 'max:20'
        ]);

        $id = Auth::user()->id;
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->location = $request->input('location');
        $user->save();

        //$this->updateAccount();

        //$user->save();

        return redirect()->route('home')->with('info', 'Your profilr has been updated!');
    }

    public function postReply(Request $request)
    {
        dd('reply');
    }

}
/**/