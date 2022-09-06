<?php
include_once "includes/head.php";
include_once "includes/header.php";

if (isset($_GET['id'])) {
    $pid = $_GET['id'];
} else {
    redirect("index.php");
}


$get_pro_sql = "select * from categories left JOIN products on categories.cid=products.category where products.pid='$pid'";

$get_pro_query = mysqli_query($conn, $get_pro_sql);
if (mysqli_num_rows($get_pro_query) <= 0) {
    redirect("categories.php");
}

$get_product = mysqli_fetch_assoc($get_pro_query);


// add to cart
if(isset($_POST['addtocart']))
{
    $quantity=$_POST['quantity'];

    $check_cart_sql="select * from cart where pro_id='$pid' and session_id='$ssid'";


    $check_cart_query=mysqli_query($conn,$check_cart_sql);

    if(mysqli_num_rows($check_cart_query) > 0){
        // product already exist

        // fetch cart from database
        $check_cart=mysqli_fetch_assoc($check_cart_query);
        // db quantity
        $cart_quantity=$check_cart['quantity'];
        $cart_id=$check_cart['cart_id'];

        if(($quantity+$cart_quantity)>10){
            $quantity=10;
        }

        $upd_cart_sql="update cart set quantity='$quantity' where cart_id='$cart_id'";

        if(mysqli_query($conn,$upd_cart_sql)){
            alert(("Cart Updated"));
        }else{
            alert(("Cart Not Updated"));

        }

    }else{
        // product not exists
        $ins_cart_sql="INSERT INTO `cart` (`cart_id`, `pro_id`, `quantity`, `session_id`) VALUES (NULL, '$pid', '$quantity', '$ssid')";
        if(mysqli_query($conn,$ins_cart_sql)){
            alert("Product Added To Cart");
        }else{
            alert("Please Try Again");
        }
    }







}
?>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-5">
                    <div class="section-title position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2"><?= strtoupper($get_product['cat_title']) ?></h6>
                        <h1 class="display-4"><?= ucwords($get_product['pro_title']) ?></h1>
                    </div>
                    <img class="img-fluid rounded w-100 mb-4" src="<?= $admin_url . "assets/images/products/" . $get_product['pro_pic'] ?>" alt="Image">
                    <p>
                        <?= ucfirst($get_product['pro_description']) ?>
                    </p>
                </div>


            </div>

            <div class="col-lg-6" style="margin-top: 250px;">
                <div class="bg-primary mb-5 py-3">
                    <h3 class="text-white py-3 px-4 m-0">Product Features</h3>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Added By</h6>
                        <h6 class="text-white my-3"><?= ($get_product['add_by']) ?></h6>
                    </div>
                    <h5 class="text-white py-3 px-4 m-0">Course Price: &#8377;<?= ($get_product['pro_price']) ?></h5>
                    <div class="py-3 px-4">
                        <form method="post">
                            <div class="form-group">
                                <input type="number" min="1" max="10" value="1" name="quantity" class="form-control border-top-0 border-right-0 border-left-0 p-0" placeholder="Subject" required="required">
                            </div>
                            <button type="submit" name="addtocart" class="btn btn-block btn-secondary py-3 px-5" href="">Add To Cart </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php


include_once "includes/footer.php";
?>