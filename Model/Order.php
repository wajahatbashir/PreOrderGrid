<?php

namespace WB\PreOrderGrid\Model;

use Magento\Framework\Model\AbstractModel;

class Order extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('WB\PreOrderGrid\Model\ResourceModel\Order');
    }
}
