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

use PrintPlanet\Sylius\Component\Product\Model\ProductInterface as BaseProductInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;

interface ProductInterface extends BaseProductInterface, ProductTaxonsAwareInterface, ImagesAwareInterface
{
    /*
     * Variant selection methods.
     *
     * 1) Choice - A list of all variants is displayed to user.
     *
     * 2) Match  - Each product option is displayed as select field.
     *             User selects the values and we match them to variant.
     */
    public const VARIANT_SELECTION_CHOICE = 'choice';
    public const VARIANT_SELECTION_MATCH = 'match';

    public function getVariantSelectionMethod(): string;

    /**
     * @param string|null $variantSelectionMethod
     *
     * @throws \InvalidArgumentException
     */
    public function setVariantSelectionMethod(?string $variantSelectionMethod): void;

    public function isVariantSelectionMethodChoice(): bool;

    public function getVariantSelectionMethodLabel(): string;

    public function getShortDescription(): ?string;

    public function setShortDescription(?string $shortDescription): void;

    public function getMainTaxon(): ?TaxonInterface;

    public function setMainTaxon(?TaxonInterface $mainTaxon): void;

    /**
     * @param string|null $locale
     *
     * @return ProductTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
