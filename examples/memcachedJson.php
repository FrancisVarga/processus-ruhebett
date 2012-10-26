<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hippsterkiller
 * Date: 10/26/12
 * Time: 12:56 AM
 * To change this template use File | Settings | File Templates.
 */

require __DIR__ . "/../vendor/autoload.php";

echo "=== Start Memcached JSON ===". PHP_EOL;

$start = microtime(true);

$data = array("data" => "bar", "created" => time(), 0);
$key = "memFoo";
$expired = 0;

$cb = new \Processus\Ruhebett\Memcached\ClientJson();   // init client
$cb->setHost("192.168.42.18");                          // set specific host
$cb->setPort("11211");                                  // set a specific port default is **11211**
$cb->initClient();                                      // initialise the client (**mandatory**)
$cb->insert($key, $data, $expired);                     // storing data into the client 0 = never expired

$data = $cb->fetch($key);                               // fetching key
var_dump($data);

$data['update'] = time();                               // adding update timestamp
$cb->update($key, $data, $expired);                     // update data, you can also use update internal use it set

$data = $cb->fetch($key);                               // fetch data again with the update key
var_dump($data);

$end = microtime(true);
$duration = $end - $start;
echo "Duration: " . $duration . PHP_EOL;

echo "=== End Memcached JSON ===". PHP_EOL;