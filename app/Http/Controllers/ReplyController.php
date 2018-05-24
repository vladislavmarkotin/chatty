<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 08.11.2017
 * Time: 7:51
 */

namespace App\Http\Controllers;

use App\Statuses;
use Auth;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller{

    public function postReply(Request $request)
    {
        $id = Auth::id();
        $parent_id = 1;
        $user = User::where('id', $id)->first();
        $statuses = DB::table('statuses')->where('user_id', $id)->orderBy('id', 'desc')->first();

        $this->validate($request, [
            'reply-comment' => 'alpha|min:5',
        ]);

        //dd($request['reply-comment']);
        Auth::user()->statuses()->insert([
            'user_id' => $id,
            'parent_id' => $parent_id,
            'body' => $request['reply-comment']
        ]);
        return view('profile.index')->with(['user' => $user ])->with(['statuses' => $statuses->body]);
        //dd('all ok!!!!'); // I am here
    }

    protected function create(array $data)
    {
        $id = User::GetId();
        $parent_id = Statuses::GetId();
        return Statuses::create([
            'user_id' => $id,
            'parent_id' => $parent_id,
            'body' => $data['reply-comment']
        ]);
    }
} 