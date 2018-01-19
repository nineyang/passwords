<?php
/**
 * User: Nine
 * Date: 2018/1/19
 * Time: 下午5:23
 */

namespace App\Values;


class Password extends BaseValue
{
    /**
     * @return null|string
     */
    public function getUrl()
    {
        return strrpos($this->url, 'http') === false ? 'http://' . $this->url : $this->url;
    }

    /**
     * @return null|string
     */
    public function getSubAccount()
    {
        if (mb_strlen($this->account) > 30) {
            return mb_substr($this->account, 0, 30) . '...';
        }
        return $this->account;
    }
}