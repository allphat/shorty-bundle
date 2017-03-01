<?php

namespace Tests\Alphat\Bundle\ShortyBundle\Shortener;

use Alphat\Bundle\ShortyBundle\Shortener\Shortener;

class ShortenerTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateRamdomCode()
    {
        $this->assertRegexp('/\w{6}/', Shortener::generateRandomCode());
    }
}
