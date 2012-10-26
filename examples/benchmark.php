<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hippsterkiller
 * Date: 10/26/12
 * Time: 1:38 AM
 * To change this template use File | Settings | File Templates.
 */

require __DIR__ . "/../src/Processus/Interfaces/NoSQLInterface.php";
require __DIR__ . "/../src/Processus/Memcached/Client.php";
require __DIR__ . "/../src/Processus/Memcached/ClientJson.php";
require __DIR__ . "/../src/Processus/Couchbase/Client.php";

$startTotalTime = microtime(true);
$totalIteration = 1;

$rawData = array(
    "firstname" => "Francis",
    "lastname"  => "Varga",
    "email"     => "fv@crowdpark.com",
    "fbUrl"     => "https://www.facebook.com/francis.varga.87",
    "github"    => "https://www.github.com/FrancisVarga",
    "blog"      => "http://www.varga-multimedia.com",
    "lang"      => array("python", "php", "js", "erlang", "as3"),
    "gender"    => "male",
    "birthday"  => "18.04.1987"
);

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Starting CouchbaseSDK
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$couchbaseSDK  = new \Processus\Couchbase\Client();
$couchbaseSDK->setBucket("test")
    ->setUsername("Administrator")
    ->setPassword("Administrator")
    ->setPort("8091")
    ->initClient();

$startCouchSdk = microtime(true);
for($i = 0; $i <= $totalIteration; $i++)
{
    $key = "couch:" . $i;
    $couchbaseSDK->insert($key, $rawData, 0);
    $couchbaseSDK->fetch($key);
}
$endCouchSdk = microtime(true);
$durationCouchSdk = $endCouchSdk - $startCouchSdk;
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// End CouchbaseSDK
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Starting MemcachedJson
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$memcachedJson = new \Processus\Memcached\ClientJson();
$memcachedJson->setPort("11711")
              ->initClient();

$startMemJson = microtime(true);
for($i = 0; $i <= $totalIteration; $i++)
{
    $key = "memjson:" . $i;
    $memcachedJson->insert($key, $rawData, 0);
    $memcachedJson->fetch($key);
}
$endMemJson = microtime(true);
$durationMemJson = $endMemJson - $startMemJson;
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// End MemcachedJson
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Starting MemcachedRaw
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$memcachedRaw  = new \Processus\Memcached\Client();
$memcachedRaw->setPort("11711")
             ->initClient();

$startMemRaw = microtime(true);
for($i = 0; $i <= $totalIteration; $i++)
{
    $key = "memraw:" . $i;
    $memcachedRaw->insert($key, $rawData, 0);
    $memcachedRaw->fetch($key);
}
$endMemRaw = microtime(true);
$durationMemRaw = $endMemRaw - $startMemRaw;
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// End MemcachedRaw
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$endTotalTime = microtime(true);
$durationTotal = $endTotalTime - $startTotalTime;
echo "====================================================" . PHP_EOL;
echo "CouchSdk:         " . $durationCouchSdk  . "      //  " . $durationCouchSdk   / $totalIteration .   " item/sec.   => " . $totalIteration . PHP_EOL;
echo "Memcached Raw:    " . $durationMemRaw    . "      //  " . $durationMemRaw     / $totalIteration   .   " item/sec. => " . $totalIteration . PHP_EOL;
echo "Memcached Json:   " . $durationMemJson   . "      //  " . $durationMemJson    / $totalIteration  .   " item/sec.  => " . $totalIteration . PHP_EOL;
echo "====================================================" . PHP_EOL;
echo "Total Duration:   " . $durationTotal . PHP_EOL;