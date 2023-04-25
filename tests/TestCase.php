<?php
namespace Tests;
use PHPUnit\Framework\TestCase as PHPUnit;

class TestCase extends PHPunit {

    // dump variable
    protected static function dump(array $variabel): void {
        fwrite(STDOUT, print_r($variabel, true));
    }
}
