<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Lutz Bicker
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

namespace PrintPlanet\Sylius\Component\Product\Model;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PrintPlanet\Sylius\Component\Resource\Model\TimestampableTrait;

class ProductVariantAssociation implements ProductVariantAssociationInterface
{
    use TimestampableTrait;

    /** @var mixed */
    protected $id;

    /** @var ProductVariantAssociationTypeInterface|null */
    protected $type;

    /** @var ProductVariant|null */
    protected $owner;

    /**
     * @var Collection|ProductVariantInterface[]
     *
     * @psalm-var Collection<array-key, ProductVariantInterface>
     */
    protected $associatedProductVariants;

    public function __construct()
    {
        $this->createdAt = new DateTime();

        $this->updatedAt = new DateTime();

        /** @var ArrayCollection<array-key, ProductVariantInterface> $this->associatedProducts */
        $this->associatedProductVariants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType(): ?ProductVariantAssociationTypeInterface
    {
        return $this->type;
    }

    public function setType(?ProductVariantAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    public function getOwner(): ?ProductVariantInterface
    {
        return $this->owner;
    }

    public function setOwner(?ProductVariantInterface $owner): void
    {
        $this->owner = $owner;
    }

    public function getAssociatedProductVariants(): Collection
    {
        return $this->associatedProductVariants;
    }

    public function hasAssociatedProductVariant(ProductVariantInterface $productVariant): bool
    {
        return $this->associatedProductVariants->contains($productVariant);
    }

    public function addAssociatedProductVariant(ProductVariantInterface $productVariant): void
    {
        if (!$this->hasAssociatedProductVariant($productVariant)) {
            $this->associatedProductVariants->add($productVariant);
        }
    }

    public function removeAssociatedProductVariant(ProductVariantInterface $productVariant): void
    {
        if ($this->hasAssociatedProductVariant($productVariant)) {
            $this->associatedProductVariants->removeElement($productVariant);
        }
    }

    public function clearAssociatedProductVariants(): void
    {
        $this->associatedProductVariants->clear();
    }
}
