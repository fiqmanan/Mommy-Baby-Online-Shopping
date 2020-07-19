<?php session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'api/db.php';
$app = new \Slim\App;

$app->get('/api2/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello there from restful api");
    return $response;
});

$app->get('/', function (Request $request, Response $response, array $args) {
    $file = 'Shopping/index.php';
    if (file_exists($file)) {
        return $response->write(file_get_contents($file));
    } else {
        throw new \Slim\Exception\NotFoundException($request, $response);
    }
});


//===================================Login===================================================
$app->post('/api2/login', function (Request $request, Response $response, array $args) {

    $email= $_POST["email"];
    $password= md5($_POST["password"]);
    
    $sql= "SELECT * FROM users WHERE email='$email' AND password='$password'";
    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($count>0){
            $data = array(
            "status" => "passed",
            "user" => $user
        );
        
        $_SESSION['login']=$_POST['email'];
		$_SESSION['id']= $user['id'];
        $_SESSION['username']=$user['username'];

        echo json_encode($data);
        }
        else{
            $data = array(
                "status" => "Wrong Login"
            );
            echo json_encode($data);
        }
        
        
    }catch(PDOException $e){
        $data = array(
            "status" => "error"
        );
        echo json_encode($data);
    }
});

//===================================Register=================================================
$app->post('/api2/register', function (Request $request, Response $response, array $args) {
    
    $name=$_POST['fullname'];
    $contactno=$_POST['contactno'];
    $email= $_POST["emailid"];
    $password= md5($_POST["password"]);
    
    $sql = "INSERT INTO users (name,email,contactno,password) VALUES (:name,:email,:contactno,:password)";
    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':contactno', $contactno);
        $stmt->bindValue(':password', $password);

        $user = $stmt->execute();
        $count = $stmt->rowCount();

        if($count>0){
            $data = array(
            "status" => "passed"
        );
        echo json_encode($data);
        }
        else{
            $data = array(
                "status" => "Wrong Login"
            );
            echo json_encode($data);
        }
    }catch(PDOException $e){
        $data = array(
            "status" => "error"
        );
        echo json_encode($data);
    }
});
//===================================UpdateProfile============================================
$app->get('/api2/getSingleProfile/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    
    $sql="SELECT * FROM users WHERE id =$id";

    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();
        $stmt = $db->query($sql);
        
        $user =$stmt->fetch(PDO::FETCH_OBJ);

        $db = null;
        echo json_encode($user);
        
    }catch(PDOException $e){
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

$app->put('/api2/UpdateProfile/{id}', function (Request $request, Response $response, array $args) {
    
    $name = $request->getParam('name');
    $id = $request->getAttribute("id");
    $contactno = $request->getParam('contactno');
    
    $sql = "UPDATE users SET name= :name,contactno= :contactno WHERE id=$id";
    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':contactno', $contactno);
        $user = $stmt->execute();
        $count = $stmt->rowCount();

        $data = array(
        "status" => "passed"
        );
        echo json_encode($data);

    }catch(PDOException $e){
        $data = array(
            "status" => $e
        );
        echo json_encode($data);
    }
});

//===================================UpdatePassword===========================================
$app->put('/api2/UpdatePassword/{id}', function (Request $request, Response $response, array $args) {
    
    $id = $args['id'];
    $password = md5($request->getParam('cnfpass'));
    
    $sql = "UPDATE users SET password= :password WHERE id=$id";
    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':password', $password);
        $user = $stmt->execute();
        $count = $stmt->rowCount();

        $data = array(
        "status" => "passed"
        );
        echo json_encode($data);

    }catch(PDOException $e){
        $data = array(
            "status" => $e
        );
        echo json_encode($data);
    }
});

//===================================BillingAddresss==========================================
$app->get('/api2/getBillingAddress/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    
    $sql="SELECT * FROM users WHERE id =$id";

    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();
        $stmt = $db->query($sql);
        
        $user =$stmt->fetch(PDO::FETCH_OBJ);

        $db = null;
        echo json_encode($user);
        
    }catch(PDOException $e){
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

$app->put('/api2/UpdateBillingAddress/{id}', function (Request $request, Response $response, array $args) {
    
    $billingaddress = $request->getParam('billingaddress');
    $id = $request->getAttribute("id");
    $billingstate = $request->getParam('billingstate');
    $billingcity = $request->getParam('billingcity');
    $billingpincode = $request->getParam('billingpincode');
    
    $sql = "UPDATE users SET billingAddress= :billingaddress,billingState=:billingstate,billingCity=:billingcity,billingPincode=:billingpincode WHERE id=$id";
    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':billingaddress', $billingaddress);
        $stmt->bindValue(':billingstate', $billingstate);
        $stmt->bindValue(':billingcity', $billingcity);
        $stmt->bindValue(':billingpincode', $billingpincode);
        $user = $stmt->execute();
        $count = $stmt->rowCount();

        $data = array(
        "status" => "passed"
        );
        echo json_encode($data);

    }catch(PDOException $e){
        $data = array(
            "status" => $e
        );
        echo json_encode($data);
    }
});

