<?php

namespace Tests\Allĥat\Bundle\ShortyBundle\Shortener;

use Allĥat\Bundle\ShortyBundle\Shortener\Shortener;

class ShortenerTest extends \PHPUnit\Framework\TestCase
{
    public function testGenerateRamdomCode()
    {
        $this->assertRegexp('/\w{6}/', Shortener::generateRandomCode());
    }
}
