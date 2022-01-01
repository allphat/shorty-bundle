<?php

namespace Tests\Allphat\Bundle\ShortyBundle\Shortener;

use Allphat\Bundle\ShortyBundle\Shortener\Shortener;

class ShortenerTest extends \PHPUnit\Framework\TestCase
{
    public function testGenerateRamdomCode(): void
    {
        $this->assertMatchesRegularExpression('/\w{6}/', Shortener::generateRandomCode());
    }
}
