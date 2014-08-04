<?php
/**
 * <meek/module.php>
 * 
 * This file contains the meekModule class.
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
 * This is the base class for all modules used in meekphp. 
 * 
 * It acts as a parent to a child object and shares public methods from that
 * child. It also acts as a data store for the child. Module classes are 
 * loaded by the kernel and are access through the kernel __get method.
 * 
 * @subpackage meekModule
 */
abstract class meekModule extends meekObject {
    
    /**
     * @var meekModuleChild $child Reference to child object.
     */
    private $child = null;
    
    /**
     * @var mixed[] $data Properties of the module.
     */
    private $data = array();

    /**
     * Public child methods are called if no method exists in module.
     * 
     * @param string $_name Method name.
     * @param mixed[] $_args Method parameters.
     * @return mixed|null Result from method or null.
     */
    final public function __call ($_name, $_args) {
        
        /* if child object doesn't exist then return null */
        if ($this->child == null) {
            return (null);
        }
        
        /* if method doesn't exists then return null */
        if (method_exists ($this->child, $_name) == false) {
            return (null);
        }
        
        /* call child method and return result */
        $action = array($this->child, $_name);
        return(call_user_func_array($action, $_args));      
    }
    
    /**
     * Finalise the constructor and call overloadable init method.
     */
    final public function __construct() {
        $this->_init();
    }
    
    /**
     * Finalise the destructor and call overloadable kill method.
     */
    final public function __destruct() {
        $this->_kill();
    }
    
    /**
     * Accessor for module properties.
     * 
     * @param string $_name Property name.
     * @return mixed|null Return property value or null.
     */
    final public function __get($_name)
    {
        /* if property exists then return it, otherwise return null */
        $name = strtolower($_name);
        if (array_key_exists($name, $this->data) == true) {
            return ($this->data[$name]);
        }
        return (null);
    }
    
    /**
     * Mutator for module properties.
     * 
     * @param string $_name Property name.
     * @param mixed $_value Property value.
     * @return mixed Return value set.
     */
    final public function __set($_name, $_value) {
        $name = strtolower($_name);
        return ($this->data[$name] = $_value);
    }
    
    /**
     * Reference to child object.
     * 
     * @return meekModuleChild|null
     */
    final protected function _child() {
        return ($this->child);
    }
    
    /**
     * Return properties array.
     * 
     * @return mixed[]
     */
    final protected function _data() {
        return ($this->data);
    }
    
    /**
     * Overloadable init method for sub classes.
     * 
     * @return void
     */
    protected function _init() {
    }
    
    /**
     * Overloadable kill method for sub classes.
     * 
     * @return void
     */
    protected function _kill() {
    }
    
    /**
     * Loads a child class file and then creates an instance of that class.
     * 
     * @param string $_name Name of the child class to load.
     * @return boolean True on successful, false on failure.
     */
    final public function load($_name) {    
        
        /* load child class file, return false on failure */
        $name = strtolower($_name);
        $class = strtolower(substr(get_class($this), 6));
        $file = __PATH__ . 'modules/' . $class . '/' . $name . '.php';
        if (file_exists($file) == false) {
            return (false);
        }
        include_once ($file);
        
        /* check if child class has be defined, return false on failure */
        $child = $class . $name;
        if (class_exists($child) == false) {
            return (false);
        }
        
        /* create instance of class, save reference and return true */
        $this->child = new $child($this);
        return (true);
    }
}

