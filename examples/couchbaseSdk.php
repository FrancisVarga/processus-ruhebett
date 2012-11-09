<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hippsterkiller
 * Date: 10/26/12
 * Time: 12:56 AM
 * To change this template use File | Settings | File Templates.
 */

require __DIR__ . "/../vendor/autoload.php";

echo "=== Start Couchbase SDK ===". PHP_EOL;

$start = microtime(true);

$data = array("data" => "bar", "created" => time(), 0);
$key = "foo";
$expired = 0;

$cb = new \Processus\Ruhebett\Couchbase\Client();   // init client
$cb->setHost("192.168.42.18");                      // set specific host
$cb->setBucket("default")                           // set bucket
    ->setUsername("Administrator")                  // set username
    ->setPassword("Administrator")                  // set password
    ->setPort("8091")                               // set port of Couchbase
    ->initClient()                                  // initialise the client (mandatory)
    ->insert($key, $data, $expired);                // storing data into the client 0 = never expired


$data = $cb->fetch($key);                           // fetching key
var_dump($data);

$data['update'] = time();                           // adding update timestamp
$cb->update($key, $data, $expired);                 // update data, you can also use update internal use it set

$data = $cb->fetch($key);                           // fetch data again with the update key
var_dump($data);

$autoIncKey = $key . ":autoinc";
if($cb->getMemDCli()->get($autoIncKey) == null)
{
    $cb->getMemDCli()->set($autoIncKey, 0, 0);
}

$inc = $cb->increment($autoIncKey, 1);
var_dump($inc);

$end = microtime(true);
$duration = $end - $start;
echo "Duration: " . $duration . PHP_EOL;
echo "=== End Couchbase SDK ===". PHP_EOL;