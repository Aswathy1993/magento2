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
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Core\Model\TemplateEngine\Twig;

class EnvironmentFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $_dirMock;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $_extension;
    
    /** @var \PHPUnit_Framework_MockObject_MockObject \Magento\Core\Model\TemplateEngine\Twig\FullFileName */
    private $_loaderMock;

    /** @var \PHPUnit_Framework_MockObject_MockObject \Magento\Filesystem */
    private $_filesystem;
    
    /** @var \PHPUnit_Framework_MockObject_MockObject \Magento\Core\Model\Logger */
    private $_loggerMock;
    
    /**
     * Validate \Twig_Environment returned on call
     */
    public function testCreatePositive()
    {
        $this->_filesystem->expects($this->any())
            ->method('createDirectory')
            ->will($this->returnValue(null));
        
        $inst = new \Magento\Core\Model\TemplateEngine\Twig\EnvironmentFactory(
            $this->_filesystem,
            $this->_extension,
            $this->_dirMock,
            $this->_loggerMock,
            $this->_loaderMock
        );
        /**
         * @var \Twig_Environment $factoryInst
         */
        $factoryInst = $inst->create();
        $this->assertInstanceOf('Twig_Environment', $factoryInst);
    }

    /**
     * Validate \Twig_Environment returned on call even though directory not created
     */
    public function testCreateNegative()
    {
        $this->_filesystem->expects($this->any())
            ->method('createDirectory')
            ->will($this->throwException(new \Magento\Filesystem\FilesystemException()));
    
        $inst = new \Magento\Core\Model\TemplateEngine\Twig\EnvironmentFactory(
            $this->_filesystem,
            $this->_extension,
            $this->_dirMock,
            $this->_loggerMock,
            $this->_loaderMock
        );
        /**
         * @var \Twig_Environment $factoryInst
        */
        $factoryInst = $inst->create();
        $this->assertInstanceOf('Twig_Environment', $factoryInst);
    }
    
    protected function setUp()
    {
        $this->_filesystem = $this->getMockBuilder('Magento\Filesystem')
            ->disableOriginalConstructor()
            ->getMock();
                
        $this->_dirMock = $this->getMockBuilder('Magento\Core\Model\Dir')
            ->disableOriginalConstructor()
            ->getMock();

        $this->_loaderMock = $this->getMockBuilder('Magento\Core\Model\TemplateEngine\Twig\FullFileName')
            ->disableOriginalConstructor()
            ->getMock();

        $this->_extensionFactory = $this->getMockBuilder('Magento\Core\Model\TemplateEngine\Twig\ExtensionFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $this->_extension = $this->getMockBuilder('Magento\Core\Model\TemplateEngine\Twig\Extension')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_loggerMock = $this->getMockBuilder('Magento\Core\Model\Logger')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
