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

/**
 * Kernel for the framework. Loads services and provides access to them
 * through __get magic method. Kernel also loads applications and runs specific
 * tasks on request.
 * 
 * @subpackage meekKernel
 */
final class meekKernel extends meekSingleton {
    
    /**
     * @var meekService[] $services Array of loaded services.
     */
    private $services = array();
    
    /**
     * @var boolean $running Used to block recursion in run method.
     */
    private $running = false;
    
    /**
     * Accessor for kernel services.
     * 
     * @param string $_name Service name.
     * @return meekService|null Reference to service or null on failure.
     */
    final public function __get($_name) {
        
        /* if service name is valid, return reference to service */
        $name = strtolower($_name);
        if (array_key_exists($name, $this->services) == true) {
            return ($this->services[$name]);
        }
        
        /* if service name isn't valid, return null */
        return (null);
    }
    
    /**
     * Loads a service class file and then creates an instance of that class.
     * 
     * @param string $_name Name of the service class to load.
     * @return boolean True on successful, false on failure.
     */
    final public function load($_name) {    
        
        /* if service name already loaded, return true */
        $name = strtolower($_name);
        if (array_key_exists($name, $this->services) == true) {
            return (true);
        }
        
        /* load service class file, return false on failure */
        $file = __PATH__ . 'services/' . $name . '/' . $name . '.php';
        if (file_exists($file) == false) {
            return (false);
        }
        include_once ($file);
        
        /* check if service class has be defined, return false on failure */
        $class = 'service' . $name;
        if (class_exists($class) == false) {
            return (false);
        }
        
        /* create instance of class, save reference and return true */
        $this->services[$name] = new $class();
        return (true);
    }
    
    /**
     * Process and run a command.
     * 
     * @param string $_command Command string to process and run.
     * @return boolean 
     */
    final public function run($_command = '') {
        
        /* block recursion */
        if ($this->running == true) {
            return (false);
        }
        $this->running = true;
    
        /* break up command into components */
        $command = explode('/', ltrim($_command . '', '/'));
        
        /* load application class file, return false on failure */
        $name = 'index';
        if (strlen($command[0]) > 0) {
            $name = strtolower($command[0]);
        }
        $file = __PATH__ . 'applications/' . $name . '/' . $name . '.php';
        if (file_exists($file) == false) {
            return ($this->running = false);
        }
        include_once ($file);
        
        /* create instance of application, return false on failure */
        $class = 'application' . $name;
        if (class_exists($class) == false) {
            return ($this->running = false);
        }
        $application = new $class();
        
        /* run application task, return false of failure or save result */
        $task = 'index';
        if (count($command) > 1) {
            $task = strtolower($command[1]);
        }
        if (method_exists($application, $task) == false) {
            return ($this->running = false);
        }
        $parameters = array();
        for ($i = 0; $i < count($command); $i++) {
            if ($i > 1) {
                $parameters[$i-2] = $command[$i];
            }
        }
        $function = array($application, $task);
        $result = call_user_func_array($function, $parameters);
        
        /* unblock recursion and return result */
        $this->running = false;
        return ($result);
    }
}

