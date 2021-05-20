<?php

declare(strict_types=1);

namespace App\Views;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigUtilities extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('test',[$this,'test'])
        ];
    }

    public function test()
    {
        return 'test message';
    }
}