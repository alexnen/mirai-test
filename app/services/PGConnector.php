<?php

namespace App\Services;

use App\Services\Interfaces\DB;

class PGConnector implements DB
{
    public function runQuery(string $query)
    {
        $name = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');

        $resourse = pg_connect("host=$host port=$port dbname=$name user=$user password=$password");;
        $query = pg_query($resourse, $query);

        $result = pg_fetch_all($query);

        pg_close($resourse);

        return $result;
    }
}