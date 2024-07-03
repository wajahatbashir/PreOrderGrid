<?php

namespace WB\PreOrderGrid\Block\Adminhtml\Grid\Renderer;

use Magento\Framework\DataObject;

class DateColor extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    protected $_dateTime;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        array $data = []
    ) {
        $this->_dateTime = $dateTime;
        parent::__construct($context, $data);
    }

    public function render(DataObject $row)
    {
        $deliveryDate = $row->getData('delivery_date');
        $daysRemaining = (new \DateTime())->diff(new \DateTime($deliveryDate))->days;

        if ($daysRemaining > 60) {
            $color = 'green';
        } elseif ($daysRemaining > 30) {
            $color = 'yellow';
        } else {
            $color = 'red';
        }

        return '<span style="color:' . $color . ';">' . $deliveryDate . '</span>';
    }
}
