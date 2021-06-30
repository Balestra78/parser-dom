<?php

require_once __DIR__ . '/vendor/autoload.php';

$uri = 'mongodb+srv://test-user:sue0J5dFqoi5Ma5X@clustertest.hpic2.mongodb.net/myFirstDatabase?retryWrites=true&w=majority';

$client = new MongoDB\Client($uri);

$collection = $client->blog->articles;

$cursor = $collection->find();
	
foreach ($cursor as $document) {
    echo $document["name"] . "\n";
}