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
?>

 <?php 
// if($_SERVER["REQUEST_METHOD"] == "POST"){
    // session_start();
// $_SESSION['loggedin'] = true;
// $_SESSION['teamname'] = $team;
// header("location: home.php");
// }

$createTeam = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pollId = 0;
    include 'server2.php';
    $team = mysqli_real_escape_string($con,$_POST["team"]);
   
    $selectTeam = "select * from teams  where teamname = '$team' ";
    // $selectTeam = "select * from teams  where teamname = '$team' ";
    // $selectTeam = "select * from teams ";
    $userId = "selec * from teams where ";
    // $userId =  "select * from users ";   //"SELECT * FROM `users` WHERE email = '$email'";;
    // $qr = mysqli_query($con, $userId);
    // $main_id = 
    // $idqr = mysqli_query($con,$selectId);
    // $idnum = mysqli_num_rows($idqr);

    // echo $idnum;
    // echo 'ram';
    $tmqr = mysqli_query($con,$selectTeam);

    // $idqr = mysqli_query($con,$userId);
    // // $M_id = 
    // $idnum = mysqli_num_rows($idqr);
   
    
    $tmnum = mysqli_num_rows($tmqr);
    // $idN = mysqli_fetch_array($idqr);

    // while($idN = mysqli_fetch_array($idqr)){
    // echo $idN[0];
    echo'<pre>';
    // }
    if($tmnum == 0){
     $usrId1 =  $_SESSION['id'];
        
    $insertm = "INSERT INTO `teams`(`teamname`,`M_id`) VALUES ('$team','$usrId1')";

    $addtm = mysqli_query($con, $insertm);
    if($addtm){
        // $createTeam == true;
        $_SESSION['pollId'] += 1;
        // $pollId++;
        session_start();
        header("location: home.php?id=".$_SESSION['id']);

}}
// session_start();
// header("location: home.php");



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Team</title>
    <style>
        html {
            font-size: 100%;
          
        }
        
        * {
            text-decoration: none;
           
        }
        
     
        
        .logPg {
            /* width: 100%; */
            /* position: relative; */
            /* z-index: 1; */
            /* display: flex; */
            list-style: none;
            text-align: center;
            width: 50vw;
            margin: auto;
            box-shadow: 0 6px 16px 0 rgb(0 0 0 / 20%);
            /* padding: 2vw; */
            margin-top: 5vh;
            /* height: 70vh; */
        }
        
        .login {
            margin: 5px auto;
            border: none;
            /* background: rgba(0, 128, 0, 0.8); */
            /* width: 50%; */
            /* height: 70px; */
            box-shadow: 0 6px 16px 0 rgb(137, 141, 137);
            /* position: relative; */
            /* z-index: 1; */
            /* background: #fff; */
            color: #000000;
            /* display: inline; */
            /* color: inherit; */
            font-weight: 700;
            font-size: 3rem;
            padding: 0.3rem 0;
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .logInp {
            display: flex;
            flex-direction: column;
            margin: auto;
            padding: 1.5vw;
            /* row-gap: 3rem; */
            width: 40vw;
        }
        
        input {
            padding: 0.8rem;
            font-size: 1rem;
            margin: 1rem;
            /* padding: 1.5vw; */
            background: rgba(255, 255, 255,0.5 );
            /* border: none; */
            border-radius: 5px;
        }
        textarea{
            padding: 0.8rem;
            font-size: 1rem;
            margin: 1rem;
            border-radius: 5px;
        }
        /* input:hover {
            border: 10px rgb(167, 28, 28);
        } */
        
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
        
        a {
            cursor: pointer;
            color: rgb(255, 255, 255);
        }
        
        a:hover {
            color: rgb(230, 22, 126);
            font-size: 18px;
        }
        /* .alrd {
            padding-bottom: 1rem;
            font-size: 1rem;
        } */
        
        @media screen and (max-width: 550px) {
            html {
                font-size: 79%;
            }
            .logPg {
                width: 95%;
                margin-top: 10vh;
                height: 90%;
            }
            .logInp {
                width: 80%;
                padding: 1.5vw;
                /* row-gap: 4rem; */
            }
            .login {
                margin-bottom: 3rem;
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <form action="" method="POST">
    <div class="logPg">
        <!-- <div onclick="signUp();" class="signup">SignUp </div> -->
        <div onclick='logIn();' class="login"> Create Team </div>
        <div class="logInp">
            <input class="urEmail" name="team" placeholder="Team Name" required>
            <textarea class="urpswrd" name="desc" placeholder="Description (optional)" ></textarea>
            <button name='addTeam' action=" " class="log1" type="submit">Add </button>

        </div>
    </div>
    </form>
   
   
    <script>
        function signUp() {

        }
    </script>
</body>

</html>