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

use PrintPlanet\Sylius\Component\Attribute\Model\AttributeValue as BaseAttributeValue;
use Webmozart\Assert\Assert;

class ProductVariantAttributeValue extends BaseAttributeValue implements ProductVariantAttributeValueInterface
{
    /**
     * {@inheritdoc}
     */
    public function getProductVariant(): ?ProductVariantInterface
    {
        $subject = $this->getSubject();

        /* @var ProductVariantInterface|null $subject */
        Assert::nullOrIsInstanceOf($subject, ProductVariantInterface::class);

        return $subject;
    }

    /**
     * {@inheritdoc}
     */
    public function setProductVariant(?ProductVariantInterface $productVariant): void
    {
        $this->setSubject($productVariant);
    }
}
