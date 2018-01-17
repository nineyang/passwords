<?php
/**
 * User: Nine
 * Date: 2018/1/17
 * Time: 下午2:43
 */

namespace App\Values;


class Box extends BaseValue
{
    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getIcon()
    {
        return config('box.icon.' . $this->type);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return mb_substr($this->title, 0, 5) . '...';
    }

}