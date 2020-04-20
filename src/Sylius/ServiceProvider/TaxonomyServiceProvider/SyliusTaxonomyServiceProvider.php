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

namespace PrintPlanet\Sylius\ServiceProvider\TaxonomyServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;

final class SyliusTaxonomyServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        /**
         * @deprecated The $app['addXmlMappingPath'] should not be used in the future to add Xml Mappings
         *             the getXmlMappingPath should be used instead.
         */
        if (isset($app['addXmlMappingPath']) && is_callable($app['addXmlMappingPath'])) {
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
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }

    private function getModelNamespace(): string
    {
        return 'PrintPlanet\Sylius\Component\Taxonomy\Model';
    }

    public static function getXmlMappingPath(): array
    {
        $self = new self;

        return [
            'path' => sprintf(
                '%s/Resources/config/doctrine/model',
                \dirname((new \ReflectionObject($self))->getFileName())
            ),
            'namespace' => $self->getModelNamespace(),
        ];
    }
}
