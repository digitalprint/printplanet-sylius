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

use PrintPlanet\Sylius\Component\Resource\Model\CodeAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;

interface ProductOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    public function getOption(): ?ProductOptionInterface;

    public function setOption(?ProductOptionInterface $option): void;

    public function getValue(): ?string;

    public function setValue(?string $value): void;

    public function getOptionCode(): ?string;

    public function getName(): ?string;

    /**
     * @param string|null $locale
     *
     * @return ProductOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
