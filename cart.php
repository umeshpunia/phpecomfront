<?php
include_once "includes/head.php";
include_once "includes/header.php";

$check_cart_sql="select * from cart left join products on cart.pro_id=products.pid where session_id='$ssid'";
$check_cart_query=mysqli_query($conn,$check_cart_sql);
$cart_total=0;

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
                $i=1;
                    while($check_cart=mysqli_fetch_assoc($check_cart_query)){

                        $cart_quantity=$check_cart['quantity'];
                        $pro_price=$check_cart['pro_price'];

                        $cart_total=$cart_total+($cart_quantity*$pro_price);
                ?>
                <tr>
                    <th><?=$i++;?></th>
                    <td>
                        <?=ucwords($check_cart['pro_title'])?>
                    </td>
                    <td><?=$cart_quantity?></td>
                    <td>&#8377;<?=ucwords($check_cart['pro_price'])?></td>
                    <td>&#8377;<?=$pro_price*$cart_quantity?></td>
                </tr>

                <?php
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Cart Total</td>
                    <th>
                        &#8377;<?=$cart_total?>
                    </th>
                </tr>
            </tfoot>
        </table>
        <?php
            if($is_login){
        ?>
                <form method="post">
            <input type="submit" name="checkout" class="btn btn-info" value="Check Out">
        </form>
        <?php
            }else{
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