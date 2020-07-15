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

    //$query = mysqli_query($bd,"SELECT * FROM users WHERE email='$email' and password='$password'");
    //$num=mysqli_fetch_array($query);
    
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

$app->run();
?>