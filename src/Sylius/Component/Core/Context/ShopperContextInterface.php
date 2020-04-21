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

namespace PrintPlanet\Sylius\Component\Core\Context;

use PrintPlanet\Sylius\Component\Channel\Context\ChannelContextInterface;
use PrintPlanet\Sylius\Component\Currency\Context\CurrencyContextInterface;
use PrintPlanet\Sylius\Component\Customer\Context\CustomerContextInterface;
use PrintPlanet\Sylius\Component\Locale\Context\LocaleContextInterface;

interface ShopperContextInterface extends
    ChannelContextInterface,
    CurrencyContextInterface,
    LocaleContextInterface,
    CustomerContextInterface
{
}
