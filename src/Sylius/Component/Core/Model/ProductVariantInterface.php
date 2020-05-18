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

use PrintPlanet\Sylius\Component\Attribute\Model\AttributeSubjectInterface;
use PrintPlanet\Sylius\Component\Product\Model\ProductVariantInterface as BaseVariantInterface;
use PrintPlanet\Sylius\Component\Shipping\Model\ShippableInterface;
use PrintPlanet\Sylius\Component\Inventory\Model\StockableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\VersionedInterface;

interface ProductVariantInterface extends
    AttributeSubjectInterface,
    BaseVariantInterface,
    ShippableInterface,
    StockableInterface,
    VersionedInterface,
    ProductImagesAwareInterface,
    ProductVariantExtendedInterface
{
    public function getWeight(): ?float;

    public function setWeight(?float $weight): void;

    public function getWidth(): ?float;

    public function setWidth(?float $width): void;

    public function getHeight(): ?float;

    public function setHeight(?float $height): void;

    public function getDepth(): ?float;

    public function setDepth(?float $depth): void;

    public function isShippingRequired(): bool;

    public function setShippingRequired(bool $shippingRequired): void;
}
