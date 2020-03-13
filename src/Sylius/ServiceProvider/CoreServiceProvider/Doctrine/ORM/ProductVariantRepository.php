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

use Doctrine\ORM\QueryBuilder;
use PrintPlanet\Sylius\Component\Core\Repository\ProductVariantRepositoryInterface;
use PrintPlanet\Sylius\ServiceProvider\ProductServiceProvider\Doctrine\ORM\ProductVariantRepository as BaseProductVariantRepository;

class ProductVariantRepository extends BaseProductVariantRepository implements ProductVariantRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createInventoryListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('o.tracked = true')
            ->setParameter('locale', $locale);
    }
}
