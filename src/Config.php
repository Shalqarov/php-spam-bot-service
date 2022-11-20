<?php

namespace App;
/**
 * @property-read ?array $db
 */
class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db'      => [
                'host'     => $env['DB_HOST'],
                'user'     => $env['DB_USER'],
                'password' => $env['DB_PASSWORD'],
                'dbname'   => $env['DB_DATABASE'],
                'driver'   => $env['DB_DRIVER'] ?? 'pdo_mysql',
            ],
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}