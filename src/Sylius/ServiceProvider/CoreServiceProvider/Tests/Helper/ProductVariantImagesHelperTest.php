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

namespace PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Tests\Helper;

use Doctrine\Common\Collections\Collection;
use Nyholm\NSA;
use PHPUnit\Framework\TestCase;
use PrintPlanet\Sylius\Component\Core\Model\ImageInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductImage;
use PrintPlanet\Sylius\Component\Core\Model\ProductImageInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductVariant;
use PrintPlanet\Sylius\Component\Core\Model\ProductVariantInterface;
use PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Templating\Helper\ProductVariantImagesHelper;

/**
 * @covers \PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Templating\Helper\ProductVariantImagesHelper
 */
class ProductVariantImagesHelperTest extends TestCase
{
    /** @var ProductVariantInterface */
    protected $productVariant;

    public function setUp(): void
    {
        $this->productVariant = new ProductVariant();

        $image = new ProductImage();
        $image->setType('image_01');
        NSA::setProperty($image, 'id', 1);
        $this->productVariant->addImage($image);

        $image = new ProductImage();
        $image->setType('image_02_de_DE');
        NSA::setProperty($image, 'id', 2);
        $this->productVariant->addImage($image);

        $image = new ProductImage();
        $image->setType('image_main');
        NSA::setProperty($image, 'id', 3);
        $this->productVariant->addImage($image);

        $image = new ProductImage();
        NSA::setProperty($image, 'id', 4);
        $this->productVariant->addImage($image);

        parent::setUp();
    }

    public function testSortImagesByTypes(): void
    {
        $productVariantImagesHelper = new ProductVariantImagesHelper();

        $images = $productVariantImagesHelper->getImages($this->productVariant, false, 'image_main.*', 'image_[0-9]{2}.*');

        $this->assertImagesMatchOrder([3, 1, 2, 4], $images);
    }

    public function testFilterImagesByTypes(): void
    {
        $productVariantImagesHelper = new ProductVariantImagesHelper();

        $images = $productVariantImagesHelper->getImages($this->productVariant, true, 'image_main.*', 'image_[0-9]{2}.*');

        $this->assertImagesMatchOrder([3, 1, 2], $images);
    }

    /**
     * @param array $expectedImageIds Expected Ids
     * @param Collection|ProductImageInterface[] $images
     */
    protected function assertImagesMatchOrder(array $expectedImageIds, Collection $images): void
    {
        self::assertCount($images->count(), $expectedImageIds, 'Images Collection doesn\'t match the expected Image Ids.');

        $expectedImageId = reset($expectedImageIds);

        /** @var ImageInterface $image */
        foreach ($images as $image) {
            self::assertEquals($expectedImageId, $image->getId());
            $expectedImageId = next($expectedImageIds);
        }
    }
}
