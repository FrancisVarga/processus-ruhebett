<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hippsterkiller
 * Date: 10/26/12
 * Time: 12:56 AM
 * To change this template use File | Settings | File Templates.
 */

$start = microtime(true);

require __DIR__ . "/../src/Processus/Interfaces/NoSQLInterface.php";
require __DIR__ . "/../src/Processus/Memcached/Client.php";
require __DIR__ . "/../src/Processus/Memcached/ClientJson.php";
require __DIR__ . "/../src/Processus/Couchbase/Client.php";

$data = array("data" => "bar", "created" => time(), 0);
$key = "foo";
$expired = 0;

$cb = new \Processus\Couchbase\Client();// init client
$cb->setBucket("test")                  // set bucket
    ->setUsername("Administrator")      // set username
    ->setPassword("Administrator")      // set password
    ->setPort("8091")                   // set port of Couchbase
    ->initClient()                      // initialise the client (mandatory)
    ->insert($key, $data, $expired);    // storing data into the client 0 = never expired

$data = $cb->fetch($key);               // fetching key
var_dump($data);

$data['update'] = time();               // adding update timestamp
$cb->update($key, $data, $expired);     // update data, you can also use update internal use it set

$data = $cb->fetch($key);               // fetch data again with the update key
var_dump($data);

$end = microtime(true);
$duration = $end - $start;
echo "Duration: " . $duration . PHP_EOL;