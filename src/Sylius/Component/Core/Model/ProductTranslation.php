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

use PrintPlanet\Sylius\Component\Product\Model\ProductTranslation as BaseProductTranslation;

class ProductTranslation extends BaseProductTranslation implements ProductTranslationInterface
{
    /** @var ProductInterface */
    protected $product;

    /** @var string */
    protected $shortDescription;

    /**
     * {@inheritdoc}
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * {@inheritdoc}
     */
    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }
}