//===================================ShippingAddress==========================================
$app->get('/api2/getShippingAddress/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    
    $sql="SELECT * FROM users WHERE id =$id";

    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();
        $stmt = $db->query($sql);
        
        $user =$stmt->fetch(PDO::FETCH_OBJ);

        $db = null;
        echo json_encode($user);
        
    }catch(PDOException $e){
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

$app->put('/api2/UpdateShippingAddress/{id}', function (Request $request, Response $response, array $args) {
    
    $shippingaddress = $request->getParam('shippingaddress');
    $id = $request->getAttribute("id");
    $shippingstate = $request->getParam('shippingstate');
    $shippingcity = $request->getParam('shippingcity');
    $shippingpincode = $request->getParam('shippingpincode');
    
    $sql = "UPDATE users SET shippingAddress=:shippingaddress,shippingState=:shippingstate,shippingCity=:shippingcity,shippingPincode=:shippingpincode WHERE id=$id";
    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':shippingaddress', $shippingaddress);
        $stmt->bindValue(':shippingstate', $shippingstate);
        $stmt->bindValue(':shippingcity', $shippingcity);
        $stmt->bindValue(':shippingpincode', $shippingpincode);
        $user = $stmt->execute();
        $count = $stmt->rowCount();

        $data = array(
        "status" => "passed"
        );
        echo json_encode($data);

    }catch(PDOException $e){
        $data = array(
            "status" => $e
        );
        echo json_encode($data);
    }
});

