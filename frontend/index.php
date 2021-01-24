<?php
    require_once ('../database/dbhelper.php');
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
            $sql = "select * from category";
            $categoryList = executeResult($sql);
            $index = 1;
            foreach ($categoryList as $key => $item){
                echo '
                    <tr>
                        <td>'.($index++).'</td>
                        <td><a href="category.php?id='.$item['id'].'">'.$item['name'].'</td>
                        
                    </tr>
                
                ';
            }
        ?>
            
        </tbody>
    </table>



    <!-- Script  -->
    

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>