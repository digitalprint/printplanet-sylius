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

use PrintPlanet\Sylius\Component\Resource\Model\AbstractTranslation;

class ProductVariantAssociationTypeTranslation extends AbstractTranslation implements ProductVariantAssociationTypeTranslationInterface
{
    /** @var mixed */
    protected $id;

    /** @var string|null */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}

