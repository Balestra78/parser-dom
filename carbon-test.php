<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

Carbon::setlocale('it');

$result = Carbon::createFromFormat('j M Y H:i', '28 jun 2021 13:29')->diffForHumans(['parts' => 2]);

var_dump($result);