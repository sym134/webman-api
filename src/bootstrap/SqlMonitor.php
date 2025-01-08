<?php

namespace Api\bootstrap;

use support\Db;
use Api\support\SqlRecord;
use Webman\Bootstrap;
use Workerman\Worker;

class SqlMonitor implements Bootstrap
{

    public static function start(?Worker $worker): void
    {
        if (config('app.debug')) {
            SqlRecord::listen();
        }
    }

    public function boot()
    {
        Db::createMigrationsTable();
    }
}
