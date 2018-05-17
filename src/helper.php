<?php

use Garan\Dumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;

if (!function_exists('dd')) {
    function dd(...$args)
    {
        foreach ($args as $x) {
            (new Dumper)->dump((new VarCloner)->cloneVar($x));
        }

        die(1);
    }
}
