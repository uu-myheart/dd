<?php

use Garan\Dumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

if (!function_exists('dd')) {
    function dd(...$args)
    {
        if (\in_array(\PHP_SAPI, ['cli', 'phpdbg'], true)) {
            $dumper = new CliDumper();
        } else {
            $trace = debug_backtrace();

            $args = array_merge([$trace[0]['file'].':'.$trace[0]['line']], $args);

            $dumper = new Dumper();
        }

        $cloner = new VarCloner();

        foreach ($args as $x) {
            $dumper->dump($cloner->cloneVar($x));
        }

        die(1);
    }
}
