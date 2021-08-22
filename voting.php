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
    if(isset($_POST['poll_answer'])){
        // echo "aaas";
        $insertId2 = "UPDATE add_ans SET vote = vote + 1 WHERE id = ?";
        $pre = $conn->prepare($insertId2);
        $add4 = $pre->execute([$_POST['poll_answer']]);
        header('Location: result.php?id=' . $_GET['id']); // result.php -> 2;
        exit;
        // echo vote;
    }

}
else{exit('No any Poll ');
}
}else{
    exit('no any POLL');}

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
            background: rbga(0,0,0,0.5);
        }
        .content{
            /* margin-left: 30vw; */
            /* padding: 2rem; */
            background: pink;
            box-shadow: 0 6px 16px 0 rgb(0 0 0 / 20%);
        }

.poll-vote form {
    display: flex;
    flex-flow: column;
}

.poll-vote form label {
    padding-bottom: 10px;
}

.poll-vote form input[type="radio"] {
    transform: scale(1.1);
}

.poll-vote form input[type="submit"],
.poll-vote form a {
    display: inline-block;
    padding: 8px;
    border-radius: 5px;
    background-color: #38b673;
    border: 0;
    font-weight: bold;
    font-size: 14px;
    color: #FFFFFF;
    cursor: pointer;
    width: 150px;
    margin-top: 15px;
}

.poll-vote form input[type="submit"]:hover,
.poll-vote form a:hover {
    background-color: #32a367;
}

.poll-vote form a {
    text-align: center;
    text-decoration: none;
    background-color: #37afb7;
    margin-left: 5px;
}

.poll-vote form a:hover {
    background-color: #319ca3;
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
<?php 
foreach($poll2 as $poll){
?>
<!-- echo $poll['title']; -->

<div class="content poll-vote">
	<h2><?=$poll['title']?></h2>
	<p><?=$poll['desc']?></p>
    <form action="voting.php?id=<?=$_GET['id'] ?>" method="post">
        <?php for ($i = 0; $i < count($poll_answers); $i++): ?>
        <label>
            <input type="radio" name="poll_answer" value="<?=$poll_answers[$i]['id']?>"<?=$i == 0 ? ' checked' : ''?>>
            <?=$poll_answers[$i]['ans']?>
        </label>
        <?php endfor; ?>
        <div>
            <input type="submit" value="Vote">
            <a href="result.php?id=<?=$poll['id']?>">View Result</a>
        </div>
    </form>
</div>
<a href="../home.php"><button name='addTeam' action=" " class="log1" type="submit"> HOME </button></a>
<?php
}
?>
</body>
</html>