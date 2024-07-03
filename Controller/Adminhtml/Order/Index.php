<?php

namespace WB\PreOrderGrid\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        if (!$this->_authorization->isAllowed('WB_PreOrderGrid::preordergrid')) {
            return $this->resultRedirectFactory->create()->setPath('admin/noroute');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('WB_PreOrderGrid::preordergrid');
        $resultPage->getConfig()->getTitle()->prepend(__('Pre-Order Grid'));

        return $resultPage;
    }
}
