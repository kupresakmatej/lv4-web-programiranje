<?php
include ('db.php');

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM games WHERE id = $product_id";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found.";
    exit;
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['name'] ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h1><?= $product['name'] ?></h1>

    <div class="product-details">
        <img src="https://picsum.photos/200/300?random=<?= $product['id'] ?>" alt="<?= $product['name'] ?>">
        <p>Price: $<?= $product['price'] ?></p>
        <p>Description: <?= $product['description'] ?></p>
        <input type="number" id="quantity" name="quantity" value="1" min="1">
        <button onclick="addToCart(<?= $product['id'] ?>)">Add to Cart</button>
    </div>

    <script>
        function addToCart(productId) {
            const quantity = document.getElementById('quantity').value;
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const existingItem = cart.find(item => item.id === productId);
            if (existingItem) {
                existingItem.quantity += parseInt(quantity);
            } else {
                cart.push({ id: productId, quantity: parseInt(quantity) });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Product added to cart');
        }
    </script>
</body>

</html>