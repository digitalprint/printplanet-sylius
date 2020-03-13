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

namespace PrintPlanet\Sylius\Component\Taxonomy\Model;

use Doctrine\Common\Collections\Collection;
use PrintPlanet\Sylius\Component\Resource\Model\CodeAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\SlugAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;
use PrintPlanet\Sylius\Component\Resource\Model\UrlAwareInterface;

interface TaxonInterface extends CodeAwareInterface, TranslatableInterface, ResourceInterface, SlugAwareInterface, UrlAwareInterface
{
    public function isRoot(): bool;

    /**
     * @return TaxonInterface|null
     */
    public function getRoot(): ?self;

    /**
     * @return TaxonInterface|null
     */
    public function getParent(): ?self;

    /**
     * @param TaxonInterface|null $taxon
     */
    public function setParent(?self $taxon): void;

    /**
     * @return Collection|TaxonInterface[]
     */
    public function getAncestors(): Collection;

    /**
     * @return Collection|TaxonInterface[]
     */
    public function getChildren(): Collection;

    /**
     * @param TaxonInterface $taxon
     * @return bool
     */
    public function hasChild(self $taxon): bool;

    public function hasChildren(): bool;

    /**
     * @param TaxonInterface $taxon
     */
    public function addChild(self $taxon): void;

    /**
     * @param TaxonInterface $taxon
     */
    public function removeChild(self $taxon): void;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getFullname(string $pathDelimiter = ' / '): ?string;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getLeft(): ?int;

    public function setLeft(?int $left): void;

    public function getRight(): ?int;

    public function setRight(?int $right): void;

    public function getLevel(): ?int;

    public function setLevel(?int $level): void;

    public function getPosition(): ?int;

    public function setPosition(?int $position): void;

    /**
     * @param string|null $locale
     *
     * @return TaxonTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
