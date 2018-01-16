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
     * 获取状态信息
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function getStatus()
    {
        $class_name = static::class;
        $parts = explode('\\', $class_name);
        return config("status." . strtolower(array_pop($parts)));
    }

    /**
     * 获取单个正常数据
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null|static[]
     */
    public function checkAndGet($id)
    {
        $value = static::find($id);
        $status = $this->getStatus();
        if ($value->status == $status['available']) {
            return $value;
        } else {
            return NULL;
        }
    }

    /**
     * 获取全部正常数据
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function listByStatus($status = 'available')
    {
        $condition = [
            'user_id' => auth()->id(),
            'status' => $this->getStatus()[$status]
        ];
        return $this->where($condition)->get();
    }
}