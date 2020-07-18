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
        $_SESSION['username']=$user['name'];

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

$app->run();
?>