<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Gate;

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
        if (auth()->user()->cant('create', $request->box)) {
            return $this->failed('no access');
        }
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

        return $this->success();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function detail(Request $request)
    {
        if (auth()->user()->cant('view', $request->box)) {
            return $this->failed('no access');
        }
        $box = $request->box->toArray();
        $box = $this->box->prepare($box, ['id', 'title', 'description', 'created_at', 'type', 'icon']);

        return $this->success($box);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function update(Request $request)
    {
        if (auth()->user()->cant('update', $request->box)) {
            return $this->failed('no access');
        }
        $res = $this->verify($request, [
            'title' => 'required|max:64',
            'description' => 'required',
            'type' => 'required',
        ]);
        if (is_array($res) && !empty($res)) {
            return $this->failed($res);
        }
        try {
            $request->box->updateWithTime($request);
        } catch (Exception $exception) {
            return $this->failed($exception->getMessage());
        }

        return $this->success();
    }

    public function passwordList(Request $request)
    {
        return $this->success();
    }
}
