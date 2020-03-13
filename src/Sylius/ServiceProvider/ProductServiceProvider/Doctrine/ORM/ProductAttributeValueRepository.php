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

namespace PrintPlanet\Sylius\ServiceProvider\ProductServiceProvider\Doctrine\ORM;

use PrintPlanet\Sylius\Component\Product\Repository\ProductAttributeValueRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ResourceServiceProvider\Doctrine\ORM\EntityRepository;

class ProductAttributeValueRepository extends EntityRepository implements ProductAttributeValueRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findByJsonChoiceKey(string $choiceKey): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.json LIKE :key')
            ->setParameter('key', '%"' . $choiceKey . '"%')
            ->getQuery()
            ->getResult();
    }
}
