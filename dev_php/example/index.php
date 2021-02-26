<?php

require 'Person.php';

$client = new Person('Italo', 'Morales');
echo $client->greet();

$seller = new Person('Luisa', 'Fantone');
echo $seller->greet();
