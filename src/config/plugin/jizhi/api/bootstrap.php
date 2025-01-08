<?php
return config('plugin.jizhi.api.app.sql_monitor_enable') ? [\Api\bootstrap\SqlMonitor::class] : [];
