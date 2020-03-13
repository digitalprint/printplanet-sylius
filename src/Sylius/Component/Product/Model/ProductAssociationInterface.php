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

namespace PrintPlanet\Sylius\Component\Product\Model;

use Doctrine\Common\Collections\Collection;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TimestampableInterface;

interface ProductAssociationInterface extends TimestampableInterface, ResourceInterface
{
    public function getType(): ?ProductAssociationTypeInterface;

    public function setType(?ProductAssociationTypeInterface $type): void;

    public function getOwner(): ?ProductInterface;

    public function setOwner(?ProductInterface $owner): void;

    /**
     * @return Collection|ProductInterface[]
     */
    public function getAssociatedProducts(): Collection;

    public function addAssociatedProduct(ProductInterface $product): void;

    public function removeAssociatedProduct(ProductInterface $product): void;

    public function hasAssociatedProduct(ProductInterface $product): bool;

    public function clearAssociatedProducts(): void;
}
