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
use PrintPlanet\Sylius\Component\Attribute\Model\AttributeSubjectInterface;
use PrintPlanet\Sylius\Component\Resource\Model\CodeAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\SlugAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TimestampableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\ToggleableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;

interface ProductInterface extends
    AttributeSubjectInterface,
    CodeAwareInterface,
    ResourceInterface,
    SlugAwareInterface,
    TimestampableInterface,
    ToggleableInterface,
    TranslatableInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getMetaKeywords(): ?string;

    public function setMetaKeywords(?string $metaKeywords): void;

    public function getMetaDescription(): ?string;

    public function setMetaDescription(?string $metaDescription): void;

    public function hasVariants(): bool;

    /**
     * @return Collection|ProductVariantInterface[]
     */
    public function getVariants(): Collection;

    public function addVariant(ProductVariantInterface $variant): void;

    public function removeVariant(ProductVariantInterface $variant): void;

    public function hasVariant(ProductVariantInterface $variant): bool;

    public function hasOptions(): bool;

    /**
     * @return Collection|ProductOptionInterface[]
     */
    public function getOptions(): Collection;

    public function addOption(ProductOptionInterface $option): void;

    public function removeOption(ProductOptionInterface $option): void;

    public function hasOption(ProductOptionInterface $option): bool;

    /**
     * @return Collection|ProductAssociationInterface[]
     */
    public function getAssociations(): Collection;

    public function addAssociation(ProductAssociationInterface $association): void;

    public function removeAssociation(ProductAssociationInterface $association): void;

    public function isSimple(): bool;

    public function isConfigurable(): bool;

    /**
     * @param string|null $locale
     *
     * @return ProductTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
