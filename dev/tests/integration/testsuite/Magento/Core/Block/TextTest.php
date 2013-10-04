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
 * @package     Magento_Core
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Core\Block;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Core\Block\Text
     */
    protected $_block;

    protected function setUp()
    {
        $this->_block = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->get('Magento\Core\Model\Layout')
            ->createBlock('Magento\Core\Block\Text');
    }

    public function testSetGetText()
    {
        $this->_block->setText('text');
        $this->assertEquals('text', $this->_block->getText());
    }

    public function testAddText()
    {
        $this->_block->addText('a');
        $this->assertEquals('a', $this->_block->getText());

        $this->_block->addText('b');
        $this->assertEquals('ab', $this->_block->getText());

        $this->_block->addText('c', false);
        $this->assertEquals('abc', $this->_block->getText());

        $this->_block->addText('-', true);
        $this->assertEquals('-abc', $this->_block->getText());
    }

    public function testToHtml()
    {
        $this->_block->setText('test');
        $this->assertEquals('test', $this->_block->toHtml());
    }
}
