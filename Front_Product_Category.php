<?php
require("Classes.php");
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
    <h1>Categories</h1>
    <ul>
        <?php
            $categFrOgj = new Category();
            $categFrOgj->findData();
        ?>

        
    </ul>
<hr/> 
<h1>Products</h1>
    <ul>
        <?php
            $prodFrOgj = new Products();
            $prodFrOgj->findProdData();
        ?>

        
    </ul>
</body>
</html>

<!-- Terminate connection -->
<?php
    $dbObj = new DBConnent();
    $dbObj->closeDB();
?>