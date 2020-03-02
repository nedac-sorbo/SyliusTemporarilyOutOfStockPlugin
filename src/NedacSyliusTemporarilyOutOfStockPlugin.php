<?php

declare(strict_types=1);

namespace Nedac\SyliusTemporarilyOutOfStockPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class NedacSyliusTemporarilyOutOfStockPlugin extends Bundle
{
    use SyliusPluginTrait;
}
