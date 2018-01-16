<?php
/**
 * User: Nine
 * Date: 2018/1/15
 * Time: 上午11:20
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * 获取正常数据
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null|static[]
     */
    public function checkAndGet($id)
    {
        $class_name = static::class;
        $value = static::find($id);
        $parts = explode('\\', $class_name);
        $status = config("status." . strtolower(array_pop($parts)) . 's');
        if ($value->status == $status['available']) {
            return $value;
        } else {
            return NULL;
        }
    }
}