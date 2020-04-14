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

namespace PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Tests\Doctrine;

use Doctrine\ORM\QueryBuilder;
use PrintPlanet\Sylius\Component\Core\Model\Channel;
use PrintPlanet\Sylius\Component\Core\Model\ChannelPricing;
use PrintPlanet\Sylius\Component\Core\Model\Product;
use PrintPlanet\Sylius\Component\Core\Model\ProductTranslation;
use PrintPlanet\Sylius\Component\Core\Model\ProductVariant;
use PrintPlanet\Sylius\Component\Core\Model\Taxon;
use PrintPlanet\Sylius\Component\Product\Model\ProductAttributeValue;
use PrintPlanet\Sylius\Component\Product\Model\ProductOption;
use PrintPlanet\Sylius\ServiceProvider\ChannelServiceProvider\Doctrine\ORM\ChannelRepository;
use PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Doctrine\ORM\ProductRepository;
use PrintPlanet\Sylius\ServiceProvider\CoreServiceProvider\Doctrine\RepositoryFactory;
use PrintPlanet\Sylius\ServiceProvider\TaxonomyServiceProvider\Doctrine\ORM\TaxonRepository;

/**
 * @deprecated Will be removed in v1.0.0
 */
final class ProductRepositoryTest extends \PHPUnit_Framework_TestCase
{
    use RepositoryTestTrait;

    /**
     * @var ProductRepository
     */
    public $repository;

    /**
     * @var string
     */
    private $channel = 'US_WEB';

    /**
     * @throws \PP_Exception
     */
    public function setUp()
    {
        parent::setUp();
        $this->registerServiceProviders();
    }

    /**
     * @test
     *
     * @return ProductRepository
     *
     * @throws \Exception
     */
    public function it_can_be_constructed(): ProductRepository
    {
        $this->repository = RepositoryFactory::create(ProductRepository::class, Product::class);

        $this->assertInstanceOf(ProductRepository::class, $this->repository);

        return $this->repository;
    }

    /**
     * @test
     * @depends it_can_be_constructed
     *
     * @param ProductRepository $repository
     *
     * @return Product
     */
    public function it_delivers_a_product(ProductRepository $repository): Product
    {
        /** @var Product $product */
        $product = $repository->find(1);

        $this->assertInstanceOf(Product::class, $product);

        return $product;
    }

    /**
     * @test
     * @depends it_delivers_a_product
     *
     * @param Product $product
     */
    public function it_delivers_product_attributes(Product $product): void
    {
        $this->assertGreaterThan(0, $product->getAttributes()->count());

        $attributeValues = $product->getAttributesByLocale($this->locale, $this->locale);

        /** @var ProductAttributeValue $attributeValue */
        $attributeValue = $attributeValues[0];

        $this->assertNotEmpty($attributeValue->getName());
    }

    /**
     * @test
     * @depends it_delivers_a_product
     *
     * @param Product $product
     */
    public function it_delivers_product_translations(Product $product): void
    {
        /** @var ProductTranslation $translation */
        $translation = $product->getTranslations()->get($this->locale);

        $this->assertNotEmpty($translation->getName());
    }

    /**
     * @test
     * @depends it_delivers_a_product
     *
     * @param Product $product
     */
    public function it_delivers_product_taxons(Product $product): void
    {
        $this->assertGreaterThan(0, $product->getProductTaxons()->count());

        /** @var Taxon $productTaxon */
        $productTaxon = $product->getProductTaxons()[0]->getTaxon();

        $this->assertNotEmpty($productTaxon->getSlug());
    }

    /**
     * @test
     * @depends it_delivers_a_product
     *
     * @param Product $product
     */
    public function it_delivers_product_channels(Product $product): void
    {
        $this->assertGreaterThan(0, $product->getChannels()->count());

        /** @var Channel $productChannel */
        $productChannel = $product->getChannels()[0];

        $this->assertNotEmpty($productChannel->getName());
    }

    /**
     * @test
     * @depends it_delivers_a_product
     *
     * @param Product $product
     */
    public function it_delivers_product_options(Product $product): void
    {
        $this->assertGreaterThan(0, $product->getOptions()->count());

        /** @var ProductOption $option */
        $option = $product->getOptions()[0];

        $this->assertNotEmpty($option->getName());
    }

    /**
     * @test
     * @depends it_delivers_a_product
     *
     * @param Product $product
     */
    public function it_delivers_product_variants(Product $product): void
    {
        /** @var ProductVariant $variant */
        $variant = $product->getVariants()[0];

        $this->assertGreaterThan(0, $product->getVariants()->count());

        $this->assertNotEmpty($variant->getName());
    }

    /**
     * @test
     * @depends it_delivers_a_product
     *
     * @param Product $product
     */
    public function it_delivers_product_variants_price(Product $product): void
    {
        /** @var ProductVariant $variant */
        $variant = $product->getVariants()[0];

        $pricings = $variant->getChannelPricings();
        $this->assertGreaterThan(0, $pricings->count());

        /** @var ChannelPricing $pricing */
        $pricing = $pricings->get($this->channel);

        $this->assertGreaterThan(0, $pricing->getPrice());
    }

    /**
     * @test
     * @depends it_can_be_constructed
     *
     * @param ProductRepository $repository
     */
    public function it_delivers_a_product_by_name(ProductRepository $repository): void
    {
        /** @var Product $product */
        $products = $repository->findByName('Mug "et"', $this->locale);

        $this->assertInstanceOf(Product::class, $products[0]);
    }

    /**
     * @test
     * @depends it_can_be_constructed
     *
     * @param ProductRepository $repository
     */
    public function it_delivers_a_product_by_name_part(ProductRepository $repository): void
    {
        /** @var Product $product */
        $products = $repository->findByNamePart('Mug', $this->locale);

        $this->assertInstanceOf(Product::class, $products[0]);
    }

    /**
     * @test
     * @depends it_can_be_constructed
     *
     * @param ProductRepository $repository
     */
    public function it_delivers_a_list_querybuilder(ProductRepository $repository): void
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $repository->createListQueryBuilder($this->locale, 2);

        $this->assertInstanceOf(QueryBuilder::class, $queryBuilder);

        $this->assertNotEmpty($queryBuilder->getQuery()->execute());
    }

    /**
     * @test
     * @depends it_can_be_constructed
     *
     * @param ProductRepository $repository
     *
     * @throws \Exception
     */
    public function it_delivers_a_shop_list_querybuilder(ProductRepository $repository): void
    {
        /** @var ChannelRepository $channelRepository */
        $channelRepository = RepositoryFactory::create(ChannelRepository::class, Channel::class);

        $channel = $channelRepository->findOneByCode($this->channel);

        /** @var TaxonRepository $taxonRepository */
        $taxonRepository = RepositoryFactory::create(TaxonRepository::class, Taxon::class);

        $taxon = $taxonRepository->find(2);

        /** @var QueryBuilder $queryBuilder */
        /** @noinspection PhpParamsInspection */
        $queryBuilder = $repository->createShopListQueryBuilder($channel, $taxon, $this->locale, ['price'], true);

        $this->assertInstanceOf(QueryBuilder::class, $queryBuilder);

        $this->assertNotEmpty($queryBuilder->getQuery()->execute());
    }

    /**
     * @test
     * @depends it_can_be_constructed
     *
     * @param ProductRepository $repository
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function it_delivers_one_by_code(ProductRepository $repository): void
    {
        /** @var Product $product */
        $product = $repository->findOneByCode('f824fe64-c3a8-377c-a229-d5bb44f79609');

        $this->assertInstanceOf(Product::class, $product);
    }
}
