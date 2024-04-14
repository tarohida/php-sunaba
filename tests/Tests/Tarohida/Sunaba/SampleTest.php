<?php

namespace Tests\Tarohida\Sunaba;

use PHPUnit\Framework\TestCase;
use Tarohida\Sunaba\Sample;

class SampleTest extends TestCase
{
    public function test_Sample() {
        $this->assertTrue(Sample::returnTrue());
    }

    public function test_call_sample() {
        $this->assertSame("You called sample function.", Sample::sampleFunc());
    }

    public static function thisIsNotTestFunction(): string
    {
        return 'You called ' . __METHOD__;
    }
}
