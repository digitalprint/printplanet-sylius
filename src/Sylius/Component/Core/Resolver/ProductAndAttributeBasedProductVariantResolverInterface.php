<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Nikos Papagiannopoulos
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PrintPlanet\Sylius\Component\Core\Resolver;

use PrintPlanet\Sylius\Component\Core\Model\ProductInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductVariantInterface;

interface ProductAndAttributeBasedProductVariantResolverInterface
{
    /**
     * Tries to find a ProductVariant which has the given (or less) attributes,
     * but with at least the required attribute, returns null when none found.
     *
     * @param ProductInterface $product
     * @param string $requiredAttributeValueCode
     * @param array $attributes In form of [[attribute code => attribute value],]
     * @param string $locale
     * @return ProductVariantInterface|null
     */
    public function findVariant(ProductInterface $product, string $requiredAttributeValueCode, array $attributes, string $locale): ?ProductVariantInterface;

    /**
     * Returns a ProductVariant which has the given attributes or null if none found.
     *
     * @param ProductInterface $product
     * @param array $attributes In form of [[attribute code => attribute value],]
     * @param string $locale
     * @return ProductVariantInterface|null
     */
    public function getVariantWithAttributes(ProductInterface $product, array $attributes, string $locale): ?ProductVariantInterface;

    /**
     * @param ProductVariantInterface $productVariant
     * @param array $attributes In form of [[attribute code => attribute value],]
     * @param string $locale
     * @return bool
     */
    public function variantHasAllAttributes(ProductVariantInterface $productVariant, array $attributes, string $locale): bool;

    /**
     * @param ProductVariantInterface $productVariant
     * @param array $attributes In form of [[attribute code => attribute value],]
     * @param string $locale
     * @return bool
     */
    public function variantHasSomeAttributes(ProductVariantInterface $productVariant, array $attributes, string $locale): bool;
}
