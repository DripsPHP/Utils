<?php

namespace Drips\Utils;

/**
 * Class Event
 *
 * PHP-Trait für ein Eventsystem. Eine Klasse kann den Trait verwenden und anschließend Events auslösen (call).
 * Von außen können Callbacks für bestimmte Events registriert werden (on).
 * Wird das Event ausgelöst, werden automatisch alle Callbacks ausgeführt.
 *
 * @package Drips\Utils
 */
trait Event
{
    protected static $events = array();

    /**
     * Registriert eine Callback-Funktion für ein bestimmtes Event. Wird das Event von der jeweiligen Klasse ausgelöst
     * (call), so wird die übergebene Callback-Funktion ausgeführt.
     *
     * @param  string $event Name des Events
     * @param  callable $callback Callback-Funktion, die ausgeführt werden soll
     */
    public static function on($event, callable $callback)
    {
        static::$events[get_called_class()][$event][] = $callback;
    }

    /**
     * Dient zum Auslösen von Events innerhalb der jeweiligen Klasse. Je nach Art des Events, können auch Parameter
     * übergeben werden, welche wiederum von den jeweiligen Callback-Funktionen geändert werden können.
     *
     * @param  string $event Name des Events
     * @param  array $args Optional die jeweiligen Parameter bzw. der jeweilige Parameter, der übergeben werden soll
     *
     * @return mixed das veränderte Argument bzw. die veränderten Argumente
     */
    protected static function call($event, $args = array())
    {
        if (array_key_exists(get_called_class(), static::$events) && array_key_exists($event, static::$events[get_called_class()])) {
            foreach (static::$events[get_called_class()][$event] as $callback) {
                if (is_array($args)) {
                    $newArgs = call_user_func_array($callback, $args);
                } else {
                    $newArgs = call_user_func($callback, $args);
                }
                if (!empty($newArgs)) {
                    $args = $newArgs;
                }
            }
        }
        return $args;
    }
}
