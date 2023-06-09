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

namespace PrintPlanet\Sylius\Component\Inventory\Model;

interface StockableInterface
{
    public function getInventoryName(): ?string;

    public function isInStock(): bool;

    public function getOnHold(): ?int;

    public function setOnHold(?int $onHold): void;

    public function getOnHand(): ?int;

    public function setOnHand(?int $onHand): void;

    public function isTracked(): bool;

    public function setTracked(bool $tracked): void;
}
