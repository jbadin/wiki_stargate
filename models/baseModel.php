<?php

require_once 'ressources/credentials.php';

class BaseModel
{
    protected $pdo = NULL;
    protected string $prefix = 'gc5dx_';

    protected function connectDb(): void
    {
        $this->pdo = new PDO(dsn: 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', username: DB_USER, password: DB_PASS);
    }
}