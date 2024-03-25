<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đi bay - Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .product {
        border: 1px solid #ccc;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 5px;
    }

    .product img {
        max-width: 100%;
        height: auto;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-3">Danh sách sản phẩm</h1>
        <div class="row">
            <?php
            require_once("entities/product.class.php");
            ?>
            <?php
            $prods = Product::list_product();
            foreach ($prods as $item) {
                echo '<div class="col-md-4">';
                echo '<div class="product">';
                echo '<img src="' . $item["Picture"] . '" alt="' . $item["ProductName"] . '" class="img-fluid">';
                echo '<h2>' . $item["ProductName"] . '</h2>';
                echo '<p>' . $item["Description"] . '</p>';
                echo '<p><strong>Giá: ' . $item["Price"] . '</strong></p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <!-- Bootstrap JS and jQuery (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>