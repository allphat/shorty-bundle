<?php

namespace Tests\Allphat\ShortyBundle\Shortener;

use Allphat\ShortyBundle\Shortener\Shortener;

class ShortenerTest extends \PHPUnit\Framework\TestCase
{
    public function testGenerateRamdomCode(): void
    {
        $this->assertMatchesRegularExpression('/\w{6}/', Shortener::generateRandomCode());
    }
}
