This plugin adds a ribbon clarifying that a product is out of stock to the product cards and main image on the product detail page.

![Product Card](product_card.png)
![Product Detail](product_detail.png)

##### Supported Sylius versions:
<table>
    <tr><td>1.9</td></tr>
</table>


> **_NOTE:_** *This plugin requires PHP 7.4 or up*

#### Installation:

1. Install using composer:
    ```bash
    composer require nedac/sylius-temporarily-out-of-stock-plugin
    ```

2. If the `ProductRepository` is overridden in the project, then make sure it uses the `trait`:
    ```php
    <?php

    # src/Repository/ProductRepository.php

    declare(strict_types=1);

    namespace App\Repository;

    use Nedac\SyliusTemporarilyOutOfStockPlugin\Repository\ProductRepositoryTrait;
    use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;

    final class ProductRepository extends BaseProductRepository {
       use ProductRepositoryTrait;
    }
    ```

    If the `ProductRepository` is *not* overridden in the project, please use the repository of this plugin:
    ```yaml
    # config/packages/_sylius.yaml

    # ...

    sylius_product:
        resources:
            product:
                classes:
                    repository: Nedac\SyliusTemporarilyOutOfStockPlugin\Repository\ProductRepository

    # ...
    ```

3. Install assets:
    ```bash
    bin/console sylius:install:assets
    ```
