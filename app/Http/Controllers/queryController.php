<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 06.09.2017
 * Time: 8:32
 */

namespace App\Http\Controllers;


class queryController extends Controller{

    public function getResults()
    {
        //dd($_GET['search']);
        return view('results');
    }
} 