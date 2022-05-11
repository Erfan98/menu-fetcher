<?php

echo '<h1>Silence is Golden</h1>';

$url='http://9.6.test/api/items';
$result = json_decode(file_get_contents($url));

//Generating a Table
echo '<table border="1">';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Name</th>';
echo '<th>Description</th>';
echo '<th>Price</th>';
echo '</tr>';

for($i=0;$i<count($result);$i++){
    echo '<tr>';
    echo '<td>'.$result[$i]->id.'</td>';
    echo '<td>'.$result[$i]->name.'</td>';
    echo '<td>'.$result[$i]->description.'</td>';
    echo '<td>'.$result[$i]->price.'</td>';
    echo '</tr>';
}