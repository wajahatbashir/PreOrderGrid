# WB_PreOrderGrid

## Description

WB_PreOrderGrid is a Magento 2.4 module that provides a custom grid in the Magento Admin panel to display orders with 'Pre-Order' status. The module includes color coding based on the delivery timeline, export functionality, and can be enabled/disabled via Admin configuration.

## Installation

1. Clone the repository into `app/code/WB/PreOrderGrid`:
    ```sh
    git clone https://github.com/your-repo/wb-preordergrid.git app/code/WB/PreOrderGrid
    ```

2. Enable the module:
    ```sh
    php bin/magento module:enable WB_PreOrderGrid
    ```

3. Run setup upgrade:
    ```sh
    php bin/magento setup:upgrade
    ```

4. Flush cache:
    ```sh
    php bin/magento cache:flush
    ```

## Configuration

1. Go to `Stores > Configuration > WB > Pre-Order Grid`.
2. Enable or disable the module.

## Usage

1. Navigate to `Sales > Pre-Order Grid` in the Magento Admin panel.
2. View and manage your 'Pre-Order' status orders.
3. Export the grid data using the export functionality.

## Features

- Custom grid displaying only 'Pre-Order' status orders.
- Color coding based on the delivery timeline:
  - Green: 60+ days remaining.
  - Yellow: 30-60 days remaining.
  - Red: Less than 30 days remaining.
- Export grid data to CSV or Excel.
- Enable/disable the module from the Admin configuration.

## Additional Instructions

### Adding the Correct Pre-Order Status

To ensure the module works correctly, you need to add the correct pre-order status in the following files:

1. **Model/ResourceModel/Order/Collection.php**

    ```php
    <?php

    namespace WB\PreOrderGrid\Model\ResourceModel\Order;

    use Magento\Sales\Model\ResourceModel\Order\Collection as OrderCollection;

    class Collection extends OrderCollection
    {
        protected function _initSelect()
        {
            parent::_initSelect();
            $this->addFieldToFilter('status', 'preorder'); // Ensure 'preorder' matches the actual pre-order status code in your Magento instance
            return $this;
        }
    }
    ```

2. **Ui/Component/Listing/Column/Status.php**

    ```php
    <?php

    namespace WB\PreOrderGrid\Ui\Component\Listing\Column;

    use Magento\Ui\Component\Listing\Columns\Column;

    class Status extends Column
    {
        public function prepareDataSource(array $dataSource)
        {
            if (isset($dataSource['data']['items'])) {
                foreach ($dataSource['data']['items'] as &$item) {
                    if ($item['status'] == 'preorder') { // Ensure 'preorder' matches the actual pre-order status code in your Magento instance
                        $item[$this->getData('name')] = '<span class="grid-severity-notice"><span>Pre-Order</span></span>';
                    }
                }
            }
            return $dataSource;
        }
    }
    ```

3. **Ui/Component/Listing/Column/DeliveryDate.php**

    ```php
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
    ```

Make sure to replace 'preorder' with the actual status code used for pre-order status in your Magento instance.
