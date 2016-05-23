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

### Event

#### Beschreibung
Die Event-Klasse ermöglicht das Registrieren mehrerer Callbacks für verschiedene Events. Wenn eine andere Klasse das Event auslöst, werden die verknüpften Callbacks aufgerufen. Es können auch Parameter für die Callbacks übergeben werden übergeben werden.

#### Installation
Die Datei `vendor/autoload.php` muss included werden. Danach können Klassen von `Event` erben, um Events zu definieren und auszulösen.

#### Beispiel

```php
<?php

include "vendor/autoload.php";

use Drips\Utils\Event;

class FileSaver extends Event {
    
    function __construct() {
        self::on("saved", function() {
	echo "file saved on: ".date("Y-m-d h:m:s",time());
});
    }
    
    function save() {
        self::call("saved");
    }
    
}

$saver = new FileSaver();
$saver::save();

?>
```

Der obige Code kann z.B. folgende Ausgabe liefern:

`file saved on: 2016-05-23 12:05:46`

### OutputBuffer

#### Beschreibung
Der Outputbuffer ermöglicht das Speichern von Strings und Ausgeben zu einem späteren Zeitpunkt. Zusätzlich kann der Inhalt mit `getContent()`  abgerufen werden.

#### Installation
Die Datei `vendor/autoload.php` muss included werden.

#### Beispiel

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
