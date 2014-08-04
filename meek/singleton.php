<?php

/* singleton pattern base class for kernel */
 
abstract class meekSingleton extends meekObject {

    /* constructor */
    
    final protected function __construct() {
        
        $this->_init();
        
    }
    
    /* clone constructor */
    
    final private function __clone() {
        
    }
    
    /* destructor */
   	
    final public function __destruct() {
        
        $this->_kill();
        
    } 
    
    /* init function that can by overloaded */
    
    protected function _init() {
        
    }
    
    /* kill function that can be overloaded */
    
    protected function _kill() {
    
    }
    
    /* return the only instance of a class */
    
    final public static function instance() {
        
        static $instances = array();
		
        $classname = get_called_class();
		
        if (array_key_exists($classname, $instances) == true) {
            
            if ($instances[$classname] != null) {
                
                return ($instances[$classname]);
                
            } 
            
        }
		
        return ($instances[$classname] = new $classname());
        
    }
    
}

