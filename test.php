<?php
require_once 'database.php';

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT customer_name from clients_information");
    $sql->execute();
    } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    echo $data['customer_name']."<br>";
}
$conn=null;
?>
<html>
<a href="test1.php">click</a><br>
<button onclick="test1.php">click</button>
</html>
<!--
//$conection = mysqli_connect('localhost','root','mysql','crm');
//if(!$conection){
//    die("Connection filed".mysqli_connect_error());
//}
//$sql = "select customer_name from clients_information";
//$rslt = mysqli_query($conection, $sql);
//while($row = mysqli_fetch_assoc($rslt)){
//    echo $row['customer_name']."<br>";
//}
//$host = "localhost";
//$username = "root";
//$password = "mysql";
//$database = "crm";
//$connec = new PDO("mysql:host=$host;dbname=$database",$username,$password);
//try {
//    $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $stmt = $connec->prepare("SELECT customer_name FROM clients_information");
//    $stmt->execute();
//}catch (PDOException $e){
//    echo $stmt . "<br>" . $e->getMessage();
//}
//    while ($rslt = $stmt->fetch(PDO::FETCH_ASSOC)) {
//        echo $rslt['customer_name']."<br>";
//
//    }
//echo "helo";  -->