<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015-2020 Dominik Pfaffenbauer (https://www.pfaffenbauer.at)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace CoreShop\Bundle\PayumBundle\EventListener;

use Doctrine\DBAL\Connection;
use Payum\Bundle\PayumBundle\Controller\PayumController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class TransactionListener implements EventSubscriberInterface
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (!$controller instanceof PayumController) {
            return;
        }

        $event->getRequest()->attributes->add(['PAYUM_TRANSACTION_ACTIVE' => true]);

        $this->connection->beginTransaction();
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        if (!$event->getRequest()->attributes->get('PAYUM_TRANSACTION_ACTIVE')) {
            return;
        }

        $this->connection->commit();
    }
}
