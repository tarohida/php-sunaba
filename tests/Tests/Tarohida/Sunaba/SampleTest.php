<?php

namespace Tests\Tarohida\Sunaba;

use PHPUnit\Framework\TestCase;
use Tarohida\Sunaba\Sample;

class SampleTest extends TestCase
{
    public function test_Sample() {
        $this->assertTrue(Sample::returnTrue());
    }
}
