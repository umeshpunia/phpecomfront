<?php

$msg="";
$admin_url="http://localhost/10am/project/admin/";

function print_array($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";

}



function alert($mssg){
?>
    <script>
        alert("<?=$mssg?>");
    </script>
<?php
}
function redirect($url){
?>
    <script>
        location.href="<?=$url?>";
    </script>
<?php
}


function redirect_some_time($url){
?>
    <script>
        setTimeout(function(){
            location.href="<?=$url?>";
        },2000)
    </script>
<?php
}


?>