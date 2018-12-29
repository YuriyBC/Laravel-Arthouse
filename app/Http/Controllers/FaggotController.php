<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaggotController extends Controller
{
    public function get () {
        return view('faggot-test');
    }
}
