<?php

namespace Processus\Interfaces;
interface NoSQLInterface
{

    /**
     * @param  $host
     * @return NoSQLInterface
     */
    public function setHost($host);

    /**
     * @return mixed
     */
    public function getHost();

    /**
     * @param  $port
     * @return NoSQLInterface
     */
    public function setPort($port);

    /**
     * @return mixed
     */
    public function getPort();

    /**
     * @param  $key
     * @return mixed
     */
    public function fetch($key);

    /**
     * @param array $list
     * @return mixed
     */
    public function fetchAll(array $list);

    /**
     * @param string $key
     * @param array $value
     * @param int $expired
     * @return mixed
     */
    public function insert($key, $value, $expired = 1);

    /**
     * @param string $key
     * @param array $value
     * @param int $expired
     * @return mixed
     */
    public function update($key, array $value, $expired = 1);

    /**
     * Flush the whole database
     * @return mixed
     */
    public function flushAll();

    /**
     * Delete a value
     * @param string $key
     * @return mixed
     */
    public function delete($key);

    /**
     * @param $key
     * @param $value
     * @return NoSQLInterface
     */
    public function setOption($key, $value);

    /**
     * Initialised the client after setting the host / port / credentials
     * @return NoSQLInterface
     */
    public function initClient();
}

?>