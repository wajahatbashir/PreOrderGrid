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
