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
use PrintPlanet\Sylius\Component\Resource\Model\CodeAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TimestampableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;

interface ProductOptionInterface extends
    ResourceInterface,
    CodeAwareInterface,
    TimestampableInterface,
    TranslatableInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @return int
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void;

    /**
     * @return Collection|ProductOptionValueInterface[]
     */
    public function getValues(): Collection;

    public function addValue(ProductOptionValueInterface $optionValue): void;

    public function removeValue(ProductOptionValueInterface $optionValue): void;

    public function hasValue(ProductOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return ProductOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
