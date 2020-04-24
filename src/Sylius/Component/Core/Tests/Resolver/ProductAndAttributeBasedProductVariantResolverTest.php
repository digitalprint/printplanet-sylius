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

namespace PrintPlanet\Sylius\Component\Core\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use PrintPlanet\Sylius\Component\Attribute\Model\Attribute;
use PrintPlanet\Sylius\Component\Core\Model\Product;
use PrintPlanet\Sylius\Component\Core\Model\ProductInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductVariant;
use PrintPlanet\Sylius\Component\Core\Resolver\ProductAndAttributeBasedProductVariantResolver;
use PrintPlanet\Sylius\Component\Product\Model\ProductVariantAttributeValue;

/**
 * @covers ProductAndAttributeBasedProductVariantResolver
 */
class ProductAndAttributeBasedProductVariantResolverTest extends TestCase
{
    /** @var ProductAndAttributeBasedProductVariantResolver */
    protected $productAndAttributeBasedProductVariantResolver;

    /** @var ProductInterface */
    protected $product;

    /** @var array */
    protected $attributes;

    /** @var string */
    protected $requiredAttributeValueCode;

    /** @var string */
    protected $locale;

    protected function setUp(): void
    {
        $this->productAndAttributeBasedProductVariantResolver = new ProductAndAttributeBasedProductVariantResolver();

        $this->attributes = [
            'color' => 'green',
            'size' => 'large',
        ];

        $this->requiredAttributeValueCode = 'color';
        $this->locale = 'en_EN';

        $productVariant = new ProductVariant();
        $productVariant->setCode('foo');

        $productVariantAttributeValue = new ProductVariantAttributeValue();

        $attribute = new Attribute();
        $attribute->setCode('color');
        $attribute->setStorageType('text');

        $productVariantAttributeValue->setAttribute($attribute);
        $productVariantAttributeValue->setLocaleCode($this->locale);
        $productVariantAttributeValue->setValue('green');

        $productVariant->addAttribute($productVariantAttributeValue);

        $this->product = new Product();

        $this->product->addVariant($productVariant);

        parent::setUp();
    }

    /**
     * @covers ProductAndAttributeBasedProductVariantResolver::findVariant
     */
    public function testFindVariant() :void
    {
        $result = $this->productAndAttributeBasedProductVariantResolver->findVariant(
            $this->product,
            'color',
            $this->attributes,
            $this->locale
        );

        $this->assertSame($this->product->getVariants()->first(), $result);
    }

    /**
     * @covers ProductAndAttributeBasedProductVariantResolver::getVariantWithAttributes
     */
    public function testGetVariantWithAttributes(): void
    {
        $result = $this->productAndAttributeBasedProductVariantResolver->getVariantWithAttributes(
            $this->product,
            $this->attributes,
            $this->locale
        );

        $this->assertNull($result);
    }

    /**
     * @covers ProductAndAttributeBasedProductVariantResolver::variantHasAllAttributes
     */
    public function testVariantHasAllAttributes(): void
    {
        $result = $this->productAndAttributeBasedProductVariantResolver->variantHasAllAttributes(
            $this->product->getVariants()->first(),
            $this->attributes,
            $this->locale
        );

        $this->assertFalse($result);
    }

    /**
     * @covers ProductAndAttributeBasedProductVariantResolver::variantHasSomeAttributes
     */
    public function testVariantHasSomeAttributes(): void
    {
        $result = $this->productAndAttributeBasedProductVariantResolver->variantHasSomeAttributes(
            $this->product->getVariants()->first(),
            $this->attributes,
            $this->locale
        );

        $this->assertTrue($result);
    }
}
