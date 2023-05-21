<?php


if(!function_exists('env')){

    function env($key, $default = null)
    {
        return  \Tool\Env::getEnv($key, $default);
    }

}
