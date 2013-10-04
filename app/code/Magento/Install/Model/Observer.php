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
 * @package     Magento_Install
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Installation event observer
 */
namespace Magento\Install\Model;

class Observer
{
    /**
     * Install Session
     *
     * @var \Magento\Core\Model\Session\Generic
     */
    protected $_session;

    /**
     * @param \Magento\Core\Model\Session\Generic $session
     */
    public function __construct(\Magento\Core\Model\Session\Generic $session)
    {
        $this->_session = $session;
    }


    /**
     * @param \Magento\Event\Observer $observer
     * @return $this
     */
    public function bindLocale($observer)
    {
        $locale = $observer->getEvent()->getLocale();
        if ($locale) {
            $choosedLocale = $this->_session->getLocale();
            if ($choosedLocale) {
                $locale->setLocaleCode($choosedLocale);
            }
        }
        return $this;
    }
}
