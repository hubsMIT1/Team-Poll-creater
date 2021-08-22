<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: signup.php");
    exit;
}
// session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: lgn.php");
}
include 'polls/pollserver.php';


if(!empty($_POST)){
 
    $ids = $_GET['id'];
    session_start();
    $plId = $_SESSION['id'];
   
$title =isset($_POST['title']) ? $_POST['title'] : '';  
$description =   isset($_POST['description']) ? $_POST['description'] : '';  // $_POST['description'];


$answers = isset($_POST['answers']) ? explode(PHP_EOL,$_POST['answers']) : '';                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     


$slt2 = "select * from poll_data where title = '$title'";
$res    =   $conn->query($slt2);
$count1 = $res->rowCount();
if($count1 == 0){

$insertpoll1 = "INSERT INTO `poll_data`(`title`, `desc`,`getId`,`poll_id`) VALUES (?,?,?,?)";


$add1 = $conn->prepare($insertpoll1);


$add1->execute([$title, $description,$ids,$plId]);


$ans_id = $conn->lastInsertId();


header('location: home.php ');
foreach($answers as $ans){
    if(!empty($ans)){

$insertAns = "INSERT INTO `add_ans`( `ans_id`, `ans`) VALUES (?,?)";
$add2 = $conn->prepare($insertAns);
$add2->execute([$ans_id, $ans]);
// echo 'success';
}
}
}

?>
<?php 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
    <title>Document</title>

    <style>
        body{
            /* margin: auto ; */
            /* text-decoration: none; */
            background: linear-gradient(lime,blue);
            background-repeat: no-repeat;
            background-size: 100% 200%;
        }
        a{
            text-decoration: none;
            text-align: center;
        }
        .content{
            margin:auto 0;
            justify-content: center;
            justify-items: center;
            text-align: center;
        }

.update form {
    text-align: center;
    /* padding: 15px 0; */
    display: flex;
    flex-flow: column;
    /* width: 400px; */
    /* width: */
}

.update form label {
    display: inline-flex;
    /* width: 100%; */
    padding: 10px 0;
    margin-right: 25px;
}

.update form input,
.update form textarea {
    padding: 10px;
    /* width: 100%; */
    margin-right: 25px;
    margin-bottom: 15px;
    border: 1px solid #cccccc;
}

.update form textarea {
    height: 200px;
}

button {
    display: block;
    background-color: #38b673;
    border: 0;
    font-weight: bold;
    font-size: 2rem;
    color: #FFFFFF;
    cursor: pointer;
    /* width: 200px; */
    margin-top: 15px;
    margin-left: 10rem;
    border-radius: 5px;
}

button:hover {
    background-color:black;
}
</style>
</head>
<body>
<?php require 'server2.php' ;
$selectTeam = "select * from teams ";

$tmqr = mysqli_query($con,$selectTeam);

$tmnum = mysqli_num_rows($tmqr);

$tmname = mysqli_fetch_array($tmqr)
?>
<div class="content update">

	<h2> Create Poll </h2>
    <form action="creat.php?id=<?=$_GET['id'] ?>" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Title" required>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" placeholder="Description">
        <label for="answers">Answers (per line)</label>
        <textarea name="answers" id="answers" placeholder="Description" required></textarea>
       <a href=""> <button> CREATE</button></a>
    </form>
<?php

  ?>


    <!-- <?php if ($msg): ?> -->
    <!-- <p><?=$msg?></p> -->
    <!-- <?php endif; ?> -->
</div>

</body>
</html>