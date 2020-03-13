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

use PrintPlanet\Sylius\Component\Core\Model\ProductTaxonInterface;
use PrintPlanet\Sylius\Component\Core\Repository\ProductTaxonRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\Doctrine\ORM\EntityRepository;

class ProductTaxonRepository extends EntityRepository implements ProductTaxonRepositoryInterface
{
    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByProductCodeAndTaxonCode(string $productCode, string $taxonCode): ?ProductTaxonInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.product', 'product')
            ->andWhere('product.code = :productCode')
            ->setParameter('productCode', $productCode)
            ->innerJoin('o.taxon', 'taxon')
            ->andWhere('taxon.code = :taxonCode')
            ->setParameter('taxonCode', $taxonCode)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
