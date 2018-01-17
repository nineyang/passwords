<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

class AccountController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    /**
     * AccountController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verifyEmail(Request $request)
    {
        $key = "{$request->get('uid')}:verify";
        $value = Cache::get($key);
        $user = $this->user->checkAndGet($request->get('uid'));
        if ($user) {
            $title = 'Success';
            $info = 'It doesn\'t need to be activated again';
        } else {
            if ($value == $request->get('token')) {
                $title = 'Success';
                $info = 'Activation successful';
            } else {
                $title = 'Failed';
                $info = 'Activation failed';
            }
        }

        $this->user->activate($request->get('uid'));
        Cache::delete($value);

        return view('mails.verify_result', compact('title', 'info'));
    }
}
