<?php
include_once "includes/head.php";
include_once "includes/header.php";

$check_cart_sql = "select * from cart left join products on cart.pro_id=products.pid where session_id='$ssid'";
$check_cart_query = mysqli_query($conn, $check_cart_sql);
$cart_total = 0;

?>

<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="text-center my-5">My Cart</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($check_cart = mysqli_fetch_assoc($check_cart_query)) {

                    $cart_quantity = $check_cart['quantity'];
                    $pro_price = $check_cart['pro_price'];

                    $cart_total = $cart_total + ($cart_quantity * $pro_price);
                ?>
                    <tr>
                        <th><?= $i++; ?></th>
                        <td>
                            <?= ucwords($check_cart['pro_title']) ?>
                        </td>
                        <td><?= $cart_quantity ?></td>
                        <td>&#8377;<?= ucwords($check_cart['pro_price']) ?></td>
                        <td>&#8377;<?= $pro_price * $cart_quantity ?></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Cart Total</td>
                    <th>
                        &#8377;<?= $cart_total ?>
                    </th>
                </tr>
            </tfoot>
        </table>
        <?php
        if ($is_login) {
        ?>
            <form id="checkForm" method="post">
                <input type="submit" id="checkout" class="btn btn-info" value="Check Out">
            </form>
        <?php
        } else {
        ?>
            <a href="" class="btn btn-danger">Login</a>
        <?php
        }
        ?>
    </div>
</div>


<?php


include_once "includes/footer.php";

?>


<script>
    $(document).ready(function() {
        $("#checkForm").submit(function(e) {
            e.preventDefault();

            const options = {
                key: '',
                amount: "<?=$cart_total?>"*100, // amount should be in paise format i am using here 10 Rupees
                currency: 'INR',
                name: 'My Ecom', // company name or product name
                description: 'hello', // product description
                image: '', // company logo or product image
                modal: {
                    // We should prevent closing of the form when esc key is pressed.
                    escape: false,
                },
                notes: {
                    // include notes if any
                },
                theme: {
                    color: '#0c238a'
                }
            };
            options.handler = ((response, error) => {
                options.response = response;
                if (response) {
                    location.href="checkout.php";
                }
                console.log(response); // do whatever you want to do after response
                console.log(options);
                console.log(error)
                // call your backend api to verify payment signature & capture transaction
            });
            options.modal.ondismiss = (() => {
                // handle the case when user closes the form while transaction is in progress
                console.log('Transaction cancelled.');
            });
            const rzp = new Razorpay(options);
            rzp.open();





        })
    })
</script>