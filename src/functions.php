<?php

/**
 * Erzeugt aus einem bestehenden Array ein neues Array mit nur definierten Inhalten.
 * Übergeben wird ein Array, z.B.: ["a" => 1, "b" => 2, "c" => 3]
 * Außerdem wird ein Extract angegeben, z.B.: ["a", "b"]
 * Dadurch wird ein neues Array erzeugt: ["a" => 1, "b" => 2]
 * D.h. das Array wird gefiltert bzw. entsprechend extrahiert.
 *
 * @param  array $array
 * @param  array $extract
 * @return array
 */
function array_extract(array $array, array $extract)
{
    return array_intersect_key($array, array_combine($extract, array_pad(array(), count($extract), null)));
}

/**
 * Erzeugt beliebige Class-Aliase mithilfe der Funktion class_alias.
 * Es kann jedoch ein assoziatives Array übergeben werden.
 * Struktur: ["Alias" => "Original/ClassName"]
 *
 * @param  array $array
 */
function class_aliase(array $array)
{
    array_map('class_alias', $array, array_keys($array));
}
