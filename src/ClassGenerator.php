<?php

namespace Drips\Utils;

/**
 * Class ClassGenerator
 *
 * Generator zum Generieren von PHP-Klassen (als PHP-Code)
 *
 * @package Drips\Utils
 */
class ClassGenerator
{
    /**
     * Beinhaltet den Namen der Klasse
     *
     * @var string
     */
    protected $classname;

    /**
     * Legt fest von welcher Klasse geerbt wird, bzw. welches Interface implementiert werden soll
     *
     * @var string
     */
    protected $extends = '';

    /**
     * Legt den Namespace fest, in welchem sich die Klasse befinden soll
     *
     * @var string
     */
    protected $namespace;

    /**
     * Beinhaltet die Attribute der Klasse
     *
     * @var array
     */
    protected $attributes = array();

    /**
     * Beinhaltet die Methoden der Klasse
     *
     * @var array
     */
    protected $methods = array();

    /**
     * Erzeugt einen neuen ClassGenerator zum Erzeugen einer PHP-Klasse.
     *
     * @param string $classname Name der Klasse
     * @param string $extends Vererbung/Interfaces -> extends xxx implements yyy
     */
    public function __construct($classname, $extends = '')
    {
        $this->classname = $classname;
        $this->extends = $extends;
    }

    /**
     * Legt den Namespace für die Klasse fest
     *
     * @param $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Fügt ein Attribut zur Klasse hinzu
     *
     * @param $name Name des Attributs bzw. Name der Variable
     * @param mixed $value Wert des Attributs (default: null)
     * @param string $visibility Sichtbarkeit (public, protected, private) (default: protected)
     * @param bool $static (static? => true/false) (default: false)
     */
    public function addAttribute($name, $value = null, $visibility = 'protected', $static = false)
    {
        $this->attributes[$name] = array('value' => $value, 'visibility' => $visibility, 'static' => $static);
    }

    /**
     * Fügt eine neue Methode zur Klasse hinzu
     *
     * @param $name Name der Methode
     * @param array $params Parameter die der Methode übergeben werden
     * @param string $visibility Sichtbarkeit (public, protected, private) (default: public)
     * @param bool $static (static? true/false) (default: false)
     * @param string $method Inhalt der Methode -> PHP-Code
     */
    public function addMethod($name, $params = array(), $visibility = 'public', $static = false, $method = '')
    {
        $this->methods[$name] = array('params' => $params, 'visibility' => $visibility, 'static' => $static, 'method' => $method);
    }

    /**
     * Erzeugt den PHP-Code für die Klasse und liefert ihn als String zurück
     *
     * @param bool $withPHP (mit <?php-Tags? true/false)
     *
     * @return string
     */
    public function generate($withPHP = false)
    {
        $class = '';
        // <?php
        if ($withPHP) {
            $class .= "<?php\n";
        }
        // Comment
        $class .= "/** Generated with Drips ClassGenerator */\n\r";
        // Namespace
        if (isset($this->namespace)) {
            $class .= 'namespace ' . $this->namespace . ";\n\r";
        }
        // Class
        $class .= 'class ' . ucfirst($this->classname) . ' ' . $this->extends . " \n{\n";
        // Attributes
        foreach ($this->attributes as $attribute => $properties) {
            $class .= $properties['visibility'] . ($properties['static'] ? ' static ' : ' ') . '$' . $attribute . ($properties['value'] !== null ? ' = ' . $properties['value'] : '') . ";\n";
        }
        $class .= "\r\n";
        // Methods
        foreach ($this->methods as $method => $properties) {
            $class .= $properties['visibility'] . ($properties['static'] ? ' static ' : ' ') . 'function ' . $method . '(';
            $first = true;
            foreach ($properties['params'] as $param) {
                if (!$first) {
                    $class .= ', ';
                }
                $class .= '$' . $param;
                $first = false;
            }
            $class .= ")\n{\n" . $properties['method'] . "\n}\n\r\n";
        }
        $class .= "\r}";
        return $class;
    }
}
