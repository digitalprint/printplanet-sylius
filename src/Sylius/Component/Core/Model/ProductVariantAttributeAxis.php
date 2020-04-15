<?php

declare(strict_types=1);

namespace PrintPlanet\Sylius\Component\Core\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use PrintPlanet\Sylius\Component\Product\Model\ProductAttributeInterface;

class ProductVariantAttributeAxis implements ProductVariantAttributeAxisInterface
{
    /** @var int */
    protected $id;

    /** @var ProductVariantInterface */
    protected $productVariant;

    /** @var ProductAttributeInterface */
    protected $attribute;

    /** @var int */
    protected $level;

    public function getId(): int
    {
        return $this->id;
    }

    public function getProductVariant(): ProductVariantInterface
    {
        return $this->productVariant;
    }

    public function setProductVariant(ProductVariantInterface $productVariant): void
    {
        $this->productVariant = $productVariant;
    }

    public function getAttribute(): ProductAttributeInterface
    {
        return $this->attribute;
    }

    public function setAttribute(ProductAttributeInterface $attribute): void
    {
        $this->attribute = $attribute;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }
}
