<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<?php


session_start();

if (isset($_POST['addcart'])) {
    $cart = [ 
        'id'=> $_GET['product_id'], 
        'name'=>$_POST['name'], 
        'image'=>$_POST['image'], 
        'description'=>$_POST['description'], 
        'price'=>$_POST['price'], 
        'quantity'=>$_POST['quantity']
    ];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $cart;
}

?>

<section id="page-header" class="about-header"> 
        <h2>#Cart</h2>
        <p>Let's see what you have.</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Quantity</td>
                    <td>price</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                    <td>Edit</td>
                </tr>
            </thead>

            <tbody>
                <?php
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $product) {
                    $subtotal = (int) $product['quantity'] * (int) $product['price'] ;               
                    }
                ?>
                <tr>
                    <td><img src="admin/upload/<?php echo $product['image']; ?>" alt="product1"></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['description'];?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $subtotal ; ?></td>
                    <?php 
                    }else {
                        echo '<h3> no items </h3>';
                    }?>
                    
                    <td></td>
                    
                    <!-- Remove any cart item  -->
                    <td><button type="submit"  class="btn btn-danger">Remove</button></td>
                    

                </tr>
            </tbody>

            <!-- confirm order  -->
            <td><button type="submit" name="" class="btn btn-success">Confirm</button></td>
            
        </table>
    </section>

    <!-- <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" placeholder="Enter coupon code">
            <button class="normal">Apply</button>
        </div>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$118.25</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$118.25</strong></td>
                </tr>
            </table>
            <button class="normal">proceed to checkout</button>
        </div>
    </section> -->

    <?php include "footer.php" ?>

