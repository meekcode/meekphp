<?php

/* default application */
class applicationIndex extends meekApplication {
    
    /* default task */
    public function index() {
        $this->_meek()->example->hello();
        return (true);
    }
}

