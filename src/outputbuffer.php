<?php

namespace Drips\Utils;

class OutputBuffer {
    protected $isActive = false;
    protected $content;

    public function start(){
        $this->content = "";
        ob_start();
        $this->isActive = true;
    }

    public function end(){
        $this->content = ob_get_contents();
        ob_end_clean();
        $this->isActive = false;
        return $this->getContent();
    }

    public function getContent(){
        return $this->content;
    }
}
