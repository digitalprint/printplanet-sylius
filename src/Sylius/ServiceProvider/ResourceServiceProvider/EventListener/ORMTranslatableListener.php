<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Nikos Papagiannopoulos
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This file incorporates work covered by the following copyright and  
 * permission notice:
 * 
 *   This file is part of the Sylius package.
 *
 *   (c) Paweł Jędrzejewski
 *
 *   For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use PrintPlanet\Sylius\Component\Resource\Metadata\RegistryInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableInterface;
use PrintPlanet\Sylius\Component\Resource\Translation\TranslatableEntityLocaleAssignerInterface;

final class ORMTranslatableListener implements EventSubscriber
{
    /** @var RegistryInterface */
    private $resourceMetadataRegistry;

    /** @var TranslatableEntityLocaleAssignerInterface */
    private $translatableEntityLocaleAssigner;

    /**
     * @param RegistryInterface                         $resourceMetadataRegistry
     * @param TranslatableEntityLocaleAssignerInterface $translatableEntityLocaleAssigner
     */
    public function __construct(
        RegistryInterface $resourceMetadataRegistry,
        TranslatableEntityLocaleAssignerInterface $translatableEntityLocaleAssigner
    ) {
        $this->resourceMetadataRegistry = $resourceMetadataRegistry;
        $this->translatableEntityLocaleAssigner = $translatableEntityLocaleAssigner;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::postLoad,
        ];
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        if (! $entity instanceof TranslatableInterface) {
            return;
        }

        $this->translatableEntityLocaleAssigner->assignLocale($entity);
    }
}
