# Utils

[![Build Status](https://travis-ci.org/Prowect/Utils.svg)](https://travis-ci.org/Prowect/Utils)
[![Code Climate](https://codeclimate.com/github/Prowect/Utils/badges/gpa.svg)](https://codeclimate.com/github/Prowect/Utils)
[![Test Coverage](https://codeclimate.com/github/Prowect/Utils/badges/coverage.svg)](https://codeclimate.com/github/Prowect/Utils/coverage)
[![Latest Release](https://img.shields.io/packagist/v/drips/Utils.svg)](https://packagist.org/packages/drips/utils)

## Beschreibung

Diese Paket beinhaltet mehrere nützliche (PHP)-Tools, die im folgenden vorgestellt werden.

## Nützliche PHP Tools

* Event
* ICompiler
* IData Provider
* Outputbuffer

### OutputBuffer

**Beschreibung**
Der Outputbuffer ermöglicht das Speichern von Strings und Ausgeben zu einem späteren Zeitpunkt. Zusätzlich kann der Inhalt mit `getContent()`  abgerufen werden.

**Installation**
Die Datei `vendor/autoload.php` muss included werden.

**Beispiel**

```php
<?php

include "vendor/autoload.php";

use Drips\Utils\OutputBuffer;

echo "before output Buffer<br/>";
$ob = new OutputBuffer();

// alle folgenden Strings werden in $content gespeichert.
$ob->start();
echo "Hello World";

// gibt den Inhalt von $content zurück.
$ob->end();
echo"after output Buffer<br/>";

// Ausgabe
echo $ob->getContent();

?>
```

erzeugt folgende Ausgabe:

```
before outputBuffer
after outputBuffer
Hello World
```

## Nützliche Funktionen

* `array_extract` - ermöglicht die Filterung eines Arrays

### array_extract

```php
<?php
$input = array("a" => 1, "b" => 2, "c" => 3);
$extract = array("a", "b");
$result = array_extract($input, $extract); // $result = array("a" => 1, "b" => 2);
```
