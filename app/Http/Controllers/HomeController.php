<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var Box
     */
    public $box;

    /**
     * HomeController constructor.
     * @param Box $box
     */
    public function __construct(Box $box)
    {
        $this->middleware('auth');
        $this->box = $box;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxes = $this->box->listByStatus();
        if ($boxes){
            $boxes = $this->box->prepare($boxes->toArray(), ['id', 'title', 'type', 'icon' , 'passwords']);
        }
        $types = config('box.type');
        return view('home', compact('boxes', 'types'));
    }
}
