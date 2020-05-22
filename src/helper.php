<?php

use Garan\Dumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

if (!function_exists('dd')) {
    function dd(...$args)
    {
        $dumper = \in_array(\PHP_SAPI, ['cli', 'phpdbg'], true)
            ? new CliDumper()
            : new Dumper();

        $trace = debug_backtrace();
        $args = array_merge([$trace[0]['file'].':'.$trace[0]['line']], $args);

        $cloner = new VarCloner();

        foreach ($args as $x) {
            $dumper->dump($cloner->cloneVar($x));
        }

        die(1);
    }
}
