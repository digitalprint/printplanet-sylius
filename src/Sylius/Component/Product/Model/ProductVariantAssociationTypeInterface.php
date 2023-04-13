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

use PrintPlanet\Sylius\Component\Resource\Model\CodeAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TimestampableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;

interface ProductVariantAssociationTypeInterface extends
    CodeAwareInterface,
    TimestampableInterface,
    ResourceInterface,
    TranslatableInterface
{
    public const ASSOCIATION_TYPE_ACCESSORIES = 'accessories';

    public const ASSOCIATION_TYPE_MATERIALS = 'materials';

    public function getName(): ?string;

    public function setName(?string $name): void;

    /**
     * @return ProductVariantAssociationTypeTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
