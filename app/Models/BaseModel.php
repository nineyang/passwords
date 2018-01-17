<?php
/**
 * User: Nine
 * Date: 2018/1/15
 * Time: 上午11:20
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
        if ($value && $value->status == $status['available']) {
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

    /**
     * 添加数据
     * @param Request $request
     * @param string $status
     * @return $this|Model
     */
    public function add(Request $request, $status = 'available')
    {
        $add = array_merge($request->all(), [
            'user_id' => auth()->id(),
            'status' => $this->getStatus()[$status],
            'created_at' => time(),
            'updated_at' => time()
        ]);

        return $this->create($add);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function updateWithTime(Request $request)
    {
        $update = array_merge($request->all(), [
            'updated_at' => time()
        ]);

        return $this->update($update);
    }

    /**
     * @param array $input
     * @param array $output
     * @return array
     */
    public function prepare(array $input, array $output)
    {
        $class_name = static::class;
        $parts = explode('\\', $class_name);
        $value_class = 'App\Values\\' . array_pop($parts);
        if (class_exists($value_class)) {
            return (new $value_class($input, $output))->handler();
        }
        return $output;
    }
}