<?php

/**
 * Created by Prowect
 * Author: Raffael Kessler
 * Date: 03.04.2016 - 18:00.
 * Copyright Prowect.
 */

namespace Drips\Utils;

use Callback;

/**
 * Class Event.
 *
 * Ermöglicht das Abfangen und Auslösen von Events innerhalb einer Klasse
 */
trait Event
{
    protected static $events = array();

    /**
     * Registriert eine Callback-Funktion für ein bestimmtes Event. Wird das Event
     * von der jeweiligen Klasse ausgelöst (call), so wird die übergebene Callback-Funktion
     * ausgeführt.
     *
     * @param  string  $event Name des Events
     * @param  Callback $callback Callback-Funktion, die ausgeführt werden soll
     */
    public static function on($event, Callback $callback)
    {
        static::$events[get_called_class()][$event][] = $callback;
    }

    /**
     * Dient zum Auslösen von Events innerhalb der jeweiligen Klasse.
     * Je nach Art des Events, können auch Parameter übergeben werden, welche
     * wiederum von den jeweiligen Callback-Funktionen geändert werden können.
     *
     * @param  string $event Name des Events
     * @param  array  $args Optional die jeweilige Parameter bzw. der jeweilige Parameter
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
