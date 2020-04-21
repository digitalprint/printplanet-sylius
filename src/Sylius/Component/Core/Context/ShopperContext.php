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
use PrintPlanet\Sylius\Component\Channel\Model\ChannelInterface;
use PrintPlanet\Sylius\Component\Customer\Context\CustomerContextInterface;
use PrintPlanet\Sylius\Component\Customer\Model\CustomerInterface;
use PrintPlanet\Sylius\Component\Locale\Context\LocaleContextInterface;

/**
 * Should not be extended, final removed to make this class lazy.
 */
/* final */ class ShopperContext implements ShopperContextInterface
{
    /** @var ChannelContextInterface */
    private $channelContext;

    /** @var CurrencyContextInterface */
    private $currencyContext;

    /** @var LocaleContextInterface */
    private $localeContext;

    /** @var CustomerContextInterface */
    private $customerContext;

    public function __construct(
        ChannelContextInterface $channelContext,
        CurrencyContextInterface $currencyContext,
        LocaleContextInterface $localeContext,
        CustomerContextInterface $customerContext
    ) {
        $this->channelContext = $channelContext;
        $this->currencyContext = $currencyContext;
        $this->localeContext = $localeContext;
        $this->customerContext = $customerContext;
    }

    /**
     * {@inheritdoc}
     */
    public function getChannel(): ChannelInterface
    {
        return $this->channelContext->getChannel();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyContext->getCurrencyCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getLocaleCode(): string
    {
        return $this->localeContext->getLocaleCode();
    }

    public function getCustomer(): ?CustomerInterface
    {
        return $this->customerContext->getCustomer();
    }
}
