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
    }
}
