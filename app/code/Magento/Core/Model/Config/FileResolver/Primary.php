<?php
/**
 * Application primary config file resolver
 *
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
namespace Magento\Core\Model\Config\FileResolver;

/***
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class Primary implements \Magento\Config\FileResolverInterface
{
    /**
     * @var \Magento\Core\Model\Dir
     */
    protected $_applicationDirs;

    /**
     * @param \Magento\Core\Model\Dir $dirs
     */
    public function __construct(\Magento\Core\Model\Dir $dirs)
    {
        $this->_applicationDirs = $dirs;
    }

    /**
     * Retrieve the list of configuration files with given name that relate to specified scope
     *
     * @param string $filename
     * @param string $scope
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function get($filename, $scope)
    {
        $configDir = $this->_applicationDirs->getDir(\Magento\Core\Model\Dir::CONFIG);
        $fileList = glob($configDir . DIRECTORY_SEPARATOR . '*' . DIRECTORY_SEPARATOR . $filename);

        if (file_exists($configDir . DIRECTORY_SEPARATOR . $filename)) {
            array_unshift($fileList, $configDir . DIRECTORY_SEPARATOR . $filename);
        }
        return $fileList;
    }
}
