<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 26.10.2017
 * Time: 8:54
 */

namespace App\Http\Controllers;

use App\Statuses;
use Auth;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class feedController extends Controller{

    private function Insert($data = null)
    {
        if (isset($data))
        {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        }
    }

    public function feeds(Request $query = null)
    {
        $id = Auth::user()->id;
        $user =  User::find($id);
        //$query =

        $statuses = Statuses::where('user_id', $id)->get();

        //dd($statuses);

        return view('home.home')->with('statuses', $statuses)->with("user", $user);
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

} 