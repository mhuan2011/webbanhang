<?php
    require_once ('../../database/dbhelper.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>


    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="../category/">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Quản lý sản phẩm</a>
        </li>
    </ul>


    <a href="add.php">
        <button class="btn btn-primary" style="margin-bottom: 20px;">Add</button>
    </a>
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá bán</th>
                <th>Danh mục</th>
                <th>Ngày thêm</th>
                <th>Ngày cập nhật</th>
                <th width="50px"></th>
                <th width="50px"></th>
            </tr>
        </thead>
        <tbody>


        <?php
            //lay danh sach tu database
            $sql = "select product.id, product.title, product.price, product.thumbnail, category.name, product.create_at, product.update_at from product, category where product.id_category = category.id";
            $productList = executeResult($sql);
            $index = 1;
            
            foreach ($productList as $key => $item){
                echo '
                    <tr>
                        <td>'.($index++).'</td>
                        <td><img src="'.$item['thumbnail'].'" width="80px"/></td>
                        <td>'.$item['title'].'</td>
                        <td>'.$item['price'].'</td>
                        <td>'.$item['name'].'</td>
                        <td>'.$item['create_at'].'</td>
                        <td>'.$item['update_at'].'</td>
                        <td>
                            <a href="add.php?id='.$item['id'].'">
                                <button class="btn btn-warning">Edit</button>
                            <a/>
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteProduct('.$item['id'].')">Delete</button>
                        </td>
                        
                    </tr>
                
                ';
            }
        ?>
            
        </tbody>
    </table>



    <!-- Script  -->
    <script>
        function deleteProduct(id){
            //ajax - use spot method
            var option = confirm('Are your want delete this ?')

            
            if(!option ) {
                return;
            }
            $.post('ajax.php', {
                'id': id,
                'action': 'delete'

            }, function(data) {
                location.reload()
            })
        }
    </script>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>