<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailVerify;

class WelcomeController extends Controller
{
    public function index()
    {
        try {
            $user = User::find(8);
            $res = Mail::to('nine.yang.coding@gmail.com')->send(new MailVerify());
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
        dd($res);
    }
}
