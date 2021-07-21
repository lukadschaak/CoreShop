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

namespace CoreShop\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use CoreShop\Behat\Service\SharedStorageInterface;

final class IndexConditionContext implements Context
{
    private SharedStorageInterface $sharedStorage;

    public function __construct(SharedStorageInterface $sharedStorage)
    {
        $this->sharedStorage = $sharedStorage;
    }

    /**
     * @Transform /^condition$/
     */
    public function condition()
    {
        return $this->sharedStorage->get('index_condition');
    }

    /**
     * @Transform /^condition "([^"]+)"$/
     */
    public function conditionWithIdentifier($identifier)
    {
        return $this->sharedStorage->get('index_condition_' . $identifier);
    }

    /**
     * @Transform /^conditions "([^"]+)"$/
     */
    public function conditionsWithIdentifiers($identifiers)
    {
        $conditions = [];

        foreach (explode(',', $identifiers) as $identifier) {
            $identifier = trim($identifier);

            if ($this->sharedStorage->has('index_condition_' . $identifier)) {
                $conditions[] = $this->sharedStorage->get('index_condition_' . $identifier);
            }
        }

        return $conditions;
    }
}
