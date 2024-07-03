<?php

namespace WB\PreOrderGrid\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Status extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if ($item['status'] == 'preorder') {
                    $item[$this->getData('name')] = '<span class="grid-severity-notice"><span>Pre-Order</span></span>';
                }
            }
        }
        return $dataSource;
    }
}