processus-ruhebett
===================

german -> ruhebett = chillout bed;

[Couchbase](http://www.couchbase.com) client which use [Couchbase SDK](http://www.couchbase.com/develop/php/next) or / and [Memcached](http://php.net/manual/en/book.memcached.php).


###Requirements

Couchbase Server: [Download](www.couchbase.com/downloads-all)  
libcouchbase:     [Download](http://www.couchbase.com/develop/c/next)  
CouchbasSDK:      [Download](http://www.couchbase.com/develop/php/next)    

###API

All clients use the same **Interface** so you can chage the client without any problems.

```php
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
```

###Examples

[couchbasesdk](https://github.com/Crowdpark/processus-ruhebett/blob/master/examples/couchbaseSdk.php)    
[memcachedRaw](https://github.com/Crowdpark/processus-ruhebett/blob/master/examples/memcachedRaw.php)    
[memcachedJson](https://github.com/Crowdpark/processus-ruhebett/blob/master/examples/memcachedJson.php)    
[benchmark](https://github.com/Crowdpark/processus-ruhebett/blob/master/examples/benchmark.php)    

###License

Copyright (c) 2012 [Francis Varga](http://varga-multimedia.com)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the 'Software'), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
