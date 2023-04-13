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

use Doctrine\Common\Collections\Collection;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TimestampableInterface;

interface ProductVariantAssociationInterface extends TimestampableInterface, ResourceInterface
{
    public function getType(): ?ProductVariantAssociationTypeInterface;

    public function setType(?ProductVariantAssociationTypeInterface $type): void;

    public function getOwner(): ?ProductVariantInterface;

    public function setOwner(?ProductVariantInterface $owner): void;

    /**
     * @return Collection|ProductVariantInterface[]
     *
     * @psalm-return Collection<array-key, ProductVariantInterface>
     */
    public function getAssociatedProductVariants(): Collection;

    public function addAssociatedProductVariant(ProductVariantInterface $productVariant): void;

    public function removeAssociatedProductVariant(ProductVariantInterface $productVariant): void;

    public function hasAssociatedProductVariant(ProductVariantInterface $productVariant): bool;

    public function clearAssociatedProductVariants(): void;
}
