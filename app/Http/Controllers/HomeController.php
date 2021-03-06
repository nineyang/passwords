<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Password;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * HomeController constructor.
     * @param Box $box
     */
    public function __construct(Box $box, Password $password)
    {
        $this->middleware('auth');
        $this->box = $box;
        $this->password = $password;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxes = $this->box->listByStatus();

        # 获取已经删除的数据
        $deleted_count = $this->password->countByStatus('deleted');
        if ($boxes) {
            $boxes = $this->box->prepare($boxes, ['id', 'title', 'type', 'icon', 'passwords']);
        }
        $types = config('box.type');
        if (isset($types[6])) {
            unset($types[6]);
        }
        return view('home', compact('boxes', 'types', 'unclassified_count', 'deleted_count'));
    }
}
