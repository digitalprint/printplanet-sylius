<?php

/** @noinspection ALL */

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

namespace PrintPlanet\Sylius\Component\Core\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PrintPlanet\Sylius\Component\Attribute\Model\AttributeValueInterface;
use PrintPlanet\Sylius\Component\Product\Model\ProductVariant as BaseVariant;
use PrintPlanet\Sylius\Component\Product\Model\ProductVariantAssociationInterface;
use PrintPlanet\Sylius\Component\Product\Model\ProductVariantAttributeValueInterface;
use PrintPlanet\Sylius\Component\Shipping\Model\ShippingCategoryInterface;
use Webmozart\Assert\Assert;


class ProductVariant extends BaseVariant implements ProductVariantInterface
{
    /** @var int */
    protected $version = 1;

    /** @var int */
    protected $onHold = 0;

    /** @var int */
    protected $onHand = 0;

    /** @var bool */
    protected $tracked = false;

    /** @var float */
    protected $weight;

    /** @var float */
    protected $width;

    /** @var float */
    protected $height;

    /** @var float */
    protected $depth;

    /** @var ShippingCategoryInterface */
    protected $shippingCategory;

    /** @var Collection */
    protected $channelPricings;

    /** @var bool */
    protected $shippingRequired = true;

    /** @var Collection|ProductImageInterface[] */
    protected $images;

    /** @var Collection|AttributeValueInterface[] */
    protected $attributes;

    /** @var Collection|ProductVariantAttributeAxisInterface[] */
    protected $variantAxes;

    /** @var Collection|ProductVariantAssociationInterface[] */
    protected $associations;

    /**
     * @var bool
     * @deprecated an attribute is being used for the active property
     */
    protected $active;

    public function __construct()
    {
        parent::__construct();

        $this->channelPricings = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->variantAxes = new ArrayCollection();
        $this->associations = new ArrayCollection();
    }

