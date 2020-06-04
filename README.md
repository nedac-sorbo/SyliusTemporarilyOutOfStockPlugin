<div class="repo-badge inline-block vertical-align">
    <a id="status-image-popup" title="Latest push build on default branch: created" name="status-images" class="pointer open-popup">
        <img src="https://travis-ci.com/nedac-sorbo/SyliusTemporarilyOutOfStockPlugin.svg?branch=master" alt="build:created">
    </a>
</div>

This plugin adds a ribbon clarifying that a product is out of stock to the product cards and main image on the product detail page.

![Product Card](product_card.png)
![Product Detail](product_detail.png)

##### Supported Sylius versions:
<table>
    <tr><td>1.6</td></tr>
    <tr><td>1.7</td></tr>
</table>


> **_NOTE:_** *This plugin requires PHP 7.4 or up*

#### Installation:

1. Install using composer:
    ```bash
    composer require nedac/sylius-temporarily-out-of-stock-plugin
    ```
2. Add bundle to bundles.php:
    ```php
    <?php

    return [
        // ...
        Nedac\SyliusTemporarilyOutOfStockPlugin\NedacSyliusTemporarilyOutOfStockPlugin::class => ['all' => true],
    ];
    ```
3. Override templates:
    ```twig
    {# templates/bundles/SyliusShopBundle/Product/_box.html.twig #}
    {% import "@SyliusShop/Common/Macro/money.html.twig" as money %}
    
    {{ sonata_block_render_event('sylius.shop.product.index.before_box', {'product': product}) }}
    
    <div class="ui fluid card">
        {% if not nedac_inventory_is_available(product.variants) %}
            <a class="ui ribbon label nedac-out-of-stock-plugin-card-ribbon">{{ 'nedac.ui.temporarily_out_of_stock'|trans }}</a>
        {% endif %}
        <a href="{{ path('sylius_shop_product_show', {'slug': product.slug, '_locale': product.translation.locale}) }}" class="blurring dimmable image">
            <div class="ui dimmer">
                <div class="content">
                    <div class="center">
                        <div class="ui inverted button">{{ 'sylius.ui.view_more'|trans }}</div>
                    </div>
                </div>
            </div>
            {% include '@SyliusShop/Product/_mainImage.html.twig' with {'product': product} %}
        </a>
        <div class="content">
            <a href="{{ path('sylius_shop_product_show', {'slug': product.slug, '_locale': product.translation.locale}) }}" class="header sylius-product-name">{{ product.name }}</a>
            {% if not product.variants.empty() %}
                <div class="sylius-product-price">{{ money.calculatePrice(product|sylius_resolve_variant) }}</div>
            {% endif %}
        </div>
    </div>
    
    {{ sonata_block_render_event('sylius.shop.product.index.after_box', {'product': product}) }}
    ```
    ```twig
    {# templates/bundles/SyliusShopBundle/Product/Show/_images.html.twig #}
    {% if product.imagesByType('main') is not empty %}
        {% set source_path = product.imagesByType('main').first.path %}
        {% set original_path = source_path|imagine_filter('sylius_shop_product_original') %}
        {% set path = source_path|imagine_filter(filter|default('sylius_shop_product_large_thumbnail')) %}
    {% elseif product.images.first %}
        {% set source_path = product.images.first.path %}
        {% set original_path = source_path|imagine_filter('sylius_shop_product_original') %}
        {% set path = source_path|imagine_filter(filter|default('sylius_shop_product_large_thumbnail')) %}
    {% else %}
        {% set original_path = '//placehold.it/400x300' %}
        {% set path = original_path %}
    {% endif %}
    
    <div data-product-image="{{ path }}" data-product-link="{{ original_path }}"></div>
    <div class="ui fluid image" data-lightbox="sylius-product-image" id="nedac-out-of-stock-product-image">
        {% if not nedac_inventory_is_available(product.variants) %}
            <a class="ui large ribbon label" id="nedac-out-of-stock-ribbon">
                {{ 'nedac.ui.temporarily_out_of_stock'|trans }}
            </a>
        {% endif %}
        <a href="{{ original_path }}">
            <img src="{{ path }}" id="main-image" alt="{{ product.name }}" />
        </a>
    </div>
    {% if product.images|length > 1 %}
        <div class="ui divider"></div>
    
        {{ sonata_block_render_event('sylius.shop.product.show.before_thumbnails', {'product': product}) }}
    
        <div class="ui small images">
            {% for image in product.images %}
                {% set path = image.path is not null ? image.path|imagine_filter('sylius_shop_product_small_thumbnail') : '//placehold.it/200x200' %}
                <div class="ui image">
                    {% if product.isConfigurable() and product.variants|length > 0 %}
                        {% include '@SyliusShop/Product/Show/_imageVariants.html.twig' %}
                    {% endif %}
                    <a href="{{ image.path|imagine_filter('sylius_shop_product_original') }}" data-lightbox="sylius-product-image">
                        <img src="{{ path }}" data-large-thumbnail="{{ image.path|imagine_filter('sylius_shop_product_large_thumbnail') }}" alt="{{ product.name }}" />
                    </a>
                </div>
            {% endfor %}
        </div>
    {% endif %}
    ```
4. Install assets:
    ```bash
    bin/console sylius:install:assets
    ```

That's it, just four easy steps!

#### Setup development environment:
```bash
docker-compose build
docker-compose up -d
docker-compose exec php composer --working-dir=/srv/sylius install
docker-compose run --rm nodejs yarn --cwd=/srv/sylius/tests/Application install
docker-compose run --rm nodejs yarn --cwd=/srv/sylius/tests/Application build
docker-compose exec php bin/console assets:install public
docker-compose exec php bin/console doctrine:schema:create
docker-compose exec php bin/console sylius:fixtures:load -n
```
#### Running tests:
```bash
docker-compose exec php sh
cd ../..
vendor/bin/phpunit
vendor/bin/behat
```
