<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Adminhtml
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Adminhtml\Block\Sales;

class Totals extends \Magento\Sales\Block\Order\Totals
{
    /**
     * Format total value based on order currency
     *
     * @param   \Magento\Object $total
     * @return  string
     */
    public function formatValue($total)
    {
        if (!$total->getIsFormated()) {
            return $this->helper('Magento\Adminhtml\Helper\Sales')->displayPrices(
                $this->getOrder(),
                $total->getBaseValue(),
                $total->getValue()
            );
        }
        return $total->getValue();
    }

    /**
     * Initialize order totals array
     *
     * @return \Magento\Sales\Block\Order\Totals
     */
    protected function _initTotals()
    {
        $this->_totals = array();
        $this->_totals['subtotal'] = new \Magento\Object(array(
            'code'      => 'subtotal',
            'value'     => $this->getSource()->getSubtotal(),
            'base_value'=> $this->getSource()->getBaseSubtotal(),
            'label'     => __('Subtotal')
        ));

        /**
         * Add shipping
         */
        if (!$this->getSource()->getIsVirtual() && ((float) $this->getSource()->getShippingAmount() || $this->getSource()->getShippingDescription()))
        {
            $this->_totals['shipping'] = new \Magento\Object(array(
                'code'      => 'shipping',
                'value'     => $this->getSource()->getShippingAmount(),
                'base_value'=> $this->getSource()->getBaseShippingAmount(),
                'label' => __('Shipping & Handling')
            ));
        }

        /**
         * Add discount
         */
        if (((float)$this->getSource()->getDiscountAmount()) != 0) {
            if ($this->getSource()->getDiscountDescription()) {
                $discountLabel = __('Discount (%1)', $this->getSource()->getDiscountDescription());
            } else {
                $discountLabel = __('Discount');
            }
            $this->_totals['discount'] = new \Magento\Object(array(
                'code'      => 'discount',
                'value'     => $this->getSource()->getDiscountAmount(),
                'base_value'=> $this->getSource()->getBaseDiscountAmount(),
                'label'     => $discountLabel
            ));
        }

        $this->_totals['grand_total'] = new \Magento\Object(array(
            'code'      => 'grand_total',
            'strong'    => true,
            'value'     => $this->getSource()->getGrandTotal(),
            'base_value'=> $this->getSource()->getBaseGrandTotal(),
            'label'     => __('Grand Total'),
            'area'      => 'footer'
        ));

        return $this;
    }
}
