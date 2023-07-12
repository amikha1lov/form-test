<?php

namespace App;

use PDO;

class Db
{

    protected static $instance = null;

    protected PDO $dbh;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __construct()
    {
        $this->dbh = new \PDO('mysql:host=' .$_ENV["DB_HOST"]. ';dbname=' . $_ENV["DB_NAME"] . ';', $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
    }

    public function query($sql, $class, $params = []): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function execute($sql, $params): bool
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);
    }

    public function lastId()
    {
        return $this->dbh->lastInsertId();
    }

}
