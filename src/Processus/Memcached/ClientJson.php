<?php

namespace Processus\Memcached;
class ClientJson extends Client
{
    /**
     * @param string $key
     * @return mixed
     */
    public function fetch($key)
    {
        return json_decode(parent::fetch($key), true);
    }

    /**
     * @param string $key
     * @param array $value
     * @param int $expired
     * @return bool|mixed
     * @throws \Exception
     */
    public function insert($key, $value, $expired = 1)
    {
        if (is_array($value) || is_string($value)) {
            return parent::insert($key, json_encode($value), $expired);
        } else {
            throw new \Exception("Can't json_encode value!");
        }
    }

    /**
     * @param array $keys
     *
     * @return mixed
     */
    public function getMultipleByKey(array $keys)
    {
        $stupidPHP = null;

        return json_decode(parent::getMulti($keys, $stupidPHP, \Memcached::GET_PRESERVE_ORDER), true);
    }

    /**
     * @param string $key
     * @param array $value
     * @param int $expired
     * @return mixed|void
     */
    public function update($key, array $value, $expired = 1)
    {
        return $this->insert($key, $value, $expired);
    }
}

?>