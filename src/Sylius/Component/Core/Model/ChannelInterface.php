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

namespace PrintPlanet\Sylius\Component\Core\Model;

use PrintPlanet\Sylius\Component\Addressing\Model\ZoneInterface;
use PrintPlanet\Sylius\Component\Channel\Model\ChannelInterface as BaseChannelInterface;
use PrintPlanet\Sylius\Component\Currency\Model\CurrenciesAwareInterface;
use PrintPlanet\Sylius\Component\Currency\Model\CurrencyInterface;
use PrintPlanet\Sylius\Component\Locale\Model\LocaleInterface;
use PrintPlanet\Sylius\Component\Locale\Model\LocalesAwareInterface;

interface ChannelInterface extends BaseChannelInterface, CurrenciesAwareInterface, LocalesAwareInterface
{
    public function getBaseCurrency(): ?CurrencyInterface;

    public function setBaseCurrency(?CurrencyInterface $currency): void;

    public function getDefaultLocale(): ?LocaleInterface;

    public function setDefaultLocale(?LocaleInterface $locale): void;

    public function getDefaultTaxZone(): ?ZoneInterface;

    public function setDefaultTaxZone(?ZoneInterface $defaultTaxZone): void;

    public function getTaxCalculationStrategy(): ?string;

    public function setTaxCalculationStrategy(?string $taxCalculationStrategy): void;

    public function getThemeName(): ?string;

    public function setThemeName(?string $themeName): void;

    public function getContactEmail(): ?string;

    public function setContactEmail(?string $contactEmail): void;

    public function isSkippingShippingStepAllowed(): bool;

    public function setSkippingShippingStepAllowed(bool $skippingShippingStepAllowed): void;

    public function isSkippingPaymentStepAllowed(): bool;

    public function setSkippingPaymentStepAllowed(bool $skippingPaymentStepAllowed): void;

    public function isAccountVerificationRequired(): bool;

    public function setAccountVerificationRequired(bool $accountVerificationRequired): void;

    public function getShopBillingData(): ?ShopBillingDataInterface;

    public function setShopBillingData(ShopBillingDataInterface $shopBillingData): void;
}
