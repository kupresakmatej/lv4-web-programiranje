<?php
// Include the database connection file
include ('db.php');

// Array of products
$items = [
    [
        'id' => 1,
        'name' => 'Legend of Zelda',
        'price' => 29.99,
    ],
    [
        'id' => 2,
        'name' => 'Super Mario Bros',
        'price' => 24.99,
    ],
    [
        'id' => 3,
        'name' => 'Call of Duty',
        'price' => 59.99,
    ],
    [
        'id' => 4,
        'name' => 'Minecraft',
        'price' => 19.99,
    ],
    [
        'id' => 5,
        'name' => 'The Witcher 3: Wild Hunt',
        'price' => 39.99,
    ],
    [
        'id' => 6,
        'name' => 'Among Us',
        'price' => 4.99,
    ],
    [
        'id' => 7,
        'name' => 'Rocket League',
        'price' => 19.99,
    ],
    [
        'id' => 8,
        'name' => 'The Elder Scrolls V: Skyrim',
        'price' => 29.99,
    ],
    [
        'id' => 9,
        'name' => 'Fallout 4',
        'price' => 29.99,
    ],
    [
        'id' => 10,
        'name' => 'Gray Zone Warfare',
        'price' => 34.99,
    ],
];

foreach ($items as $item) {
    $id = $item['id'];
    $name = $con->real_escape_string($item['name']);
    $price = $item['price'];

    $sql = "INSERT INTO games (id, name, price) VALUES ('$id', '$name', '$price')";

    if ($con->query($sql) === TRUE) {
        echo "Product $name inserted successfully.<br>";
    } else {
        echo "Error inserting product $name: " . $con->error . "<br>";
    }
}

$con->close();
?>