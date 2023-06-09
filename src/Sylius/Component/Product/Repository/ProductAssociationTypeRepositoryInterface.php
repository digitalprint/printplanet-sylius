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

namespace PrintPlanet\Sylius\Component\Product\Repository;

use Doctrine\ORM\QueryBuilder;
use PrintPlanet\Sylius\Component\Product\Model\ProductAssociationTypeInterface;
use PrintPlanet\Sylius\Component\Resource\Repository\RepositoryInterface;

interface ProductAssociationTypeRepositoryInterface extends RepositoryInterface
{
    public function createListQueryBuilder(string $locale): QueryBuilder;

    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|ProductAssociationTypeInterface[]
     */
    public function findByName(string $name, string $locale): array;
}
