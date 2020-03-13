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

namespace PrintPlanet\Sylius\Component\Attribute\Model;

use Doctrine\Common\Collections\Collection;

interface AttributeSubjectInterface
{
    /**
     * @return Collection|AttributeValueInterface[]
     */
    public function getAttributes(): Collection;

    /**
     * @param string      $localeCode
     * @param string      $fallbackLocaleCode
     * @param string|null $baseLocaleCode
     *
     * @return Collection|AttributeValueInterface[]
     */
    public function getAttributesByLocale(
        string $localeCode,
        string $fallbackLocaleCode,
        ?string $baseLocaleCode = null
    ): Collection;

    public function addAttribute(AttributeValueInterface $attribute): void;

    public function removeAttribute(AttributeValueInterface $attribute): void;

    public function hasAttribute(AttributeValueInterface $attribute): bool;

    public function hasAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): bool;

    public function getAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): ?AttributeValueInterface;
}
