<?php
session_start();

// TO REMOVE
include 'src/BasicCart/Cart.php';
include 'src/BasicCart/Product.php';
include 'src/BasicCart/ProductList.php';

$cart = new \BasicCart\Cart();
$productList = new \BasicCart\ProductList();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Tools and Co Pricing Page</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>

    <body>

        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Tools and Co</h5>
            <a class="btn btn-outline-primary" href="/cart.php">View Cart</a>
        </div>

        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Products</h1>
            <p class="lead">Our lifetime warranty products come at the best prices!</p>
        </div>

        <div class="container">
            <div class="card-deck mb-3 text-center">
                <?php foreach($productList->getProducts() as $id => $product) { ?>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h5 class="my-0 font-weight-normal"><?php echo $product->name ?></h5>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title pricing-card-title">$<?php echo $product->price ?><small class="text-muted"></small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Awesome!</li>
                                <li>Its Awesome!</li>
                                <li>So Awesome!</li>
                            </ul>
                            <form method="post" action="/cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $id ?>" />
                                <input type="hidden" name="action" value="add" />
                                <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </body>
</html>

