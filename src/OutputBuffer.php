<?php

namespace Drips\Utils;

/**
 * Created by Prowect
 * Author: Raffael Kessler
 * Date: 09.03.2016 - 17:20.
 * Copyright Prowect.
 */
class OutputBuffer
{
    protected $isActive = false;
    protected $content;

    /**
     * Startet das Buffern der Ausgabe
     */
    public function start()
    {
        $this->content = '';
        $this->isActive = ob_start();
    }

    /**
     * Beendet das Buffern der Ausgabe und liefert das Gebufferte als String
     * zurück.
     *
     * @return string
     */
    public function end()
    {
        if($this->isActive){
            $this->content = ob_get_contents();
            ob_end_clean();
            $this->isActive = false;
        }
        return $this->getContent();
    }

    /**
     * Gibt das Gebufferte zurück.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
