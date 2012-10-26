<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/18/12
 * Time: 8:07 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Ruhebett\Couchbase;
class Client extends \Processus\Memcached\ClientJson
{
    /**
     * @var string
     */
    private $password = "Administrator";
    /**
     * @var string
     */
    private $username = "Administrator";
    /**
     * @var string
     */
    private $bucket = "default";
    /**
     * @var \Couchbase
     */
    private $couchbaseClient;

    /**
     * @param string $user
     * @return Client
     */
    public function setUsername($user)
    {
        $this->username = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        $this->username;
    }

    /**
     * @param string $password
     * @return Client
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return Client|\Processus\Interfaces\NoSQLInterface|\Processus\Memcached\Client
     */
    public function initClient()
    {
        $this->couchbaseClient = new \Couchbase($this->getHost() . ":" . $this->getPort(),
            $this->getUsername(), $this->getPassword(), $this->getBucket());

        return $this;
    }

    /**
     * @param string $bucket
     * @return Client
     */
    public function setBucket($bucket)
    {
        $this->bucket = $bucket;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBucket()
    {
        return $this->bucket;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function fetch($key)
    {
        return json_decode($this->couchbaseClient->get($key), true);
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
            return $this->couchbaseClient->set($key, json_encode($value), $expired);
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

        return json_decode($this->couchbaseClient->getMulti($keys, $stupidPHP, \Memcached::GET_PRESERVE_ORDER), true);
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
