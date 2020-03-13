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

use PrintPlanet\Sylius\Component\Product\Model\ProductInterface;
use PrintPlanet\Sylius\Component\Resource\Repository\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|ProductInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @return array|ProductInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
