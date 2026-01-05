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
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableInterface;

class ProductTranslation extends BaseProductTranslation implements ProductTranslationInterface
{
    /** @var ProductInterface */
    protected $product;

    /** @var string */
    protected $shortDescription;

    /** @var string */
    protected $metaTitle;

    /** @var string */
    protected $metaDescriptionText;

    /**
     * {@inheritdoc}
     */
    public function setTranslatable(?TranslatableInterface $translatable): void
    {
        parent::setTranslatable($translatable);

        if (null === $translatable || $translatable instanceof ProductInterface) {
            $this->product = $translatable;
        }
    }

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

    /**
     * {@inheritdoc}
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetaTitle(?string $metaTitle): void
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetaDescriptionText(): ?string
    {
        return $this->metaDescriptionText;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetaDescriptionText(?string $metaDescriptionText): void
    {
        $this->metaDescriptionText = $metaDescriptionText;
    }
}
