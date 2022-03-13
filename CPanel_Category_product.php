<?php
    require('Classes.php');

    echo "<h1> Category </h1>";
    if(isset($_POST['insert'])){

        $categObj = new Category();
        $categObj->insertData($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="" method="POST">
    <pre>
        <label>Category ID       </label><input type="text" name="category_id">
        <label>Category Name     </label><input type="text" name="category_name">
        <label>Discription       </label><textarea name="description" cols="30" rows="10" placeholder="Describe"></textarea>  
            <br/>
                        <input type="submit" value="Insert" name="insert">   
    </pre>
    </form>

    <hr/>  
    <form action="" method="POST">
    <pre>
        <label>Enter Data: </label><input type="text" name="search"> <input type="submit" name="send" value="Search">   
    </pre>
    </form>
    <ul>
    <?php
    if(isset($_POST['send'])){

        $search=$_POST['search'];
        if (isset($search)){
            $categObj = new Category();
            $categObj->displayData($search);
        }
    }      
    ?>
        </ul>
        <br><br>
        <?php
        
        if(isset($_GET['del_id']))
        {
            $del_id = $_GET['del_id'];
            $categObj = new Category();
            $categObj->deleteData($del_id);
        }

        if(isset($_GET['edit_id']))
        {
            echo '
            <form action="" method="POST">
            <pre>
            <label>Category ID       </label><input type="text" value="'.  $_GET['edit_id']  .'" name="cat_id">
            <label>Category Name     </label><input type="text" value="'.  $_GET['edit_name']  .'"  name="cat_name">
            <label>Discription       </label><textarea cols="30" rows="10" placeholder="Describe"   name="cat_desc" >'.  $_GET['edit_desc']  .'</textarea>
                <br/>
                            <input type="submit" value="Update" name="update">   
            </pre> 
            </form>'       ;
            if(isset($_POST['update']))
            {
                $id=$_POST['cat_id'];
                $name=$_POST['cat_name'];
                $description=$_POST['cat_desc'];

                $categObj = new Category();
                $categObj->updateData($id, $name, $description);
            }
        }        
        ?>

        <hr/>
        <h1> Product </h1>

        <?php

            if(isset($_POST['inser'])){
                $prodObj = new Products();
                $prodObj->insertProdData($_POST);
            }
            ?>

    <form action="" method="POST">
    <pre>
        <label>Product ID       </label><input type="text" name="product_id">
        <label>Product Name     </label><input type="text" name="product_name">
        <label>Category ID      </label><input type="text" name="prod_cat_id">
        <label>Discription      </label><textarea cols="30" rows="10" placeholder="Describe"  name="descrip" ></textarea>
                <br/>
                    <input type="submit" value="Insert" name="inser">   
    </pre>
    </form>

<hr/>  
    <form action="" method="POST">
    <pre>
        <label>Enter Data: </label><input type="text" name="searh"> <input type="submit" name="sub" value="Search">   
    </pre>
    </form>
<ul>
<?php
if(isset($_POST['sub'])){

    $search=$_POST['searh'];
    if (isset($search)){
        $prodObj = new Products();
        $prodObj->displayProdData($search);
    }
}   
?>
</ul>
<br><br>
        <?php
        if(isset($_GET['del_id2']))
        {
            $del_id2 = $_GET['del_id2'];
            $prodObj = new Products();
            $prodObj->deleteProdData($del_id2);
        }

        if(isset($_GET['edit_id2']))
        {
            echo '
            <form action="" method="POST">
            <pre>
            <label>Prouct ID        </label><input type="text" value="'.  $_GET['edit_id2']  .'" name="prod_id">
            <label>product Name     </label><input type="text" value="'.  $_GET['edit_name2']  .'"  name="prod_name">
            <label>Category ID      </label><input type="text" value="'.  $_GET['edit_prod_cat']  .'"  name="prod_cat_id">
            <label>Discription      </label><textarea cols="30" rows="10" placeholder="Describe"   name="prod_desc" >'. $_GET['edit_desc2'] . '</textarea>
                <br/>
                            <input type="submit" value="Update" name="update2">   
            </pre> 
            </form>'       ;

            if(isset($_POST['update2']))
            {
                $id=$_POST['prod_id'];
                $name=$_POST['prod_name'];
                $prod_cat = $_POST['prod_cat_id'];
                $descrip=$_POST['prod_desc'];
            
                $prodObj = new Products();
                $prodObj->updateProdData($id, $name, $prod_cat, $descrip);
            }
        }
        ?>

        <hr/>
</body>
</html>

<!-- Terminate connection -->
<?php
    $dbObj = new DBConnent();
    $dbObj->closeDB();
?>