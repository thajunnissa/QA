<?php
include '/home/thajunnissa/FashionReRun/live/config/importer.php';
if (file_exists($projectRootPAth . '/etc/env.php')) {
    include $projectRootPAth . '/etc/env.php';
}

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        return $value;
    }
}
