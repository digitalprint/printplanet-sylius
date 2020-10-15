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
use PrintPlanet\Sylius\Component\Core\Model\ProductVariantInterface;
use PrintPlanet\Sylius\Component\Product\Model\ProductAttributeInterface;
use PrintPlanet\Sylius\Component\Product\Repository\ProductVariantRepositoryInterface as BaseProductVariantRepositoryInterface;

interface ProductVariantRepositoryInterface extends BaseProductVariantRepositoryInterface
{
    public function createInventoryListQueryBuilder(string $locale): QueryBuilder;

    /**
     * @param ProductAttributeInterface $attributeCode
     * @param string $locale
     * @param mixed $attributeValue
     * @return ProductVariantInterface|null
     */
    public function findOneByAttributeAndAttributeValue(ProductAttributeInterface $attributeCode, string $locale, $attributeValue): ?ProductVariantInterface;
}
