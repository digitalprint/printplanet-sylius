<?php

declare(strict_types=1);

namespace PrintPlanet\Sylius\Component\Core\Model;

use PrintPlanet\Sylius\Component\Product\Model\ProductAttributeInterface;

interface ProductVariantAttributeAxisInterface
{
    /** @return int */
    public function getId(): int;

    /** @return ProductVariantInterface */
    public function getProductVariant(): ProductVariantInterface;

    /** @param ProductVariantInterface $productVariant */
    public function setProductVariant(ProductVariantInterface $productVariant): void;

    /** @return ProductAttributeInterface */
    public function getAttribute(): ProductAttributeInterface;

    /** @param ProductAttributeInterface $attribute */
    public function setAttribute(ProductAttributeInterface $attribute): void;

    /** @param int */
    public function setLevel(int $level): void;

    /** @return int */
    public function getLevel(): int;
}
