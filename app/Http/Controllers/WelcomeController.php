<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailVerify;

class WelcomeController extends Controller
{
    public function index()
    {
        $res = Mail::to('nine@segmentfault.com')->send(new MailVerify());
        dd($res);
    }
}
