<?php

declare(strict_types=1);

namespace Nedac\SyliusTemporarilyOutOfStockPlugin\Repository;

use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;

final class ProductRepository extends BaseProductRepository
{
    use ProductRepositoryTrait;
}
