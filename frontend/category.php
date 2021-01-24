<?php
    require_once ('../database/dbhelper.php');
    $id="";
    $id = $_GET['id'];


    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = 'select * from category where id = '.$id;
        $category = executeSingleResult($sql);

        if($category != null) {
            $name = $category['name'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Home</title>
</head>
<body>
    <div class="row">
    <?php
        $sql = "select product.id, product.title, product.price, product.thumbnail, category.name, product.create_at, product.update_at from product, category where product.id_category = category.id and category.id = ".$id;
        $productList = executeResult($sql);
        foreach ($productList as $item) {
            echo '           
                
                    <div class="col-lg-3">
                        <a href="detail.php?id='.$item['id'].'">
                            <img src="'.$item['thumbnail'].'" style="width:150px">
                            <p>'.$item['title'].'</p>

                        </a>
                        
                        <p>'.$item['price'].'</p>
                    </div>
                
            ';
        }

    ?>
    </div>



    <!-- Script  -->
    

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>