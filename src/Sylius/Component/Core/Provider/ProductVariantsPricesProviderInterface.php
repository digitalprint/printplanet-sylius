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

namespace PrintPlanet\Sylius\Component\Core\Provider;

use PrintPlanet\Sylius\Component\Core\Model\ChannelInterface;
use PrintPlanet\Sylius\Component\Core\Model\ProductInterface;

interface ProductVariantsPricesProviderInterface
{
    public function provideVariantsPrices(ProductInterface $product, ChannelInterface $channel): array;
}