//===================================GetListCart==========================================
$app->get('/api2/getlatestcart/{userId}', function (Request $request, Response $response, array $args) 
{
    $userId = $args['userId'];    
    $sql="SELECT * FROM cart WHERE userId =$userId AND paymentStatus=''";
    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

//===================================DeleteAnItem==========================================
$app->delete('/api2/deleteItem/{cartId}', function (Request $request, Response $response, array $args) {
    $cartId = $args['cartId'];
    $sql = "DELETE FROM cart WHERE cartId = $cartId";
    
    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
    
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
    
        $db = null;
        $data = array(
            "rowAffected" => $count,
            "status" => "success"
        );
        echo json_encode($data);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

//===================================UpdateQuantity==========================================
$app->put('/api2/updateCart/{cartId}', function (Request $request, Response $response, array $args) {
    
    $quantity = $request->getParam('quantity');
    $cartId = $args['cartId'];
    $sql = "UPDATE cart SET quantity= :quantity WHERE cartId=$cartId";
    
    // $cartId = $args['cartId'];
    // $sql="SELECT * FROM cart WHERE cartId = $cartId";

    try{
        //Get DB Object
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':quantity', $quantity);
        $user = $stmt->execute();
        $count = $stmt->rowCount();

        $data = array(
        "status" => "passed"
        );
        echo json_encode($data);

    }catch(PDOException $e){
        $data = array(
            "status" => $e
        );
        echo json_encode($data);
    }
});

//===================================PROCEED PAYMENT==========================================
$app->put('/api2/payment/{id}', function (Request $request, Response $response, array $args) {

    
    //upload photo

    // if(isset($_POST["submit"])){     
    //     $errors = array();
        
    //     $extension = array("jpeg","jpg","png","gif");
        
    //     $bytes = 1024;
    //     $allowedKB = 100;
    //     $totalBytes = $allowedKB * $bytes;
        
    //     if(isset($_FILES["files"])==false)
    //     {
    //         echo "<b>Please, Select the files to upload!!!</b>";
    //         return;
    //     }
        
        
    //     foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
    //     {
    //         $uploadThisFile = true;
            
    //         $file_name=$_FILES["files"]["name"][$key];
    //         $file_tmp=$_FILES["files"]["tmp_name"][$key];
            
    //         $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    //         if(!in_array(strtolower($ext),$extension))
    //         {
    //             array_push($errors, "File type is invalid. Name:- ".$file_name);
    //             $uploadThisFile = false;
    //         }               
            
    //         if($_FILES["files"]["size"][$key] > $totalBytes){
    //             array_push($errors, "File size must be less than 100KB. Name:- ".$file_name);
    //             $uploadThisFile = false;
    //         }
            
    //         if(file_exists("Upload/".$_FILES["files"]["name"][$key]))
    //         {
    //             array_push($errors, "File is already exist. Name:- ". $file_name);
    //             $uploadThisFile = false;
    //         }
            
    //         if($uploadThisFile){
                          
    //         }
    //     }
              
    // }

    //END of UPLOAD PHOTO

    

    $userID		= $request->getAttribute('id');
    $fullName   = $request->getParam('fullName');
    $nric       = $request->getParam('nric');
    $email      = $request->getParam('email');
    $contactNo  = $request->getParam('contactNo');
    $total 		= $request->getParam('total');
    $bank       = $request->getParam('bank');
    $status     = "Pending";
    $FilePath   = "Upload";
    // $filename=basename($file_name,$ext);
    // $newFileName=$filename.$ext;                
    // move_uploaded_file($_FILES["files"]["tmp_name"][$key],"Upload/".$newFileName);

    $sql4 = "UPDATE cart SET 
    fullName        = :fullName,
    nric            = :nric,
    email           = :email,
    contactNo       = :contactNo,
    bank            = :bank,
    total       	= :total,
    FilePath        = :FilePath,
    FileName        = :newFileName,
    paymentStatus   = :status
    WHERE userId   = $userID";



    try{
        //Get DB Object
        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql4);
        $stmt->bindValue(':fullName', $fullName);
        $stmt->bindValue(':nric', $nric);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':contactNo', $contactNo);
        $stmt->bindValue(':bank', $bank);
        $stmt->bindValue(':total', $total);
        $stmt->bindValue(':FilePath', $FilePath);
        $stmt->bindValue(':newFileName', $newFileName);
        $stmt->bindValue(':status', $status);

        $user = $stmt->execute();
        $count = $stmt->rowCount();

        $data = array(
        "status" => "passed"
        );
        echo json_encode($data);

    }catch(PDOException $e){
        $data = array(
            "status" => $e
        );
        echo json_encode($data);
    }
});

/////////////////////////////////////////////////////////////////////////////////////////// API for ADMIN 
$app->get('/Mbos/', function (Request $request, Response $response, array $args) {
    $response -> getBody()->write("Mummy and Baby Online Shopping");
    return $response;
});

///////////////////////////////////////////////////////////LOGIN START//////////////////////////////////////////////////////////////////////
$app->post('/Mbos/login', function (Request $request, Response $response, array $args) {
    
    $username= $_POST["username"];
    $password= md5($_POST["password"]);

    $sql= "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($count>0){
            $data = array(
            "status" => "success",
            "admin" => $user
        );
        
        $_SESSION['login']=$user['email'];
		$_SESSION['id']= $user['id'];
        $_SESSION['username']=$user['username'];

        echo json_encode($data);
        }
        else{
            $data = array(
                "status" => "Wrong Login"
            );
            echo json_encode($data);
        }
    }catch(PDOException $e){
        $data = array(
            "status" => "error"
        );
        echo json_encode($data);
    }
});

//===================================Register=================================================
$app->post('/Mbos/register', function (Request $request, Response $response, array $args) {
    
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password= md5($_POST["password"]);
    
    $sql = "INSERT INTO admin (email,username,password) VALUES (:email,:username,:password)";
    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);

        $user = $stmt->execute();
        $count = $stmt->rowCount();

        if($count>0){
            $data = array(
            "status" => "success"
        );
        echo json_encode($data);
        }
        else{
            $data = array(
                "status" => "Sign up failed!"
            );
            echo json_encode($data);
        }
    }catch(PDOException $e){
        $data = array(
            "status" => "error"
        );
        echo json_encode($data);
    }
});
///////////////////////////////////////////////////////////LOGIN END////////////////////////////////////////////////////////////////////////

