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
            <a class="nav-link active" href="#">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../product/">Quản lý sản phẩm</a>
        </li>
    </ul>


    <a href="add.php">
        <button class="btn btn-primary" style="margin-bottom: 20px;">Add</button>
    </a>
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th width="50px"></th>
                <th width="50px"></th>
            </tr>
        </thead>
        <tbody>


        <?php
            //lay danh sach tu database
            $limit = 10;
            $page = 1;

            
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            }

            if($page <= 0) {
                $page = 1;
            }
            $firstIndex = ($page - 1) * $limit;
            $sql = "select * from category where 1 limit ".$firstIndex.",".$limit;
            $categoryList = executeResult($sql);
            $sql = "select count(id) as total from category";
            $countResult = executeSingleResult($sql);
            $count = $countResult['total'];

            

           //page number
            $number = ceil($count/$limit);
            $index = 1;
            foreach ($categoryList as $key => $item){
                echo '
                    <tr>
                        <td>'.($firstIndex++).'</td>
                        <td>'.$item['name'].'</td>
                        <td>
                            <a href="add.php?id='.$item['id'].'">
                                <button class="btn btn-warning">Edit</button>
                            <a/>
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteCategory('.$item['id'].')">Delete</button>
                        </td>
                    </tr>
                    
                ';
            }
        ?>
            
        </tbody>
    </table>
    <nav aria-label="Page navigation example">

    <?php
        if($number > 1){

        
    ?>
        <ul class="pagination justify-content-center">
            <?php
                if($page > 1){
                    echo '
                        <li class="page-item ">
                            <a class="page-link" href="?page='.($page-1 ).'" tabindex="-1">Previous</a>
                        </li>
                    ';
                }
                else {
                    echo '
                        <li class="page-item disabled">
                            <a class="page-link" href="?page='.($page-1 ).'" tabindex="-1">Previous</a>
                        </li>
                    ';
                }
            ?>

            
            <?php
                $avaiable = [1, $page-1, $page, $page+1, $number];
                $isFirst = $isLast = false;
                for($i = 0; $i < $number; $i++){
                    if(!in_array($i+1, $avaiable)){
                        if(!$isFirst && $page > 3){
                            echo '
                            <li class="page-item "><a class="page-link" href="?page='.($page-2).'">...</a></li>
                            ';
                            $isFirst = true;
                        }
                        if(!$isLast && $i > $page){
                            echo '
                            <li class="page-item "><a class="page-link" href="?page='.($page+  2).'">...</a></li>
                            ';
                            $isLast = true;
                        }
                        continue;
                    }
                    if($page == ($i+1)) {
                        echo '
                        <li class="page-item active"><a class="page-link" href="?page='.($i+1).'">'.($i+1).'</a></li>
                        ';
                    }else {
                        echo '
                        <li class="page-item"><a class="page-link" href="?page='.($i+1).'">'.($i+1).'</a></li>
                        ';
                    }
                    
                }
            ?>
            <?php
                if($page == $number){
                    echo '
                        <li class="page-item disabled">
                            <a class="page-link" href="?page='.($page-1 ).'" tabindex="-1">Previous</a>
                        </li>
                    ';
                }
                else {
                    echo '
                        <li class="page-item ">
                            <a class="page-link" href="?page='.($page+1 ).'" tabindex="-1">Previous</a>
                        </li>
                    ';
                }
            ?>
        </ul>
        <?php
            }
        ?>
    </nav>


    <!-- Script  -->
    <script>
        function deleteCategory(id){
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