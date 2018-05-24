<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 20.09.2017
 * Time: 9:07
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FriendsController extends Controller{

    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $id = Auth::user()->id;
        $user = User::find($id);

        $requests = Auth::user()->friendRequest();

        return view('friends.index')->with(['user' => $user])->with('requests', $requests)
            ->with('friends', $friends);
    }

    public function getAdd($id)
    {
        dd($id);
    }
} 