//get all products
$app->get('/Mbos/products', function (Request $request, Response $response, array $args) {

    $sql = "SELECT * FROM products";

    try {
        $db = new db();
        $db = $db -> connect();
        $stmt = $db -> query($sql);
        $user = $stmt -> fetchAll(PDO::FETCH_OBJ);
        $db =  null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

//get all products by id
$app->get('/Mbos/products/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "SELECT * FROM products WHERE id = $id";

    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $products = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($products);
        
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

//delete products by id
$app->delete('/Mbos/products/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "DELETE FROM products WHERE id = $id";
    
    try {
        $db = new db();
        $db = $db->connect();
    
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
    
        $db = null;
        $data = array(
            "rowAffected" => $count,
            "status" => "success"
        );

        echo json_encode($data);

    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

// insert new product to database
$app->post('/Mbos/products/', function (Request $request, Response $response, array $args) {

    // $target_dir = "../images/";
    // $fileName = $target_dir.basename($_FILES["productImage"]["name"]);
    // $targetFilePath = $target_dir . $fileName;
    // $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $category = $_POST["category"];
    $productName = $_POST["productName"];
    $productCompany = $_POST["productCompany"];
    $productPrice = $_POST["productPrice"];
    $productImage = $_POST["productImage"]; 
    $productAvailability = $_POST["productAvailability"];
    $Date = $_POST["DateArrived"];
    $DateArrived = date('Y-m-d', strtotime(str_replace('-', '/', $Date)));
    $productDescription = $_POST["productDescription"];
    $productColor = $_POST["productColor"];
    $productQuantity = $_POST["productQuantity"];

    try {
        $sql = "INSERT INTO products (category, productName, productCompany, productPrice, productImage, productAvailability, DateArrived, productDescription, productColor, productQuantity) 
                VALUES (:category, :productName, :productCompany, :productPrice, :productImage, :productAvailability, :DateArrived, :productDescription, :productColor, :productQuantity)";

        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':productName', $productName);
        $stmt->bindValue(':productCompany', $productCompany);
        $stmt->bindValue(':productPrice', $productPrice);
        $stmt->bindValue(':productImage', $productImage);
        $stmt->bindValue(':productAvailability', $productAvailability);
        $stmt->bindValue(':DateArrived', $DateArrived);
        $stmt->bindValue(':productDescription', $productDescription);
        $stmt->bindValue(':productColor', $productColor);
        $stmt->bindValue(':productQuantity', $productQuantity);
    
        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;
    
        $data = array(
            "status" => "success",
            "rowcount" =>$count,

            "category" => $category,
            "productName" => $productName,
            "productCompany" => $productCompany,
            "productPrice" => $productPrice,
            "productImage" => $productImage,
            "productAvailability" => $productAvailability,
            "DateArrived" => $DateArrived,
            "productDescription" => $productDescription,
            "productColor" => $productColor,
            "productQuantity" => $productQuantity,
            
        );
        echo json_encode($data);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

// update product
$app->put('/Mbos/products/{id}', function (Request $request, Response $response, array $args) {
    
    $id = $args['id'];
    $productName = $request->getParam("productName");
    $category = $request->getParam("category");
    $productCompany = $request->getParam("productCompany");
    $productPrice = $request->getParam("productPrice");
    $productImage = $request->getParam("productImage");
    $DateArrived = $request->getParam("DateArrived");
    $productDescription = $request->getParam("productDescription");
    $productColor = $request->getParam("productColor");
    $productQuantity = $request->getParam("productQuantity");
    $productAvailability = $request->getParam("productAvailability");
    
    $sql = "UPDATE products SET productName=:productName, category=:category, productCompany=:productCompany, 
            productPrice=:productPrice, productImage=:productImage, DateArrived=:DateArrived,
            productDescription=:productDescription, productColor=:productColor, productQuantity=:productQuantity,
            productAvailability=:productAvailability WHERE id=$id";
            

    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->bindParam('productName', $productName);
        $stmt->bindParam('category', $category);
        $stmt->bindParam('productCompany', $productCompany);
        $stmt->bindParam('productPrice', $productPrice);
        $stmt->bindParam('productImage', $productImage);
        $stmt->bindParam('DateArrived', $DateArrived);
        $stmt->bindParam('productDescription', $productDescription);
        $stmt->bindParam('productColor', $productColor);
        $stmt->bindParam('productQuantity', $productQuantity);
        $stmt->bindParam('productAvailability', $productAvailability);

        $stmt->execute();
        $count = $stmt->rowCount();
    
        $data = array(
            "rowAffected" => $count,
            "status" => "success"
        );
        echo json_encode($data);
        
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});
$app->run();
?>

