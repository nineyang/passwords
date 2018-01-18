<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Password;
use Illuminate\Http\Request;

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
