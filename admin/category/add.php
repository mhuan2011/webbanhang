<?php
    require_once ('../../database/dbhelper.php');
    
    $id = $name = '';
    if(!empty($_POST)){
        $name = '';
        if(isset($_POST['name'])){
            $name = $_POST['name'];
            $name = str_replace('""', '\\"', $name);
        }

        if(isset($_POST['id'])){
            $id = $_POST['id'];
        }

        if(!empty($name)){
            //save data base
            

            $created_at = $update_at = date('Y-m-d H:s:i');
            if($id == ''){
                $sql = 'insert into category(name, create_at, update_at) values ("'.$name.'", "'.$created_at.'","'.$update_at.'")';  

            } else {
                $sql = 'update category set name="'.$name.'", update_at = "'.$update_at.'" where id = '.$id;
            }   
            execute($sql);
    
            header('Location: index.php');
            die();
        }
    }

    

    
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
    <title>Add/ Edit/ Delete</title>
</head>
<body>


    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="index.php">Quản lý danh mục</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="../product/">Quản lý sản phẩm</a>
        </li>


    </ul>

    <div class="container">
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="dm">Tên danh mục</label>
                    <input type="text" name="id" value="<?=$id?>" hidden="true">
                    <input require="true" type="text" class="form-control" id="dm" name="name" value="<?=$name?>">
                    <button class="btn tbn-success" type ="submit">Save</button>
                </div>
            </form>
        </div>

    </div>
    



    <!-- Script  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>