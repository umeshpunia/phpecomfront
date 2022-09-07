<?php
// rzp_test_BHuueAoUi9GpMq
include_once "includes/head.php";
include_once "includes/header.php";

$check_cart_sql="select * from cart left join products on cart.pro_id=products.pid where session_id='$ssid'";


$check_cart_query=mysqli_query($conn,$check_cart_sql);


while($checkout_pro=mysqli_fetch_assoc($check_cart_query)){
    $pro_price=$checkout_pro['pro_price'];
    $pro_quantity=$checkout_pro['quantity'];
    $pro_id=$checkout_pro['pro_id'];
    $order_by="punia.umesh@gmail.com";
    $cart_id=$checkout_pro['cart_id'];

    $checkout_ins_sql="INSERT INTO `orders` (`oid`, `pid`, `price`, `o_quantity`, `order_by`, `order_status`, `order_on`) VALUES (NULL, '$pro_id', '$pro_price', '$pro_quantity', '$order_by', 'placed', current_timestamp())";

    if(mysqli_query($conn,$checkout_ins_sql)){
        // empty cart
        mysqli_query($conn,"delete from cart where cart_id='$cart_id'");
    }else{
        alert("Please Checkout Again");
        die();
    }
}

redirect("thanks.php");
?>