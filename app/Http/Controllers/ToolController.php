<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * @return array
     */
    public function getRandPassword()
    {
        $args = \request()->except('size');

        $range = [];
        foreach ($args as $key => $arg) {
            if ($arg == 'true' && config('password.' . $key)) {
                $range = array_merge($range, config('password.' . $key));
            }
        }
        shuffle($range);

        return $this->success([
            'password' => substr(implode('', $range), 0, \request()->get('size'))
        ]);
    }
}