    public function __toString(): string
    {
        $string = null !== $this->getProduct() ? (string) $this->getProduct()->getName() : '';

        if (! $this->getOptionValues()->isEmpty()) {
            $string .= '(';

            foreach ($this->getOptionValues() as $option) {
                $string .= sprintf(
                    '%s: %s, ',
                    null !== $option->getOption() ? $option->getOption()->getName() : '',
                    $option->getValue()
                );
            }

            $string = substr($string, 0, -2) . ')';
        }

        return $string;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * {@inheritdoc}
     */
    public function setVersion(?int $version): void
    {
        $this->version = $version;
    }

    /**
     * {@inheritdoc}
     */
    public function isInStock(): bool
    {
        return 0 < $this->onHand;
    }

    /**
     * {@inheritdoc}
     */
    public function getOnHold(): ?int
    {
        return $this->onHold;
    }

    /**
     * {@inheritdoc}
     */
    public function setOnHold(?int $onHold): void
    {
        $this->onHold = $onHold;
    }

    /**
     * {@inheritdoc}
     */
    public function getOnHand(): ?int
    {
        return $this->onHand;
    }

    /**
     * {@inheritdoc}
     */
    public function setOnHand(?int $onHand): void
    {
        $this->onHand = (0 > $onHand) ? 0 : $onHand;
    }

    /**
     * {@inheritdoc}
     */
    public function isTracked(): bool
    {
        return $this->tracked;
    }

    /**
     * {@inheritdoc}
     */
    public function setTracked(bool $tracked): void
    {
        $this->tracked = $tracked;
    }

    /**
     * {@inheritdoc}
     */
    public function getInventoryName(): ?string
    {
        return null !== $this->getProduct() ? $this->getProduct()->getName() : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingCategory(): ?ShippingCategoryInterface
    {
        return $this->shippingCategory;
    }

    /**
     * {@inheritdoc}
     */
    public function setShippingCategory(?ShippingCategoryInterface $category): void
    {
        $this->shippingCategory = $category;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * {@inheritdoc}
     */
    public function setWeight(?float $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth(): ?float
    {
        return $this->width;
    }

    /**
     * {@inheritdoc}
     */
    public function setWidth(?float $width): void
    {
        $this->width = $width;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight(): ?float
    {
        return $this->height;
    }

    /**
     * {@inheritdoc}
     */
    public function setHeight(?float $height): void
    {
        $this->height = $height;
    }

    /**
     * {@inheritdoc}
     */
    public function getDepth(): ?float
    {
        return $this->depth;
    }

    /**
     * {@inheritdoc}
     */
    public function setDepth(?float $depth): void
    {
        $this->depth = $depth;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingWeight(): ?float
    {
        return $this->getWeight();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingWidth(): ?float
    {
        return $this->getWidth();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingHeight(): ?float
    {
        return $this->getHeight();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingDepth(): ?float
    {
        return $this->getDepth();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingVolume(): ?float
    {
        return $this->depth * $this->height * $this->width;
    }

    /**
     * {@inheritdoc}
     */
    public function getChannelPricings(): Collection
    {
        return $this->channelPricings;
    }

    /**
     * {@inheritdoc}
     */
    public function getChannelPricingForChannel(ChannelInterface $channel): ?ChannelPricingInterface
    {
        if ($this->channelPricings->containsKey($channel->getCode())) {
            return $this->channelPricings->get($channel->getCode());
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function hasChannelPricingForChannel(ChannelInterface $channel): bool
    {
        return null !== $this->getChannelPricingForChannel($channel);
    }

    /**
     * {@inheritdoc}
     */
    public function hasChannelPricing(ChannelPricingInterface $channelPricing): bool
    {
        return $this->channelPricings->contains($channelPricing);
    }

    /**
     * {@inheritdoc}
     */
    public function addChannelPricing(ChannelPricingInterface $channelPricing): void
    {
        if (! $this->hasChannelPricing($channelPricing)) {
            $channelPricing->setProductVariant($this);
            $this->channelPricings->set($channelPricing->getChannelCode(), $channelPricing);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeChannelPricing(ChannelPricingInterface $channelPricing): void
    {
        if ($this->hasChannelPricing($channelPricing)) {
            $channelPricing->setProductVariant(null);
            $this->channelPricings->remove($channelPricing->getChannelCode());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isShippingRequired(): bool
    {
        return $this->shippingRequired;
    }

    /**
     * {@inheritdoc}
     */
    public function setShippingRequired(bool $shippingRequired): void
    {
        $this->shippingRequired = $shippingRequired;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function getImagesByType(string $type): Collection
    {
        return $this->images->filter(function (ProductImageInterface $image) use ($type): bool {
            return $type === $image->getType();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function hasImages(): bool
    {
        return ! $this->images->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function hasImage(ProductImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(ProductImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            return;
        }
        $image->setOwner($this->getProduct());
        $image->addProductVariant($this);
        $this->images->add($image);
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ProductImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            $this->images->removeElement($image);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function isActive(?string $localeCode = null): bool
    {
        if (null === $attribute = $this->getAttributeByCodeAndLocale('active', $localeCode)) {
            return false;
        }
        return $attribute->getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function isPublished(?string $localeCode = null): bool
    {
        if (null === $attribute = $this->getAttributeByCodeAndLocale('published', $localeCode)) {
            return false;
        }
        return $attribute->getValue();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMetaKeywords(?string $localeCode = null): string
    {
        if (null === $keywords = $this->getAttributeByCodeAndLocale('meta_keywords', $localeCode)) {
            return '';
        }
        return $keywords->getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaPriority(?string $localeCode = null): int
    {
        if (null === $attribute = $this->getAttributeByCodeAndLocale('meta_priority', $localeCode)) {
            return 0;
        }
        return $attribute->getValue();
    }    
    
    /**
     * @param bool $active
     * @deprecated an attribute is being used for the active property
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * {@inheritdoc}
     */
    public function addAttribute(?AttributeValueInterface $attribute): void
    {
        /** @var ProductVariantAttributeValueInterface $attribute */
        Assert::isInstanceOf(
            $attribute,
            ProductVariantAttributeValueInterface::class,
            'Attribute objects added to a Product Variant object have to implement ProductVariantAttributeValueInterface'
        );

        if (!$this->hasAttribute($attribute)) {
            $attribute->setProductVariant($this);
            $this->attributes->add($attribute);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAttribute(?AttributeValueInterface $attribute): void
    {
        /** @var ProductVariantAttributeValueInterface $attribute */
        Assert::isInstanceOf(
            $attribute,
            ProductVariantAttributeValueInterface::class,
            'Attribute objects removed from a Product Variant object have to implement ProductVariantAttributeValueInterface'
        );

        if ($this->hasAttribute($attribute)) {
            $this->attributes->removeElement($attribute);
            $attribute->setProduct(null);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributesByLocale(
        string $localeCode,
        ?string $fallbackLocaleCode,
        ?string $baseLocaleCode = null
    ): Collection {
        if (null === $baseLocaleCode || $baseLocaleCode === $fallbackLocaleCode) {
            $baseLocaleCode = $fallbackLocaleCode;
            $fallbackLocaleCode = null;
        }

        $attributes = $this->attributes->filter(
            static function (ProductVariantAttributeValueInterface $attribute) use ($baseLocaleCode) {
                return $attribute->getLocaleCode() === $baseLocaleCode;
            }
        );

        $attributesWithFallback = [];
        foreach ($attributes as $attribute) {
            $attributesWithFallback[] = $this->getAttributeInDifferentLocale($attribute, $localeCode, $fallbackLocaleCode);
        }

        return new ArrayCollection($attributesWithFallback);
    }

    /**
     * {@inheritdoc}
     */
    public function hasAttribute(AttributeValueInterface $attribute): bool
    {
        return $this->attributes->contains($attribute);
    }

    /**
     * {@inheritdoc}
     */
    public function hasAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): bool
    {
        $localeCode = $localeCode ?: $this->getTranslation()->getLocale();

        foreach ($this->attributes as $attribute) {
            if (
                $attribute->getLocaleCode() === $localeCode &&
                null !== $attribute->getAttribute() &&
                $attribute->getAttribute()->getCode() === $attributeCode
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): ?AttributeValueInterface
    {
        if (null === $localeCode) {
            $localeCode = $this->getTranslation()->getLocale();
        }

        foreach ($this->attributes as $attribute) {
            if (
                $attribute->getLocaleCode() === $localeCode &&
                null !== $attribute->getAttribute() &&
                $attribute->getAttribute()->getCode() === $attributeCode
            ) {
                return $attribute;
            }
        }

        return null;
    }

    private function getAttributeInDifferentLocale(
        ProductVariantAttributeValueInterface $attributeValue,
        string $localeCode,
        ?string $fallbackLocaleCode = null
    ): AttributeValueInterface {
        if (! $this->hasNotEmptyAttributeByCodeAndLocale($attributeValue->getCode(), $localeCode)) {
            if (
                null !== $fallbackLocaleCode &&
                $this->hasNotEmptyAttributeByCodeAndLocale($attributeValue->getCode(), $fallbackLocaleCode)
            ) {
                return $this->getAttributeByCodeAndLocale($attributeValue->getCode(), $fallbackLocaleCode);
            }

            return $attributeValue;
        }

        return $this->getAttributeByCodeAndLocale($attributeValue->getCode(), $localeCode);
    }

    private function hasNotEmptyAttributeByCodeAndLocale(string $attributeCode, string $localeCode): bool
    {
        $attributeValue = $this->getAttributeByCodeAndLocale($attributeCode, $localeCode);
        if (null === $attributeValue) {
            return false;
        }

        $value = $attributeValue->getValue();

        return ! ('' === $value || null === $value || [] === $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function getVariantAxes(): Collection
    {
        return $this->variantAxes;
    }

    /**
     * {@inheritDoc}
     */
    public function hasVariantAxis(ProductVariantAttributeAxisInterface $productAttribute): bool
    {
        return $this->variantAxes->contains($productAttribute);
    }

    /**
     * {@inheritDoc}
     */
    public function addVariantAxis(ProductVariantAttributeAxisInterface $productAttribute): void
    {
        if (! $this->hasVariantAxis($productAttribute)) {
            $this->variantAxes->add($productAttribute);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function removeVariantAxis(ProductVariantAttributeAxisInterface $productAttribute): void
    {
        if ($this->hasVariantAxis($productAttribute)) {
            $this->variantAxes->removeElement($productAttribute);
        }
    }


    /**
     * {@inheritDoc}
     */
    public function getVariantAxisByCodeAndLevel(string $attributeCode, int $level): ?ProductVariantAttributeAxisInterface
    {
        foreach ($this->variantAxes as $axis) {
            if (
                $level === $axis->getLevel() &&
                $attributeCode === $axis->getAttribute()->getCode()
            ) {
                return $axis;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getVariantAxesValuesByLocale(string $localeCode): Collection
    {
        $attributesByLocale = [];

        foreach ($this->variantAxes as $variantAxis) {
            if (null === $attributeByLocale = $this->getAttributeByCodeAndLocale($variantAxis->getAttribute()->getCode(), $localeCode)) {
                continue;
            }
            $attributesByLocale[] = $attributeByLocale;
        }

        return new ArrayCollection($attributesByLocale);
    }


    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function hasAssociation(ProductVariantAssociationInterface $productVariantAssociation): bool
    {
        return $this->associations->contains($productVariantAssociation);
    }

    public function addAssociation(ProductVariantAssociationInterface $productVariantAssociation): void
    {
        if (!$this->hasAssociation($productVariantAssociation)) {
            $this->associations->add($productVariantAssociation);
        }
    }

    public function removeAssociation(ProductVariantAssociationInterface $productVariantAssociation): void
    {
        if ($this->hasAssociation($productVariantAssociation)) {
            $this->associations->removeElement($productVariantAssociation);
        }
    }

    public function getAssociationByType(string $typeCode): ?ProductVariantAssociationInterface
    {
        $association = $this->associations->filter(static function(ProductVariantAssociationInterface $association) use ($typeCode) {
            if (null !== $association->getType()) {
                return $association->getType()->getCode() === $typeCode;
            }

            return false;
        });

        if ($association->isEmpty()) {
            return null;
        }

        return $association->first();
    }
}
