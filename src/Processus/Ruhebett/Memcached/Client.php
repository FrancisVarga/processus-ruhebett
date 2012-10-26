<?php

namespace Processus\Memcached;
class Client implements \Processus\Interfaces\NoSQLInterface
{
    /**
     * @var
     */
    protected $host = "127.0.0.1";

    /**
     * @var
     */
    protected $port = "11211";

    /**
     * @var \Memcached
     */
    protected $_memcachedClient;

    /**
     * @return array
     */
    public function getStats()
    {
        return $this->getMemDCli()->getStats();
    }

    /**
     * @param  $host
     * @return mixed
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return \Memcached
     */
    public function getMemDCli()
    {
        return $this->_memcachedClient;
    }

    /**
     * @param  $key
     * @return mixed
     */
    public function fetch($key)
    {
        return $this->getMemDCli()->get($key);
    }

    /**
     * @param array $list
     * @return mixed
     */
    public function fetchAll(array $list)
    {
        return $this->getMemDCli()->getMulti($list);
    }

    /**
     * @param string $key
     * @param array $value
     * @param int $expired
     * @return bool|mixed
     */
    public function insert($key, $value, $expired = 1)
    {
        return $this->getMemDCli()->set($key, $value, $expired);
    }

    /**
     * Flush the whole database
     * @return mixed
     */
    public function flushAll()
    {
        return $this->getMemDCli()->flush();
    }

    /**
     * Delete a value
     * @param string $key
     * @return mixed
     */
    public function delete($key)
    {
        return $this->getMemDCli()->delete($key);
    }

    /**
     * @return \Processus\Interfaces\NoSQLInterface|Client
     */
    public function initClient()
    {
        $this->_memcachedClient = new \Memcached();
        $this->getMemDCli()->addServer($this->getHost(), $this->getPort());

        $this->setOption(\Memcached::OPT_COMPRESSION, FALSE);
        $this->setOption(\Memcached::OPT_CONNECT_TIMEOUT, 500);
        $this->setOption(\Memcached::OPT_TCP_NODELAY, TRUE);
        $this->setOption(\Memcached::OPT_NO_BLOCK, TRUE);
        $this->setOption(\Memcached::OPT_POLL_TIMEOUT, 500);

        return $this;
    }

    /**
     * @param string $host
     * @param string $port
     * @param int $weight
     * @return Client
     */
    public function addServer($host = "127.0.0.1", $port = "11211", $weight = 0)
    {
        $this->getMemDCli()->addServer($host, $port, $weight);

        return $this;
    }

    /**
     * @param $port
     * @return mixed|Client
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @param string $key
     * @param array $value
     * @param int $expired
     * @return mixed|void
     */
    public function update($key, array $value, $expired = 1)
    {
        return $this->getMemDCli()->set($key, $value, $expired);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setOption($key, $value)
    {
        $this->getMemDCli()->setOption($key, $value);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }
}

?>