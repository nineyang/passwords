<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password extends BaseModel
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'url', 'box_id', 'safety_level', 'title', 'description', 'account', 'password', 'sort', 'status',
        'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @param $box_id
     * @param $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPasswordList($box_id = 0, $status = 'available')
    {
        $condition = [
            'user_id' => auth()->id(),
            'status' => $this->getStatus()[$status]
        ];

        if ($box_id) {
            $condition['box_id'] = $box_id;
        }

        return $this->where($condition)->get()->toArray();
    }
}
