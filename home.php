<?php
include ('db.php');

$sql = "SELECT * FROM games";
$result = $con->query($sql);

$items = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Shop</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <h1>Web Shop</h1>

    <div class="cart-container">
        <i class="fa fa-shopping-cart cart-icon"></i>
        <span class="cart-badge">0</span>
    </div>

    <div class="search-container">
        <input type="text" id="search-input" placeholder="Search items...">
    </div>

    <div class="items-grid">
        <?php foreach ($items as $item): ?>
            <div class="item">
                <img src="https://picsum.photos/200/300?random=<?= $item['id'] ?>" alt="<?= $item['name'] ?>">
                <h2><?= $item['name'] ?></h2>
                <p>$<?= $item['price'] ?></p>
                <a href="product.php?id=<?= $item['id'] ?>" class="view-product-btn">View Product</a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Cart</h2>
            <ul class="cart-items"></ul>
            <p>Total: <span class="cart-total">$0.00</span></p>
            <button class="buy-btn">Buy</button>
        </div>
    </div>

    <script>
        let items = <?php echo json_encode($items); ?>;
    </script>
    <script src="script.js"></script>
</body>

</html>