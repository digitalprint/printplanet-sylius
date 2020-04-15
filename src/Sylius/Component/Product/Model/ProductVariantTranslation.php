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

use PrintPlanet\Sylius\Component\Resource\Model\AbstractTranslation;
use PrintPlanet\Sylius\Component\Core\Model\ProductVariant;

class ProductVariantTranslation extends AbstractTranslation implements ProductVariantTranslationInterface
{
    /** @var mixed */
    protected $id;

    /** @var string */
    protected $name;

    /** @var ProductVariant */
    protected $productVariant;

    /**
     * @var string|null $designerUrl
     */
    private $designerUrl;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ProductVariant
     */
    public function getProductVariant(): ProductVariant
    {
        return $this->productVariant;
    }

    /**
     * @param ProductVariant $productVariant
     */
    public function setProductVariant(ProductVariant $productVariant): void
    {
        $this->productVariant = $productVariant;
    }

    /**
     * @return string|null
     */
    public function getDesignerUrl(): ?string
    {
        return $this->designerUrl;
    }

    /**
     * @param string|null $designerUrl
     */
    public function setDesignerUrl(?string $designerUrl): void
    {
        $this->designerUrl = $designerUrl;
    }
}
