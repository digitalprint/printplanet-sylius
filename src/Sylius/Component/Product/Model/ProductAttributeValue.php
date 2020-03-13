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

class ProductAttributeValue extends BaseAttributeValue implements ProductAttributeValueInterface
{
    /**
     * {@inheritdoc}
     */
    public function getProduct(): ?ProductInterface
    {
        $subject = parent::getSubject();

        /* @var ProductInterface|null $subject */
        Assert::nullOrIsInstanceOf($subject, ProductInterface::class);

        return $subject;
    }

    /**
     * {@inheritdoc}
     */
    public function setProduct(?ProductInterface $product): void
    {
        parent::setSubject($product);
    }
}
