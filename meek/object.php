<?php

/* base class for all meekphp classes */

abstract class meekObject {
    
    /* redirect to another url */
    
    final protected function _redirect($_url) {
        
        header('Location: ' . $_url);
        
        exit();
        
    } /* end _redirect function */
    
} /* end meekObject class */

