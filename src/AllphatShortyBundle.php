<?php

namespace Allphat\ShortyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AllphatShortyBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
