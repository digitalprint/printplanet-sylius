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

namespace PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider;

use Doctrine\ORM\EntityManager;
use PrintPlanet\Sylius\Component\Resource\Metadata\Registry;
use PrintPlanet\Sylius\Component\Resource\Translation\Provider\ImmutableTranslationLocaleProvider;
use PrintPlanet\Sylius\Component\Resource\Translation\TranslatableEntityLocaleAssigner;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\EventListener\ORMTranslatableListener;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Webmozart\Assert\Assert;

final class SyliusResourceServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function register(Application $app)
    {
        Assert::string($app['isoLocale'], 'The key $app[\'isoLocale\'] must be provided and be a string');

        Assert::isInstanceOf(
            $app['sylius.entityManager'],
            EntityManager::class,
            'The key $app[\'sylius.entityManager\'] must be provided and must an instance of' . EntityManager::class
        );

        $translationProvider = new ImmutableTranslationLocaleProvider([$app['isoLocale']], $app['isoLocale']);
        $translatableEntityLocaleAssigner = new TranslatableEntityLocaleAssigner($translationProvider);
        $ormTranslatableListener = new ORMTranslatableListener(new Registry(), $translatableEntityLocaleAssigner);
        $app['sylius.entityManager']->getEventManager()->addEventSubscriber($ormTranslatableListener);
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }

    private function getModelNamespace(): string
    {
        return 'PrintPlanet\Sylius\Component\Resource\Model';
    }
}
