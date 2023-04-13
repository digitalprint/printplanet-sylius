<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Lutz Bicker
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

namespace PrintPlanet\Sylius\ServiceProvider\ProductServiceProvider\Doctrine\ORM;

use Doctrine\ORM\NonUniqueResultException;
use PrintPlanet\Sylius\Component\Product\Model\ProductVariantAssociationTypeInterface;
use PrintPlanet\Sylius\Component\Product\Repository\ProductVariantAssociationTypeRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\Doctrine\ORM\EntityRepository;

class ProductVariantAssociationTypeRepository extends EntityRepository implements ProductVariantAssociationTypeRepositoryInterface
{
    /**
     * @throws NonUniqueResultException
     */
    public function findOneByCode(string $code): ?ProductVariantAssociationTypeInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
