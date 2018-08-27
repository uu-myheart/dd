<?php

use Garan\Dumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;

if (!function_exists('dd')) {
    function dd(...$args)
    {
        $trace = debug_backtrace();

        $args = array_merge([$trace[0]['file'].':'.$trace[0]['line']], $args);
        
        foreach ($args as $x) {
            (new Dumper)->dump((new VarCloner)->cloneVar($x));
        }

        die(1);
    }
}
