<?php
    require_once ('../../database/dbhelper.php');
    
     $title = $price = $thumbnail = $content = $id_category = '';
     $id = "";
    if(!empty($_POST)){
        $title = '';
        if(isset($_POST['title'])){
            $title = $_POST['title'];
            $title = str_replace('""', '\\"', $title);
        }

        if(isset($_POST['price'])){
            $price = $_POST['price'];
        }

        if(isset($_POST['id'])){
            $id = $_POST['id'];
        }

        if(isset($_POST['thumbnail'])){
            $thumbnail = $_POST['thumbnail'];
            $thumbnail = str_replace('""', '\\"', $thumbnail);

        }

        if(isset($_POST['content'])){
            $content = $_POST['content'];
            $content = str_replace('""', '\\"', $content);

        }

        if(isset($_POST['id_category'])){
            $id_category = $_POST['id_category'];
        }
        echo $id;
        if(!empty($title)){
            //save data base
            
            $create_at = $update_at = date('Y-m-d H:s:i');
            if($id == ''){

                $sql = 'insert into product (title, price, thumbnail, content, id_category, create_at, update_at) values ("'.$title.'","'.$price.'","'.$thumbnail.'","'.$content.'","'.$id_category.'", "'.$create_at.'","'.$update_at.'")';  
                
            } else {
                $sql = 'update product set title="'.$title.'",price="'.$price.'",thumbnail="'.$thumbnail.'",content="'.$content.'", id_category="'.$id_category.'",update_at = "'.$update_at.'" where id = '.$id;

            }   
            execute($sql);
    
            header('Location: index.php');
            die();
        }
    }

    

    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = 'select * from product where id = '.$id;
        $product = executeSingleResult($sql);

        if($product != null) {
            $title = $product['title'];
            $price = $product['price'];
            $thumbnail = $product['thumbnail'];
            $content = $product['content'];
            $id_category = $product['id_category'];

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    
    

    <!-- css- -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- bootstrap4 -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


    <title>Add/ Edit/ Delete</title>
</head>
<body>


    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="../category/">Quản lý danh mục</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="index.php">Quản lý sản phẩm</a>
        </li>


    </ul>

    <div class="container">
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Tên sản phẩm: </label>
                    <input type="text" name="id" value="<?=$id?>" hidden="true">
                    <input require="true" type="text" class="form-control" id="title" name="title" value="<?=$title?>">
                </div>
                <div class="form-group">
                    <label for="id_category">Chọn danh mục: </label>
                    <select name="id_category" class="form-control" id="id_category">
                        <option>-- Lựa chọn danh mục--</option>
                        <!-- lay danh muc san pham -->
                        <?php
                            $sql = "select * from category";
                            $categoryList = executeResult($sql);
                            foreach ($categoryList as $key => $item){
                                if($item['id'] == $id_category) {
                                    echo '
                                        <option selected value="'.$item['id'].'">'.$item['name'].'</option>

                                    ';
                                }
                                else {
                                    echo '
                                        <option value="'.$item['id'].'">'.$item['name'].'</option>

                                    ';
                                }


                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Giá bán: </label>
                    <input require="true" type="number" class="form-control" id="price" name="price" value="<?=$price?>">
                </div>
                <div class="form-group">
                    <label for="thumbnail">Hình ảnh:  </label>
                    <input require="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=$thumbnail?>" onchange="updateThumbnail();">
                    <img id="img_thumbnail"src="<?=$thumbnail?>" style="max-width: 200px; padding-top: 20px;" alt="">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung  </label>
                    <textarea name="content" id="content" class="form-control" rows="5" ><?=$content?></textarea>
                </div>
                <button class="btn tbn-success" type ="submit">Save</button>
            </form>
        </div>

    </div>
    



    <!-- Script  -->
    <script>
        function updateThumbnail(){
            $('#img_thumbnail').attr('src', $('#thumbnail').val())

            
        }
        $(document).ready(function() {
                $('#content').summernote({

                    placeholder: 'Hello Bootstrap 4',
                    tabsize: 2,
                    height: 350
                });
        });
    </script>
    
</body>
</html>