<?php

namespace WB\PreOrderGrid\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class AddColumns implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $grid = $observer->getEvent()->getGrid();

        // Add custom logic to modify the grid if needed.
    }
}
