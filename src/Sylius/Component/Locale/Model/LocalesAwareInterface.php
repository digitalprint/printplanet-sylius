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

namespace PrintPlanet\Sylius\Component\Locale\Model;

use Doctrine\Common\Collections\Collection;

interface LocalesAwareInterface
{
    /**
     * @return Collection|LocaleInterface[]
     */
    public function getLocales(): Collection;

    public function hasLocale(LocaleInterface $locale): bool;

    public function addLocale(LocaleInterface $locale): void;

    public function removeLocale(LocaleInterface $locale): void;
}
