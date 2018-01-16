<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoxController extends Controller
{

    /**
     * @var Box
     */
    public $box;

    /**
     * BoxController constructor.
     * @param Box $box
     */
    public function __construct(Box $box)
    {
        $this->box = $box;
    }


    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:64',
            'description' => 'required',
            'type' => 'required',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();

        }

    }

    public function add(Request $request)
    {
        $this->verify($request);
    }
}
