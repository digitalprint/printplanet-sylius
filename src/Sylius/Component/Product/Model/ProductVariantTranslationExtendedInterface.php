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

namespace PrintPlanet\Sylius\Component\Product\Model;

use PrintPlanet\Sylius\Component\Core\Model\ProductVariant;

interface ProductVariantTranslationExtendedInterface
{
    public function getProductVariant(): ProductVariant;

    public function setProductVariant(ProductVariant $productVariant): void;

    public function getDesignerUrl(): ?string;

    public function setDesignerUrl(?string $designerUrl): void;
}
