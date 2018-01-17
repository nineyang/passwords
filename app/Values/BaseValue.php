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
     * BaseValue constructor.
     * @param $input
     * @param $output
     */
    public function __construct($input, $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @return array
     */
    public function handler()
    {
        $return = [];
        foreach ($this->output as $item) {
//            if (strrpos($item, ':') !== false) {
//                list($key, $value) = explode(':', $item);
//            }
            $method = 'get' . implode('', array_map('ucfirst', explode('_', $item)));
            if (method_exists(static::class, $method)) {
                $return[$item] = $this->{$method}($this->input[$item] ?? NULL);
            } elseif (isset($this->input[$item])) {
                $return[$item] = $this->input[$item];
            } else {
                $return[$item] = NULL;
            }
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
        return $this->input[$key] ?? NULL;
    }
}