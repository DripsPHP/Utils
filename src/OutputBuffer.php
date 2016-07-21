<?php

namespace Drips\Utils;

/**
 * Class OutputBuffer
 *
 * Objektorientierter OutputBuffer zum Buffern der Ausgabe. (ob_start)
 *
 * @package Drips\Utils
 */
class OutputBuffer
{
    /**
     * Flag ob der der OutputBuffer aktiv ist oder nicht
     *
     * @var bool
     */
    protected $isActive = false;

    /**
     * Beinhaltet die gebufferte Ausgabe des OutputBuffers
     *
     * @var string
     */
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
     * Beendet das Buffern der Ausgabe und liefert das "Gebufferte" als String zurück.
     *
     * @return string
     */
    public function end()
    {
        if ($this->isActive) {
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
