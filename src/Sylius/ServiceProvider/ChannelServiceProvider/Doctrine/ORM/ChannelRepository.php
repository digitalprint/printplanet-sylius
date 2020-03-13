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

namespace PrintPlanet\Sylius\ServiceProvider\ChannelServiceProvider\Doctrine\ORM;

use PrintPlanet\Sylius\Component\Channel\Model\ChannelInterface;
use PrintPlanet\Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\Doctrine\ORM\EntityRepository;

class ChannelRepository extends EntityRepository implements ChannelRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findOneByHostname(string $hostname): ?ChannelInterface
    {
        return $this->findOneBy(['hostname' => $hostname]);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByCode(string $code): ?ChannelInterface
    {
        return $this->findOneBy(['code' => $code]);
    }

    /**
     * {@inheritdoc}
     */
    public function findByName(string $name): iterable
    {
        return $this->findBy(['name' => $name]);
    }
}
