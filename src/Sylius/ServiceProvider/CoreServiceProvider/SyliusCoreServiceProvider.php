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

namespace PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider;

use PrintPlanet\Sylius\Component\Core\Model\ProductVariantInterface;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Twig\Environment;
use PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Templating\Helper\ProductVariantImagesHelper;
use Twig\TwigFilter;

final class SyliusCoreServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['sylius.templating.helper.product.variant.images'] = $app->share(static function () {
            return new ProductVariantImagesHelper();
        });

        $app->extend('twig', static function ($twig, $app) {
            try {
                /** @var Environment $twig */
                $twig->addFilter(new TwigFilter('sylius_sort_images', static function (ProductVariantInterface $productVariant, array $options = []) use ($app) {
                    return $app['sylius.templating.helper.product.variant.images']->getImages($productVariant, ...$options);
                }, ['is_variadic' => true]));
            } catch (\LogicException $e) {
            }

            return $twig;
        });

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
        return 'PrintPlanet\Sylius\Component\Core\Model';
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
