<?php

namespace WB\PreOrderGrid\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_PREORDERGRID = 'preordergrid/';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PREORDERGRID . 'general/' . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isModuleEnabled($storeId = null)
    {
        return $this->getConfigValue('enable', $storeId);
    }
}
