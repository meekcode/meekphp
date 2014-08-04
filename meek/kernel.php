<?php
/**
 * <meek/kernel.php>
 * 
 * This file contains the meekKernel class.
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
 
final class meekKernel extends meekSingleton {
    
    /**
     * @var meekModule[] $modules Array of loaded modules.
     */
    private $modules = array();
    
    /**
     * Accessor for kernel modules.
     * 
     * @param string $_name Module name.
     * @return meekModule|null Reference to module or null on failure.
     */
    final public function __get($_name) {
        
        /* if module name is valid, return reference to module */
        $name = strtolower($_name);
        if (array_key_exists($name, $this->modules) == true) {
            return ($this->modules[$name]);
        }
        
        /* if module name isn't valid, return null */
        return (null);
    }
    
    /**
     * Loads a module class file and then creates an instance of that class.
     * 
     * @param string $_name Name of the module class to load.
     * @return boolean True on successful, false on failure.
     */
    final public function load($_name) {    
        
        /* if module name already loaded, return true */
        $name = strtolower($_name);
        if (array_key_exists($name, $this->modules) == true) {
            return (true);
        }
        
        /* load module class file, return false on failure */
        $file = __PATH__ . 'modules/' . $name . '/' . $name . '.php';
        if (file_exists($file) == false) {
            return (false);
        }
        include_once ($file);
        
        /* check if child class has be defined, return false on failure */
        $class = 'module' . $name;
        if (class_exists($class) == false) {
            return (false);
        }
        
        /* create instance of class, save reference and return true */
        $this->modules[$name] = new $class();
        return (true);
    }
    
    /**
     * 
     */
}

