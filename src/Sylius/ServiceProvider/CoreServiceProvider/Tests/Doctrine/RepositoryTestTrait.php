<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Nikos Papagiannopoulos
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Tests\Doctrine;

use App\Application;
use PrintPlanet\Sylius\ServiceProvider\AddressingServiceProvider\SyliusAddressingServiceProvider;
use PrintPlanet\Sylius\ServiceProvider\AttributeServiceProvider\SyliusAttributeServiceProvider;
use PrintPlanet\Sylius\ServiceProvider\ChannelServiceProvider\SyliusChannelServiceProvider;
use PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\SyliusCoreServiceProvider;
use PrintPlanet\Sylius\ServiceProvider\CurrencyServiceProvider\SyliusCurrencyServiceProvider;
use PrintPlanet\Sylius\ServiceProvider\ProductServiceProvider\SyliusProductServiceProvider;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\SyliusResourceServiceProvider;
use PrintPlanet\Sylius\ServiceProvider\TaxonomyServiceProvider\SyliusTaxonomyServiceProvider;
use PrintPlanet\Sylius\ServiceProvider\LocaleServiceProvider\SyliusLocaleServiceProvider;

/**
 * @deprecated Will be removed in v1.0.0
 */
trait RepositoryTestTrait
{
    /**
     * @var string
     */
    public $locale = 'en_US';

    /**
     * @throws \PP_Exception
     * @throws \Exception
     */
    public function registerServiceProviders(): void
    {
        $app = new Application();
        (new SyliusAddressingServiceProvider())->register($app);
        (new SyliusAttributeServiceProvider())->register($app);
        (new SyliusChannelServiceProvider())->register($app);
        (new SyliusCoreServiceProvider())->register($app);
        (new SyliusCurrencyServiceProvider())->register($app);
        (new SyliusLocaleServiceProvider())->register($app);
        (new SyliusProductServiceProvider())->register($app);
        (new SyliusTaxonomyServiceProvider())->register($app);

        (new SyliusResourceServiceProvider())->register($app);
    }
}
