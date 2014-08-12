<?php

/* default application */
class applicationIndex extends meekApplication {
    
    /* default task */
    public function index() {
        $this->_kernel()->example->hello();
        return (true);
    }
}

