<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Al Redwan Home - Single Page with Cart</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="top-bar">
        <div class="contact-info">Call Us: +962-7-9999-9999</div>
        <div class="social-icons">
        <a href="https://web.facebook.com/AlRedwanhome/photos/?_rdc=1&_rdr#">FB</a>
        <a href="https://www.instagram.com/alredwan_home/">IG</a>
        </div>
    </div>

    <!-- Header (Logo & Nav) -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Al Redwan Home</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.html">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.html">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                        <li
                            class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- CART SECTION -->
    <section id="cartSection">
        <h2 style="text-align: center">Your Cart</h2>
        <div id="cartItems"></div>
        <div class="cart-total">
            <?php
            $item1 = 0;
            $item2 = 0;
            $item3 = 0;
            $item4 = 0;

            $total = 0;

            session_start();
            if (isset($_SESSION["user"])) {
                $user_id = $_SESSION["user"];
                $pdo = new PDO("mysql:host=192.168.0.100;dbname=alredwan_redwan", 'alredwan_redwan', 'gBqrDe3EYmtPC68sMV5Y');
                $statement = $pdo->query("SELECT * FROM cart WHERE user_id = '$user_id'")->fetchAll();

                foreach ($statement as $item) {
                    if ($item["product_id"] == 1) $item1 = $item["quantity"];
                    if ($item["product_id"] == 2) $item2 = $item["quantity"];
                    if ($item["product_id"] == 3) $item3 = $item["quantity"];
                    if ($item["product_id"] == 4) $item4 = $item["quantity"];
                }
            }

            $total += $item1 * 700;
            $total += $item2 * 500;
            $total += $item3 * 200;
            $total += $item4 * 300;

            echo "<div class='cart-item'>
                    <div>
                    <p><strong>Bedroom(s)</strong></p>
                    <p>Price: $700</p>
                    <p>Quantity: $item1</p>
                    <!-- Buttons for Increment, Decrement, and Remove -->
                    <form method='post' action='add_to_cart.php'>
                        <input type='hidden' name='item' value='1'>
                        <input type='submit' value='Add to Cart'>
                    </form>
                    <form method='post' action='sub_from_cart.php'>
                        <input type='hidden' name='item' value='1'>
                        <input type='submit' value='Subtract from Cart'>
                    </form>
                    </div>
                    <div>$700</div>
                </div>";
            echo "<div class='cart-item'>
                    <div>
                    <p><strong>Sofa(s)</strong></p>
                    <p>Price: $500</p>
                    <p>Quantity: $item2</p>
                    <!-- Buttons for Increment, Decrement, and Remove -->
                    <form method='post' action='add_to_cart.php'>
                        <input type='hidden' name='item' value='2'>
                        <input type='submit' value='Add to Cart'>
                    </form>
                    <form method='post' action='sub_from_cart.php'>
                        <input type='hidden' name='item' value='2'>
                        <input type='submit' value='Subtract from Cart'>
                    </form>
                    </div>
                    <div>$500</div>
                </div>";
            echo "<div class='cart-item'>
                    <div>
                    <p><strong>Carpet(s)</strong></p>
                    <p>Price: $200</p>
                    <p>Quantity: $item3</p>
                    <!-- Buttons for Increment, Decrement, and Remove -->
                    <form method='post' action='add_to_cart.php'>
                        <input type='hidden' name='item' value='3'>
                        <input type='submit' value='Add to Cart'>
                    </form>
                    <form method='post' action='sub_from_cart.php'>
                        <input type='hidden' name='item' value='3'>
                        <input type='submit' value='Subtract from Cart'>
                    </form>
                    </div>
                    <div>$200</div>
                </div>";
            echo "<div class='cart-item'>
                    <div>
                    <p><strong>Table(s)</strong></p>
                    <p>Price: $300</p>
                    <p>Quantity: $item4</p>
                    <!-- Buttons for Increment, Decrement, and Remove -->
                    <form method='post' action='add_to_cart.php'>
                        <input type='hidden' name='item' value='4'>
                        <input type='submit' value='Add to Cart'>
                    </form>
                    <form method='post' action='sub_from_cart.php'>
                        <input type='hidden' name='item' value='4'>
                        <input type='submit' value='Subtract from Cart'>
                    </form>
                    </div>
                    <div>$300</div>
                </div>";
            echo "<br>Total: $<span id='cartTotal'>$total</span>";
            ?>
        </div>
    </section>
    <footer>
        <p>&copy; 2025 Al Redwan home. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>