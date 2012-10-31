<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mirceapreotu
 * Date: 8/14/12
 * Time: 4:10 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Ruhebett\Utils;
class CouchbaseUtil
{
    /** @var string */
    private $_design;
    /**
     * @var string
     */
    private $_view;
    /**
     * @var int
     */
    private $_port = 8092;
    /**
     * @var string
     */
    private $_hostName;
    /**
     * @var string
     */
    private $_bucketName = "default";
    /**
     * @var string
     */
    private $_apiUrl;

    /**
     * @var string
     */
    private $_lastDataUrl;

    /**
     * @return string
     */
    private function _getCouchbaseApiUrl()
    {
        return "http://" . $this->getHostName() . ':' . $this->getPort() . "/" . $this->getBucketName() . "/_design/" . $this->getDesign() . "/_view/" . $this->getView();
    }


    /**
     * @param $params
     *
     * @return mixed
     */
    public function fetchView($params)
    {
        if ($this->getApiUrl()) {
            $dataUrl = $this->getApiUrl();
        } else {

            $queryString = array();
            foreach ($params as $key => $value) {
                if (isset($value)) {
                    if (is_array($value) || is_bool($value)) {
                        $value = json_encode($value);
                    }
                    $queryString[] = "$key=$value";
                }
            }

            $queryString = implode('&', $queryString);
            $dataUrl     = $this->_getCouchbaseApiUrl() . "?" . $queryString;
        }

        $response = json_decode(file_get_contents($dataUrl), true); // curl???
        $this->setLastDataUrl($dataUrl); // store last url for debugging

        return $response;
    }

    /**
     * @return string
     */
    public function getLastDataUrl()
    {
        return (string)$this->_lastDataUrl;
    }

    /**
     * @param $lastUrl
     * @return CouchbaseUtil
     */
    protected function setLastDataUrl($lastUrl)
    {
        $this->_lastDataUrl = $lastUrl;

        return $this;
    }

    /**
     * @param $design
     * @return CouchbaseUtil
     */
    public function setDesign($design)
    {
        $this->_design = $design;

        return $this;
    }

    /**
     * @return string
     */
    public function getDesign()
    {
        return $this->_design;
    }

    /**
     * @param $view
     * @return CouchbaseUtil
     */
    public function setView($view)
    {
        $this->_view = $view;

        return $this;
    }

    /**
     * @return string
     */
    public function getView()
    {
        return $this->_view;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * @param $port
     * @return CouchbaseUtil
     */
    public function setPort($port)
    {
        $this->_port = $port;

        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getHostName()
    {
        if (!$this->_hostName) {
            throw new \Exception("Hostname missing!");
        }

        return $this->_hostName;
    }

    /**
     * @param $hostName
     * @return CouchbaseUtil
     */
    public function setHostName($hostName)
    {
        $this->_hostName = $hostName;

        return $this;
    }

    /**
     * @param $bucketName
     * @return CouchbaseUtil
     */
    public function setBucketName($bucketName)
    {
        $this->_bucketName = $bucketName;

        return $this;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getBucketName()
    {
        if (!$this->_bucketName) {
            throw new \Exception("Bucket name missing!");
        }

        return $this->_bucketName;
    }

    /**
     * @param $apiUrl
     * @return CouchbaseUtil
     */
    public function setApiUrl($apiUrl)
    {
        $this->_apiUrl = $apiUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->_apiUrl;
    }
}