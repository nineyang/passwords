<?php

namespace App\Http\Controllers;

use App\Models\Box;
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
        $user = $this->user->find($request->get('uid'));
        if ($user) {
            if ($user->status == config('status.user.available')) {
                $title = 'Success';
                $info = 'It doesn\'t need to be activated again';
            } elseif ($value == $request->get('token')) {
                $this->user->activate($request->get('uid'));
                Cache::delete($value);
                # 创建一个未分类的默认盒子
                (new Box())->add([
                    'title' => '默认',
                    'type' => 6,
                    'description' => '默认',
                    'sort' => 1
                ]);
                $title = 'Success';
                $info = 'Activation successful';
            } else {
                $title = 'Failed';
                $info = 'Activation failed';
            }
        } else {
            abort(404);
        }

        return view('mails.verify_result', compact('title', 'info'));
    }
}
