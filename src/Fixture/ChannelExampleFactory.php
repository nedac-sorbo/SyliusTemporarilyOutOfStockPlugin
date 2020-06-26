<?php

declare(strict_types=1);

namespace Nedac\SyliusTemporarilyOutOfStockPlugin\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\Factory\ChannelExampleFactory as BaseChannelExampleFactory;
use Sylius\Component\Core\Model\ChannelInterface;

final class ChannelExampleFactory extends BaseChannelExampleFactory
{
    public function create(array $options = []): ChannelInterface
    {
        $channel = parent::create($options);

        $channel->setThemeName('sylius/bootstrap-theme');

        return $channel;
    }
}
