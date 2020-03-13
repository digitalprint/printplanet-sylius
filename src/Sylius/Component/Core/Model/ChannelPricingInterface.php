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

use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;

interface ChannelPricingInterface extends ResourceInterface
{
    public function getProductVariant(): ?ProductVariantInterface;

    public function setProductVariant(?ProductVariantInterface $productVariant): void;

    public function getPrice(): ?int;

    public function setPrice(?int $price): void;

    /**
     * @return string
     */
    public function getChannelCode(): ?string;

    public function setChannelCode(?string $channelCode): void;

    public function getOriginalPrice(): ?int;

    public function setOriginalPrice(?int $originalPrice): void;

    public function isPriceReduced(): bool;
}
