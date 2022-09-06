<?php
include_once "includes/head.php";
include_once "includes/header.php";
$get_cat_sql = "select * from categories";

$get_cat_query = mysqli_query($conn, $get_cat_sql);

?>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row mx-0 justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Our Categories</h6>
                    <h1 class="display-4">Checkout New Releases Of Our Categories</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            while ($get_cat = mysqli_fetch_assoc($get_cat_query)) {
                
            ?>
                <div class="col-lg-4 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="category.php?id=<?=$get_cat['cid']?>">
                        <img class="img-fluid" src="<?=$admin_url."assets/images/categories/".$get_cat['cat_pic']?>" alt="">
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3"><?=ucwords($get_cat['cat_title'])?></h4>
                            
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