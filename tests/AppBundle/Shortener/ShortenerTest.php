<?php

namespace Tests\AppBundle\Shortener;

use AppBundle\Shortener\Shortener;

class ShortenerTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateLittleCode()
    {
        $this->assertRegexp('/\w{6}/', Shortener::generateLittleCode());
    }
}
