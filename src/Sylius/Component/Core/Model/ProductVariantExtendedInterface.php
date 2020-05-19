<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Nikos Papagiannopoulos
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PrintPlanet\Sylius\Component\Core\Model;

use Doctrine\Common\Collections\Collection;
use PrintPlanet\Sylius\Component\Attribute\Model\AttributeValueInterface;

interface ProductVariantExtendedInterface
{
    /**
     * @return Collection|ProductVariantAttributeAxisInterface[]
     */
    public function getVariantAxes(): Collection;

    /**
     * @param ProductVariantAttributeAxisInterface $productVariantAttributeAxis
     * @return bool
     */
    public function hasVariantAxis(ProductVariantAttributeAxisInterface $productVariantAttributeAxis): bool;

    /**
     * @param ProductVariantAttributeAxisInterface $productVariantAttributeAxis
     */
    public function addVariantAxis(ProductVariantAttributeAxisInterface $productVariantAttributeAxis): void;

    /**
     * @param ProductVariantAttributeAxisInterface $productVariantAttributeAxis
     */
    public function removeVariantAxis(ProductVariantAttributeAxisInterface $productVariantAttributeAxis): void;

    /**
     * @param string $attributeCode
     * @param int $level
     * @return ProductVariantAttributeAxisInterface|null
     */
    public function getVariantAxisByCodeAndLevel(string $attributeCode, int $level): ?ProductVariantAttributeAxisInterface;

    /**
     * @param string $localeCode
     * @return Collection|AttributeValueInterface[]
     */
    public function getVariantAxesValuesByLocale(string $localeCode): Collection;
}
