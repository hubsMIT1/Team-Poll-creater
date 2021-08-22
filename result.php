
<?php 
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: ../signup.php");
    exit;
}
// session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../lgn.php");
}
include 'pollserver.php';


if(isset($_GET['id'])){
$insertId2 = "SELECT * FROM poll_data WHERE id = ?";

$pre = $conn->prepare($insertId2);
$add4 = $pre->execute([$_GET['id']]);
$poll2 = $pre->fetchAll(PDO::FETCH_ASSOC);

if($poll2){
   // echo "sss";
   $insertId2 = "SELECT * FROM add_ans WHERE ans_id = ?";
   $pre = $conn->prepare($insertId2);
   $add4 = $pre->execute([$_GET['id']]);

   $poll_answers =  $pre->fetchAll(PDO::FETCH_ASSOC);
   $i =0;
   $total_votes = 0;
   foreach($poll_answers as $poll_answer){

    $total_votes += $poll_answer['vote'];
    
   }
   
   
   if(isset($_POST['poll_answer'])){
       // echo "aaas";
       $insertId2 = "UPDATE poll_answers SET vote = vote + 1 WHERE id = ?";
       $pre = $con->prepare($insertId2);
       $add4 = $pre->execute([$_POST['poll_answer']]);
       header('Location: results.php?id=' . $_GET['id']); //result line with 2 code;
       exit;
   }

}
else{exit('No any Polls!!');
}

}
else{
   exit('No any poll!');

}


?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>poll_result</title>

    <style>
        body{
            background: black;
        }
    .content{
        box-shadow: 0 6px 30px 0 rgb(200 0 0 / 20%);
        margin:1rem;
        padding:1rem;
        /* background: blue; */
        color:white;
        font-size:1.6rem;
    }

        .poll-result .wrapper {
    display: flex;
    flex-flow: column;
}

.poll-result .wrapper .poll-question {
    width: 50%;
    padding-bottom: 5px;
}

.poll-result .wrapper .poll-question p {
    margin: 0;
    padding: 5px 0;
    color:mediumorchid;
    font-size: 1.5rem;
}

.poll-result .wrapper .poll-question p span {
    font-size: 14px;
}

.poll-result .wrapper .poll-question .result-bar {
    display: flex;
    height: 25px;
    min-width: 5%;
    background-color: #38b673;
    border-radius: 5px;
    font-size: 10px;
    color: #FFFFFF;
    justify-content: center;
    align-items: center;
}
h1{
    color:mediumvioletred;
    text-align: center;
}
.log1 {
            width: 7rem;
            font-size: 1.5rem;
            margin: auto;
            padding: 0.5rem 0px;
            cursor: pointer;
            background: lime;
            border-radius: 5px;
            border: 3px white;
            box-shadow: 0 6px 16px 0 rgb(0 200 0 / 20%)
        }
        
        .log1:hover {
            box-shadow: 0 10px 20px 0 rgb(245, 19, 196);
            background: rgb(245, 19, 196);
            color: white;
            border: 5px white;
        }
    </style>
</head>
<body>
  <h1> Result </h1>
<div class="content poll-result">
<?php  
foreach($poll2 as $poll){
    ?>
	<h2><?=$poll['title']?></h2>
	<p><?=$poll['desc']?></p>
  
    <?php

 }

?>
  <div class="wrapper">
<?php   foreach ($poll_answers as $poll_answer): ?>
        <div class="poll-question">
            <p><?=$poll_answer['ans']?> <span>(<?=$poll_answer['vote']?> Votes)</span></p>
            <div class="result-bar" style= "width:<?=@round(($poll_answer['vote']/$total_votes)*100)?>%">
                <?=@round(($poll_answer['vote']/$total_votes)*100)?>%
            </div>
        </div>
        <?php endforeach; ?>
    </div>
   
        
 
</div>
<a href="../home.php"><button name='addTeam' action=" " class="log1" type="submit"> HOME </button></a>
</body>
</html>