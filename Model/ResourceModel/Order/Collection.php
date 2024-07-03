<?php

namespace WB\PreOrderGrid\Model\ResourceModel\Order;

use Magento\Sales\Model\ResourceModel\Order\Collection as OrderCollection;

class Collection extends OrderCollection
{
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->addFieldToFilter('status', 'preorder');
        return $this;
    }
}
