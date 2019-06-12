<?php
session_start();

// TO REMOVE
include 'src/BasicCart/Cart.php';
include 'src/BasicCart/Product.php';
include 'src/BasicCart/ProductList.php';

$cart = new \BasicCart\Cart();
$productList = new \BasicCart\ProductList();


if (isset($_POST['action']) === true) {
    if ($_POST['action'] === 'add') {
        $cart->addItem($_POST['product_id']);
    } elseif ($_POST['action'] === 'remove') {
        $cart->removeItem($_POST['product_id']);
    } elseif ($_POST['action'] === 'clear') {
        $cart->clearCart();
    }
}


?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Cart - Tools and Co Pricing Page</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    </head>

    <body>

        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Tools and Co</h5>
            <a class="btn btn-outline-primary" href="/">View Products</a>
        </div>

        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">My Cart</h1>
        </div>

        <div class="container">
            <div class="center">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill"><?php echo count($cart->getItems()) ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach ($cart->getItems() as $id => $cartItem) { ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">
                                    <?php echo $cartItem->name ?>
                                    <?php if ($cartItem->count > 1) { ?>
                                        <em><strong>x <?php echo $cartItem->count ?></strong></em>
                                    <?php } ?>
                                </h6>
                                <small class="text-muted">Its pretty awesome!</small>
                            </div>
                            <span class="text-muted">
                                $<?php echo $cartItem->price ?>
                                <form method="post" action="/cart.php" style="display: inline">
                                    <input type="hidden" name="action" value="remove" />
                                    <input type="hidden" name="product_id" value="<?php echo $id ?>" />
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash fa-lg"></i>
                                    </button>
                                </form>
                            </span>
                        </li>
                    <?php } ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>$<?php echo $cart->getTotalCost() ?></strong>
                    </li>
                </ul>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <a href="/">
                            <button type="button" class="btn btn-primary">Continue Shopping</button>
                        </a>
                    </div>

                    <form method="post" action="/cart.php">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <input type="hidden" name="action" value="clear" />
                            <button type="submit" class="btn btn-danger">Clear Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

