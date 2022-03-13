<?php

class DBConnent {
    private $host ="127.0.0.1";
    private $user = "root";
    private $password = "";
    private $database = "simple_dashboard";
    protected $con;

    function __construct(){
        $this->con = $this->connectDB();
    }

    function __destruct(){}

    function connectDB(){
        // To let MySQL tell you what the actual problem
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // echo "Connected successfully";

        return $con;
    }


    function closeDB(){
        $this->con->close();
    }
}

class Category extends DBConnent {

    protected $category_id;
    private $category_name;
    private $description;

    public function __construct(){
        parent::__construct();
	}

    public function insertData($post){
        $category_id = $this->con->real_escape_string($_POST['category_id']);
        $category_name = $this->con->real_escape_string($_POST['category_name']);
        $description = $this->con->real_escape_string($_POST['description']);
        
        $query = "insert into category(category_id,category_name,description) values (".$category_id.",'".$category_name."','".$description."') ";
        $sql = $this->con->query($query);
        if ($sql==true) {
            header("Location:Front_Product_Category.php?msg1=insert");
        }else{
            echo "Insertion failed try again!";
        }
    }

    public function displayData($search){
        $query = "select * From category where  category_id like '%".$search."%' or category_name like '%".$search."%' or description like '%".$search."%' ";
        $result = $this->con->query($query) or trigger_error($this->con->error);

        if(!$result){
            die("Error in Query");
        }
                
        while($row=$result->fetch_assoc()){
            echo "<li>Id: ".$row["category_id"]." || Name:  ".$row["category_name"]."  <a href='CPanel_Category_product.php?del_id=".$row["category_id"]." '>  Delete</a></li>"." <a href='CPanel_Category_product.php?edit_id=".$row["category_id"]." & edit_name=".$row["category_name"]." & edit_desc=".$row["description"]." '>  Edit</a></li>";
        }
    }

    public function findData(){
        $query = "select * From category";
        $result = $this->con->query($query) or trigger_error($this->con->error);

        if(!$result){
            die("Error in Query");
        }
                
        while($row=$result->fetch_assoc()){
            echo "<li>Id: ".$row["category_id"]." || Name:  ".$row["category_name"]." || ".$row["description"]."";
        }
    }

    public function deleteData($del_id){
        $query = "delete from category where category_id= ".$del_id." ";
        $result = $this->con->query($query);
        
        if(!$result){ 
            echo "Something went error";
        }
    }

    public function updateData($id, $name, $description){
        $query = "update category set category_id=".$id." , category_name ='".$name."'  , description ='".$description."' where category_id= ".$_GET['edit_id']." ";
        $result = $this->con->query($query);
    
        if(!$result){ 
            echo "Something went error";
        }
    }
}

class Products extends Category{

    protected $product_id;
    private $product_name;
    private $descrip;

    public function __construct(){
        parent::__construct();
	}

    public function insertProdData($post){
        $product_id = $this->con->real_escape_string($_POST['product_id']);
        $product_name = $this->con->real_escape_string($_POST['product_name']);
        $prod_Cat = $this->con->real_escape_string($_POST['prod_cat_id']);
        $descrip = $this->con->real_escape_string($_POST['descrip']);
        
        $query = "insert into product(product_id,product_name,category_id,description) values (".$product_id.",'".$product_name."',".$prod_Cat.",'".$descrip."') ";
        $sql = $this->con->query($query);
        if ($sql==true) {
            header("Location:Front_Product_Category.php?msg1=insert");
        }else{
            echo "Insertion failed try again!";
        }
    }

    public function displayProdData($searh){
        $query = "select * From product where  product_id like '%".$searh."%' or product_name like '%".$searh."%' or description like '%".$searh."%' ";
        $result = $this->con->query($query) or trigger_error($this->con->error);
        
        if(!$result){
            die("Error in Query");
        }
                
        while($row=$result->fetch_assoc()){
            echo "<li>Id: ".$row["product_id"]." || Name:  ".$row["product_name"]." <a href='CPanel_Category_product.php?del_id2=".$row["product_id"]." '>  Delete</a></li>"." <a href='CPanel_Category_product.php?edit_id2=".$row["product_id"]." & edit_name2=".$row["product_name"]." & edit_prod_cat=".$row["category_id"]."&edit_desc2=".$row["description"]." '>  Edit</a></li>";
        }
    }

    public function findProdData(){
        $query = "select * From product";
        $result = $this->con->query($query) or trigger_error($this->con->error);

        if(!$result){
            die("Error in Query");
        }
                
        while($row=$result->fetch_assoc()){
            echo "<li>Product Id: ".$row["product_id"]." || Product Name:  ".$row["product_name"]." || Category Id:  ".$row["category_id"]." || Description:  ".$row["description"]."</li>";
        }
    }

    public function deleteProdData($del_id2){
        $query = "delete from product where product_id= ".$del_id2." ";
        $result = $this->con->query($query);
        
        if(!$result){
            echo "Something went error";
        }       
    }

    public function updateProdData($id, $name, $prod_cat, $descrip){
        $query = "update product set product_id=".$id." , product_name ='".$name."',category_id =".$prod_cat."  , description ='".$descrip."' where product_id= ".$_GET['edit_id2']." ";
        $result = $this->con->query($query);
    
        if(!$result){
            echo "Something went error";
        }
    }
}