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

class ProductAndAttributeBasedProductVariantResolver implements ProductAndAttributeBasedProductVariantResolverInterface
{
    /**
     *  {@inheritDoc}
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
     *  {@inheritDoc}
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
     *  {@inheritDoc}
     */
    public function variantHasAllAttributes(ProductVariantInterface $productVariant, array $attributes, string $locale): bool
    {
        foreach ($attributes as $attributeCode => $attributeValue) {
            /** @var AttributeValueInterface $attribute */
            if (null === $attribute = $productVariant->getAttributeByCodeAndLocale($attributeCode, $locale)) {
                return false;
            }

            if (
                (false === is_array($attribute->getValue()) && $attributeValue !== $attribute->getValue()) ||
                (true === is_array($attribute->getValue()) && false === in_array($attributeValue, $attribute->getValue(), true))
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     *  {@inheritDoc}
     */
    public function variantHasSomeAttributes(ProductVariantInterface $productVariant, array $attributes, string $locale): bool
    {
        $result = false;

        foreach ($attributes as $attributeCode => $attributeValue) {
            /** @var AttributeValueInterface $attribute */
            if (
                (null !== $attribute = $productVariant->getAttributeByCodeAndLocale($attributeCode, $locale)) &&
                ((false === is_array($attribute->getValue()) && $attributeValue === $attribute->getValue()) ||
                (true === is_array($attribute->getValue()) && true === in_array($attributeValue, $attribute->getValue(), true)))
            ) {
                $result = true;
            }
        }

        return $result;
    }
}
