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

use PrintPlanet\Sylius\Component\Resource\Model\CodeAwareInterface;
use PrintPlanet\Sylius\Component\Resource\Model\ResourceInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TimestampableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslatableInterface;
use PrintPlanet\Sylius\Component\Resource\Model\TranslationInterface;

interface AttributeInterface extends
    ResourceInterface,
    CodeAwareInterface,
    TimestampableInterface,
    TranslatableInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getType(): ?string;

    public function setType(?string $type): void;

    public function getConfiguration(): array;

    public function setConfiguration(array $configuration): void;

    public function getStorageType(): ?string;

    public function setStorageType(string $storageType): void;

    public function getPosition(): ?int;

    public function setPosition(?int $position): void;

    /**
     * @param string|null $locale
     *
     * @return AttributeTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
