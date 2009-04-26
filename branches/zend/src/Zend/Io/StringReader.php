<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Io
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**#@+ @ignore */
require_once 'Zend/Io/Reader.php';
/**#@-*/

/**
 * The Zend_Io_StringReader represents a character stream whose source is
 * a string.
 *
 * @category   Zend
 * @package    Zend_Io
 * @author     Sven Vollbehr <sven@vollbehr.eu>
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */
class Zend_Io_StringReader extends Zend_Io_Reader
{
    /**
     * Constructs the Zend_Io_StringReader class with given source string.
     *
     * @param string $data The string to use as the source.
     * @throws Zend_Io_Exception if an I/O error occurs
     */
    public function __construct($data)
    {
        if (($this->_fd = fopen('php://memory', 'w+b')) === false) {
            require_once('Zend/Io/Exception.php');
            throw new Zend_Io_Exception('Unable to open php://memory stream');
        }
        if ($data !== null && is_string($data)) {
            if (($this->_size = fwrite($this->_fd, $data, $tagSize)) === false) {
                require_once('Zend/Io/Exception.php');
                throw new Zend_Io_Exception('Unable to write data to php://memory stream');
            }
            fseek($this->_fd, 0);
        }
    }

    /**
     * Closes the file descriptor.
     */
    public function __destruct()
    {
        $this->close();
    }
}
