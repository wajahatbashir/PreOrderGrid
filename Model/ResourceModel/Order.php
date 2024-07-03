<?php

namespace WB\PreOrderGrid\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Order extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('sales_order', 'entity_id');
    }
}
