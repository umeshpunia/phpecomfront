<?php
include_once "includes/head.php";
include_once "includes/header.php";

if(isset($_GET['id'])){
    $cid=$_GET['id'];
}else{
    redirect("index.php");
}

$get_category_sql="select * from categories where cid='$cid'";
$get_category=mysqli_fetch_assoc(mysqli_query($conn,$get_category_sql));

$get_cat_sql = "select * from categories left JOIN products on categories.cid=products.category where categories.cid='$cid'";

$get_cat_query = mysqli_query($conn, $get_cat_sql);
if(mysqli_num_rows($get_cat_query) <= 0){
    redirect("categories.php");
}

?>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row mx-0 justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center position-relative mb-5">
                    <h1 class="d-inline-block position-relative text-secondary text-uppercase pb-2"><?=strtoupper($get_category['cat_title'])?></h1>
                    <p>
                    <?=$get_category['cat_description']?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            while ($get_cat = mysqli_fetch_assoc($get_cat_query)) {
             
            ?>
                <div class="col-lg-4 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="product.php?id=<?=$get_cat['pid']?>">
                        <img class="img-fluid" src="<?=$admin_url."assets/images/products/".$get_cat['pro_pic']?>" alt="">
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3"><?=ucwords($get_cat['pro_title'])?></h4>
                            
                        </div>
                    </a>
                </div>
            <?php
            }

            ?>

        </div>
    </div>
</div>


<?php


include_once "includes/footer.php";
?>