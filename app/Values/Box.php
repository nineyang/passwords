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
        if (mb_strlen($this->title) > 5) {
            return mb_substr($this->title, 0, 5) . '...';
        }
        return $this->title;
    }

}