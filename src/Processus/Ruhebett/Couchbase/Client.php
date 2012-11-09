<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/18/12
 * Time: 8:07 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Ruhebett\Couchbase;
class Client extends \Processus\Ruhebett\Memcached\ClientJson
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
     * @return Client|\Processus\Ruhebett\Memcached\Client
     */
    public function initClient()
    {
        $this->client = new \Couchbase($this->getHost() . ":" . $this->getPort(),
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
     * @param $design
     * @param $view
     * @param array $params
     * @return mixed
     */
    public function getView($design, $view, array $params = null)
    {
        return $this->getMemDCli()->view($design, $view, $params);
    }

    /**
     * @return Client
     */
    public function foo()
    {
        return $this;
    }

}
