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

namespace PrintPlanet\Sylius\Component\Core\Resolver;

use PrintPlanet\Sylius\Component\Core\Model\ProductInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductVariantInterface;
use PrintPlanet\Sylius\Component\Attribute\Model\AttributeValueInterface;

class ProductAndAttributeBasedProductVariantResolver
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
    public function findVariant(
        ProductInterface $product,
        string $requiredAttributeValueCode,
        array $attributes,
        string $locale
    ): ?ProductVariantInterface
    {
        if (null !== $productVariant = $this->getVariantWithAttributes($product, $attributes, $locale)) {
            return $productVariant;
        }

        while (count($attributes) > 1) {
            foreach ($attributes as $attributeCode => $attributeValue) {
                if ($requiredAttributeValueCode !== $attributeCode) {
                    unset($attributes[$attributeCode]);
                    break;
                }
            }

            if (null !== $productVariant = $this->getVariantWithAttributes($product, $attributes, $locale)) {
                return $productVariant;
            }
        }

        return null;
    }

    /**
     * Returns a ProductVariant which has the given attributes or null if none found.
     *
     * @param ProductInterface $product
     * @param array $attributes In form of [[attribute code => attribute value],]
     * @param string $locale
     * @return ProductVariantInterface|null
     */
    public function getVariantWithAttributes(
        ProductInterface $product,
        array $attributes,
        string $locale
    ): ?ProductVariantInterface
    {
        foreach ($product->getVariants() as $productVariant) {
            if (true === $this->variantHasAllAttributes($productVariant, $attributes, $locale)) {
                return $productVariant;
            }
        }

        return null;
    }

    /**
     * @param ProductVariantInterface $productVariant
     * @param array $attributes In form of [[attribute code => attribute value],]
     * @param string $locale
     * @return bool
     */
    public function variantHasAllAttributes(ProductVariantInterface $productVariant, array $attributes, string $locale): bool
    {
        foreach ($attributes as $attributeCode => $attributeValue) {
            /** @var AttributeValueInterface $attribute */
            if (null === $attribute = $productVariant->getAttributeByCodeAndLocale($attributeCode, $locale)) {
                return false;
            }

            if ($attributeValue !== $attribute->getValue()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param ProductVariantInterface $productVariant
     * @param array $attributes In form of [[attribute code => attribute value],]
     * @param string $locale
     * @return bool
     */
    public function variantHasSomeAttributes(ProductVariantInterface $productVariant, array $attributes, string $locale): bool
    {
        $result = false;

        foreach ($attributes as $attributeCode => $attributeValue) {
            /** @var AttributeValueInterface $attribute */
            if (
                (null !== $attribute = $productVariant->getAttributeByCodeAndLocale($attributeCode, $locale)) &&
                $attributeValue === $attribute->getValue()
            ) {
                $result = true;
            }
        }

        return $result;
    }
}
