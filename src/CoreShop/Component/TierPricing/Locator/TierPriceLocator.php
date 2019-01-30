<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015-2019 Dominik Pfaffenbauer (https://www.pfaffenbauer.at)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace CoreShop\Component\TierPricing\Locator;

use CoreShop\Component\TierPricing\Model\ProductTierPriceRangeInterface;
use Doctrine\Common\Collections\Collection;

class TierPriceLocator implements TierPriceLocatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function locate(Collection $ranges, int $quantity)
    {
        if ($ranges->isEmpty()) {
            return null;
        }

        $cheapestTierPrice = null;
        /** @var ProductTierPriceRangeInterface $range */
        foreach ($ranges as $range) {
            if ($range->getRangeFrom() > $quantity) {
                break;
            }
            $cheapestTierPrice = $range;
        }

        return $cheapestTierPrice;
    }
}
