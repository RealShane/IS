<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2021/1/8 9:51
 */


namespace app\common\business\lib;


use Psr\SimpleCache\InvalidArgumentException;
use think\facade\Cache;

class Redis
{

    public function set($key, $value, $ttl = null){
        try {
            return Cache::store('redis') -> set($key, $value, $ttl);
        } catch (InvalidArgumentException $e) {
            return NULL;
        }
    }

    public function get($key){
        try {
            return Cache::store('redis') -> get($key);
        } catch (InvalidArgumentException $e) {
            return NULL;
        }
    }

    public function delete($key){
        try {
            return Cache::store('redis') -> delete($key);
        } catch (InvalidArgumentException $e) {
            return NULL;
        }
    }

}