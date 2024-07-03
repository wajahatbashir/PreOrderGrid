<?php

namespace WB\PreOrderGrid\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class DeliveryDate extends Column
{
    protected $timezone;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        TimezoneInterface $timezone,
        array $components = [],
        array $data = []
    ) {
        $this->timezone = $timezone;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $deliveryDate = $this->timezone->date($item['delivery_date'])->format('Y-m-d');
                $daysRemaining = (new \DateTime())->diff(new \DateTime($deliveryDate))->days;
                
                if ($daysRemaining > 60) {
                    $color = 'green';
                } elseif ($daysRemaining > 30) {
                    $color = 'yellow';
                } else {
                    $color = 'red';
                }
                
                $item[$this->getData('name')] = '<span style="color:' . $color . ';">' . $deliveryDate . '</span>';
            }
        }
        return $dataSource;
    }
}
