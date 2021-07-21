<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015-2021 Dominik Pfaffenbauer (https://www.pfaffenbauer.at)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

declare(strict_types=1);

namespace CoreShop\Behat\Page\Frontend\Checkout;

use CoreShop\Behat\Page\Frontend\AbstractFrontendPage;

class ThankYouPage extends AbstractFrontendPage implements ThankYouPageInterface
{
    public function getRouteName(): string
    {
        return 'coreshop_checkout_confirmation';
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [

        ]);
    }
}
