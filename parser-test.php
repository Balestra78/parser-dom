<?php

// Assuming you installed from Composer:
require "vendor/autoload.php";

// parser
use PHPHtmlParser\Dom;
$dom = new Dom;

// utils
use \MyApp\Utils\Strings;
$str = new Strings;

// carbon
use Carbon\Carbon;
Carbon::setlocale('it');

//---------------------------------------------------------------------------
// areanapoli.it
//---------------------------------------------------------------------------

$url = 'https://www.areanapoli.it';

$dom->loadFromUrl($url);

// cover
$cover = $dom->find('.cover-main')[0];
$href = $cover->find('a')->getTag()->getAttribute('href')->getValue();
$image = $cover->find('img')->getTag()->getAttribute('src')->getValue();
$text = $cover->find('#cover-title-0')->innerHtml;

// add data to array
$api['areanapoli'][] = 
    [
        'href' => $url . $href,
        'image' => $image,
        'text' => $text
    ];

// items
$items = $dom->find('#foreground')->find('td');

foreach($items as $item) :

    $a = $item->find('a')[1];
    $href = $a->getTag()->getAttribute('href')->getValue();
    $image = str_replace('small', 'big', $item->find('img')->getTag()->getAttribute('src')->getValue());
    $text = $a->text;

    // add data to array
    $api['areanapoli'][] = 
        [
            'href' => $url . $href,
            'image' => $image,
            'text' => $text
        ];   

endforeach;

// extract date
foreach($api['areanapoli'] as $key => $value) :

    $node = $api['areanapoli'][$key];
    $dom->loadFromUrl($node['href']);
    $auth = $dom->find('.art-author')[0]->find('div')[0];
    $date = strip_tags($auth->innerHtml);
    $api['areanapoli'][$key]['date'] = Carbon::createFromFormat('j M Y H:i', $str::translateDate($date, 'short'))->diffForHumans(['parts' => 2]);

endforeach;

echo json_encode($api, true);

/*)

//---------------------------------------------------------------------------
// calcionapoli.it
//---------------------------------------------------------------------------

$dom->loadFromUrl('https://www.calcionapoli24.it');

$cover = $dom->find('.pp')[0];

$a = $cover->find('a')->getTag()->getAttribute('href')->getValue();

$img = $cover->find('img')->getTag()->getAttribute('src')->getValue();

//---------------------------------------------------------------------------
// tuttonapoli.net
//---------------------------------------------------------------------------

$dom->loadFromUrl('https://www.tuttonapoli.net');

$cover = $dom->find('.pp')[0];

$a = $cover->find('a')->getTag()->getAttribute('href')->getValue();

$img = $cover->find('img')->getTag()->getAttribute('src')->getValue();

//---------------------------------------------------------------------------
// spazionapoli.it
//---------------------------------------------------------------------------

$dom->loadFromUrl('https://www.spazionapoli.it');

$cover = $dom->find('.oxy-posts');

$div = $cover[0]->find('.oxy-post-image-fixed-ratio')[0]->getTag()->getAttribute('style')->getValue();

//$img = get_string_between($div,'(',')');

//---------------------------------------------------------------------------
// napolimagazine.com
//---------------------------------------------------------------------------

$dom->loadFromUrl('https://www.napolimagazine.com');

$cover = $dom->find('.layout_Home_Big_box_correlati')[0];

$li = $cover->find('li');

$img = $li[0]->find('img')->getTag()->getAttribute('src')->getValue();

$img = str_replace('86/61', '490/305', $img);



*/

