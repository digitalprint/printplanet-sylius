<?php

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
use PrintPlanet\Sylius\Component\Channel\Model\ChannelInterface as BaseChannelInterface;
use PrintPlanet\Sylius\Component\Core\Provider\TaxonLayoutProvider;
use PrintPlanet\Sylius\Component\Product\Model\Product as BaseProduct;
use PrintPlanet\Sylius\Component\Product\Model\ProductTranslationInterface as BaseProductTranslationInterface;
use PrintPlanet\Sylius\Component\Taxonomy\Model\TaxonViewLayout;
use Webmozart\Assert\Assert;

class Product extends BaseProduct implements ProductInterface
{
    /** @var string */
    protected $variantSelectionMethod = self::VARIANT_SELECTION_CHOICE;

    /** @var Collection|ProductTaxonInterface[] */
    protected $productTaxons;

    /** @var Collection|ChannelInterface[] */
    protected $channels;

    /** @var TaxonInterface */
    protected $mainTaxon;

    /** @var float */
    protected $averageRating = 0;

    /** @var Collection|ImageInterface[] */
    protected $images;

    public function __construct()
    {
        parent::__construct();

        $this->productTaxons = new ArrayCollection();
        $this->channels = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getVariantSelectionMethod(): string
    {
        return $this->variantSelectionMethod;
    }

    /**
     * {@inheritdoc}
     */
    public function setVariantSelectionMethod(?string $variantSelectionMethod): void
    {
        Assert::oneOf(
            $variantSelectionMethod,
            [self::VARIANT_SELECTION_CHOICE, self::VARIANT_SELECTION_MATCH],
            sprintf('Wrong variant selection method "%s" given.', $variantSelectionMethod)
        );

        $this->variantSelectionMethod = $variantSelectionMethod;
    }

    /**
     * {@inheritdoc}
     */
    public function isVariantSelectionMethodChoice(): bool
    {
        return self::VARIANT_SELECTION_CHOICE === $this->variantSelectionMethod;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariantSelectionMethodLabel(): string
    {
        $labels = self::getVariantSelectionMethodLabels();

        return $labels[$this->variantSelectionMethod];
    }

    /**
     * {@inheritdoc}
     */
    public function getProductTaxons(): Collection
    {
        return $this->productTaxons;
    }

    /**
     * {@inheritdoc}
     */
    public function addProductTaxon(ProductTaxonInterface $productTaxon): void
    {
        if (! $this->hasProductTaxon($productTaxon)) {
            $this->productTaxons->add($productTaxon);
            $productTaxon->setProduct($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeProductTaxon(ProductTaxonInterface $productTaxon): void
    {
        if ($this->hasProductTaxon($productTaxon)) {
            $this->productTaxons->removeElement($productTaxon);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasProductTaxon(ProductTaxonInterface $productTaxon): bool
    {
        return $this->productTaxons->contains($productTaxon);
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxons(): Collection
    {
        return $this->productTaxons->map(function (ProductTaxonInterface $productTaxon): TaxonInterface {
            return $productTaxon->getTaxon();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function hasTaxon(TaxonInterface $taxon): bool
    {
        return $this->getTaxons()->contains($taxon);
    }

    /**
     * {@inheritdoc}
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    /**
     * {@inheritdoc}
     */
    public function addChannel(BaseChannelInterface $channel): void
    {
        if (! $this->hasChannel($channel)) {
            $this->channels->add($channel);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeChannel(BaseChannelInterface $channel): void
    {
        if ($this->hasChannel($channel)) {
            $this->channels->removeElement($channel);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasChannel(BaseChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }

    /**
     * {@inheritdoc}
     */
    public function getShortDescription(): ?string
    {
        return $this->getTranslation()->getShortDescription();
    }

    /**
     * {@inheritdoc}
     */
    public function setShortDescription(?string $shortDescription): void
    {
        $this->getTranslation()->setShortDescription($shortDescription);
    }

    /**
     * {@inheritdoc}
     */
    public function getMainTaxon(): ?TaxonInterface
    {
        return $this->mainTaxon;
    }

    /**
     * {@inheritdoc}
     */
    public function setMainTaxon(?TaxonInterface $mainTaxon): void
    {
        $this->mainTaxon = $mainTaxon;
    }

    /**
     * {@inheritdoc}
     */
    public function getAverageRating(): ?float
    {
        return $this->averageRating;
    }

    /**
     * {@inheritdoc}
     */
    public function setAverageRating(float $averageRating): void
    {
        $this->averageRating = $averageRating;
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
        return $this->images->filter(function (ImageInterface $image) use ($type): bool {
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
    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(ImageInterface $image): void
    {
        $image->setOwner($this);
        $this->images->add($image);
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            $image->setOwner(null);
            $this->images->removeElement($image);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getVariantSelectionMethodLabels(): array
    {
        return [
            self::VARIANT_SELECTION_CHOICE => 'sylius.ui.variant_choice',
            self::VARIANT_SELECTION_MATCH => 'sylius.ui.options_matching',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): BaseProductTranslationInterface
    {
        return new ProductTranslation();
    }

    public function getViewLayout(): ?TaxonViewLayout
    {
        return TaxonLayoutProvider::getViewLayout($this->getMainTaxon());
    }

    public function getMetaTitle(): ?string
    {
        return $this->getTranslation()->getMetaTitle();
    }

    public function setMetaTitle(?string $metaTitle): void
    {
        $this->getTranslation()->setMetaTitle($metaTitle);
    }

    public function getMetaDescriptionText(): ?string
    {
        return $this->getTranslation()->getMetaDescriptionText();
    }

    public function setMetaDescriptionText(?string $metaDescription): void
    {
        $this->getTranslation()->setMetaDescriptionText($metaDescription);
    }
}
