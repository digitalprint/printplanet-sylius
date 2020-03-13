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

namespace PrintPlanet\Sylius\ServiceProvider\CurrencyServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Webmozart\Assert\Assert;

final class SyliusCurrencyServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        Assert::isCallable(
            $app['addXmlMappingPath'],
            'The key $app[\'addXmlMappingPath\'] must be provided and be a callable'
        );

        $app['addXmlMappingPath'](
            [
                'path' => sprintf(
                    '%s/Resources/config/doctrine/model',
                    \dirname((new \ReflectionObject($this))->getFileName())
                ),
                'namespace' => $this->getModelNamespace(),
            ]
        );
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }

    private function getModelNamespace(): string
    {
        return 'PrintPlanet\Sylius\Component\Currency\Model';
    }
}
