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

namespace PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Doctrine\ORM;

use PrintPlanet\Sylius\Component\Core\Model\ImageInterface;
use PrintPlanet\Sylius\Component\Core\Repository\ImageRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\Doctrine\ORM\EntityRepository;

class ImageRepository extends EntityRepository implements ImageRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findOneByPath(string $path): ?ImageInterface
    {
        return $this->createQueryBuilder('o')
            ->where('o.path = :path')
            ->setMaxResults(1)
            ->setParameter('path', $path)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
