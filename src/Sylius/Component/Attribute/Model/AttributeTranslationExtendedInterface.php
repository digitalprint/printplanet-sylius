<?php

/*
 * This file is part of the PrintPlanet/Sylius package.
 *
 * (c) Nikos Papagiannopoulos
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PrintPlanet\Sylius\Component\Attribute\Model;

interface AttributeTranslationExtendedInterface
{
    public function getAttribute(): AttributeInterface;

    public function setAttribute(AttributeInterface $attribute): void;
}
