<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

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

    /**
     * @param Request $request
     * @return array
     */
    public function add(Request $request)
    {
        $res = $this->verify($request, [
            'title' => 'required|max:64',
            'description' => 'required',
            'type' => 'required',
        ]);
        if (is_array($res) && !empty($res)) {
            return $this->failed($res);
        }
        try {
            $this->box->add($request);
        } catch (Exception $exception) {
            return $this->failed($exception->getMessage());
        }

        return $this->success('created success!');
    }

    public function detail(Request $request , $id)
    {

    }
}
