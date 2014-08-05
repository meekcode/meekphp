<?php
/**
 * <meek/object.php>
 * 
 * This file contains the application script.
 * 
 * All modules and their config are to be placed in this file as well as the
 * running of the kernel to load controllers.
 * 
 * <Licence>
 * 
 * This program is free software: you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @package    meekphp
 * @author     Michael Edwards <meekcode.com@gmail.com>
 * @copyright  2014 Michael Edwards
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GPL version 2
 * @link       https://github.com/meekcode/meekphp/
 */

/**
 * This is the base class for all other classes used in meekphp.
 * 
 * @subpackage meekObject
 */
abstract class meekObject {
    
    /**
     * Return reference to kernel.
     * 
     * @return meekKernel
     */
    final protected function _meek() {
        return (meekKernel::instance());
    }
    
    /**
     * Redirect the browser to another URL.
     * 
     * @param string $_url
     * @return void
     */
    final protected function _redirect($_url) {
        header('Location: ' . $_url);
        exit();
    }
}

