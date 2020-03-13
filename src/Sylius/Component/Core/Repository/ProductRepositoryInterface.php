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

namespace PrintPlanet\Sylius\Component\Core\Repository;

use Doctrine\ORM\QueryBuilder;
use PrintPlanet\Sylius\Component\Core\Model\ProductInterface;
use PrintPlanet\Sylius\Component\Product\Repository\ProductRepositoryInterface as BaseProductRepositoryInterface;

interface ProductRepositoryInterface extends BaseProductRepositoryInterface
{
    /**
     * @param string     $locale
     * @param mixed|null $taxonId
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createListQueryBuilder(string $locale, $taxonId = null): QueryBuilder;

    public function findOneByCode(string $code): ?ProductInterface;
}
