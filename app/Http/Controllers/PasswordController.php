<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Password;
use Illuminate\Http\Request;
use Exception;

class PasswordController extends Controller
{
    /**
     * @var Box
     */
    public $box;

    /**
     * @var Password
     */
    public $password;

    /**
     * PasswordController constructor.
     * @param Box $box
     * @param Password $password
     */
    public function __construct(Box $box, Password $password)
    {
        $this->box = $box;
        $this->password = $password;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function add(Request $request)
    {
        if (auth()->user()->cant('createPassword', $request->box)) {
            return $this->failed('no access');
        }
        $res = $this->verify($request, [
            'title' => 'required|max:64',
            'description' => 'required',
            'url' => 'required',
            'account' => 'required|max:32',
            'password' => 'required',
            'boxId' => 'required',
            'safetyLevel' => 'required|int'
        ]);
        if (is_array($res) && !empty($res)) {
            return $this->failed($res);
        }
        if (!config('password.level.' . $request->get('safetyLevel'))) {
            return $this->failed('level is wrong');
        }

        try {
            #todo 这里密码存储的问题需要思考一下
            $this->password->add([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'url' => $request->get('url'),
                'account' => $request->get('account'),
                'password' => $request->get('password'),
                'box_id' => $request->get('boxId'),
                'safety_level' => $request->get('safetyLevel'),
            ]);
            $request->box->update([
                'passwords' => $request->box->passwords + 1
            ]);
        } catch (Exception $exception) {
            return $this->failed($exception->getMessage());
        }

        return $this->success();
    }

    /**
     * @param Request $request
     * @param $b_id
     * @return array
     */
    public function passwordList(Request $request, $b_id)
    {
        if (auth()->user()->cant('view', $request->box)) {
            return $this->failed('no access');
        }
        $passwords = $this->password->getPasswordList($b_id);
        if ($passwords) {
            $passwords = $this->password->prepare($passwords, ['id', 'title']);
        }

        return $this->success($passwords);
    }
}
