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
     * 获取未分类的数量
     * @return int
     */
    public function getUnClassfiedCount()
    {
        $condition = [
            'user_id' => auth()->id(),
            'box_id' => 0
        ];

        return $this->where($condition)->count();
    }

    /**
     * @param $box_id
     * @param $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPasswordList($box_id, $status = 'available')
    {
        $condition = [
            'box_id' => $box_id,
            'user_id' => auth()->id(),
            'status' => $this->getStatus()[$status]
        ];

        return $this->where($condition)->get()->toArray();
    }
}
