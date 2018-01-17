<?php


namespace App\Values;
/**
 * User: Nine
 * Date: 2018/1/17
 * Time: 下午2:30
 */
class BaseValue
{
    /**
     * @var
     */
    public $input;

    /**
     * @var
     */
    public $output;

    /**
     * @var
     */
    public $temp;

    /**
     * BaseValue constructor.
     * @param $input
     * @param $output
     */
    public function __construct($input, $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->temp = NULL;
    }

    /**
     * @return array
     */
    public function handler()
    {
        $return = [];

        if (count($this->input) == count($this->input, COUNT_RECURSIVE)) {
            $this->input = [$this->input];
        }
        foreach ($this->input as $input) {
            $temp = [];
            $this->temp = $input;
            foreach ($this->output as $item) {
//            todo 后面可以加参数
//            if (strrpos($item, ':') !== false) {
//                list($key, $value) = explode(':', $item);
//            }
                $method = 'get' . implode('', array_map('ucfirst', explode('_', $item)));
                if (method_exists(static::class, $method)) {
                    $temp[$item] = $this->{$method}($input[$item] ?? NULL);
                } elseif (isset($input[$item])) {
                    $temp[$item] = $input[$item];
                } else {
                    $temp[$item] = NULL;
                }
            }
            $return[] = $temp;
        }

        return $return;
    }

    /**
     * @param $created_at
     * @return false|string
     */
    public function getCreatedAt($created_at)
    {
        return date('Y-m-d', $created_at);
    }

    /**
     * @param $updated_at
     * @return false|string
     */
    public function getUpdatedAt($updated_at)
    {
        return date('Y-m-d', $updated_at);
    }

    /**
     * @param $key
     * @return null
     */
    public function __get($key)
    {
        return $this->temp[$key] ?? NULL;
    }
}