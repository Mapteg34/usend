<?php

namespace App;

use App\Adapters\AdDaemonRepositoryAdapter;
use App\Adapters\AdMysqlRepositoryAdapter;
use App\Adapters\AdRepositoryInterface;

class AdRepositoryFactory
{
    const FROM_MYSQL = 'mysql';
    const FROM_DAEMON = 'daemon';
    const FROM_ENUM = [
        self::FROM_MYSQL  => AdMysqlRepositoryAdapter::class,
        self::FROM_DAEMON => AdDaemonRepositoryAdapter::class,
    ];

    /**
     * @param string $from
     *
     * @return AdRepositoryInterface
     * @throws \Exception
     */
    public function make(string $from): AdRepositoryInterface
    {
        if (!$from || !isset(static::FROM_ENUM[$from])) {
            throw new \Exception('Invalid from');
        }

        $adapterClass = static::FROM_ENUM[$from];

        return new $adapterClass();
    }
}