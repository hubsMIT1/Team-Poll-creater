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
include '../server2.php';
if(isset($_GET['id2'])){


    $dlt1 = $conn->prepare('SELECT * FROM teams WHERE id = ?');
    $dlt1->execute([ $_GET['id2'] ]);
    $team = $dlt1->fetch(PDO::FETCH_ASSOC);

    if(isset($_GET['conf'])){
        if($_GET['conf'] == 'yes'){
            $dlt1 = $conn->prepare('delete from teams where id = ?');
            $dlt1->execute([$_GET['id2']]);

            // $dlt2 = $conn->prepare(('delete from add_ans where ans_id = ?'));
            // $dlt2->execute([$_GET['id']]);
            header('Location: ../home.php');
           // exit;
        }
    else{
        header('Location: ../home.php');
        exit;
    }
}
}




if(isset($_GET['id'])){
 

    $dlt1 = $conn->prepare('SELECT * FROM poll_data WHERE id = ?');
    $dlt1->execute([ $_GET['id'] ]);
    $poll = $dlt1->fetch(PDO::FETCH_ASSOC);

    if(isset($_GET['conf'])){
        if($_GET['conf'] == 'y'){
            $dlt1 = $conn->prepare('delete from poll_data where id = ?');
            $dlt1->execute([$_GET['id']]);

            $dlt2 = $conn->prepare(('delete from add_ans where ans_id = ?'));
            $dlt2->execute([$_GET['id']]);
            header('Location: ../home.php');
           // exit;
        }
    else{
        header('Location: ../home.php');
        exit;
    }
}
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
            /* padding: 100%; */
            /* overflow: hidden; */
        }
        
        * {
            text-decoration: none;
            /* background:linear-gradient(45deg, #00DBDE 0%, #FC00FF 100%); */
            /* background-repeat: no-repeat; */
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
    .dlt1{
        margin: auto;
        display: flex;
        flex-direction: row;
        column-gap: 3rem;


    }
        
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
    <?php 
if(isset($_GET['id'])){
    ?>
    <!-- <form action="" method="POST"> -->
    <div class="logPg">
        <!-- <div onclick="signUp();" class="signup">SignUp </div> -->
        <!-- <div onclick='logIn();' class="login"> Create Team </div> -->
        <div class="logInp">
          <p> ARE YOU WANT TO DELETE THIS POLL ?</p>
          <div class="dlt1">
          <a href='dlt.php?id=<?=$poll['id'] ?>&conf=y'>  <button name='yes' action=" " class="log1" type="submit">YES </button></a>

          <a href='dlt.php?id=<?=$poll['id'] ?>&conf=n'> <button name='no' action=" " class="log1" type="submit">NO</button></a>
            </div>
        </div>
    </div>
    <!-- </form> -->
    <?php 
}

    ?>
    <?php 

     if(isset($_GET['id2'])){
     ?>
     <!-- <form action="" method="POST"> -->
     <div class="logPg">
        <!-- <div onclick="signUp();" class="signup">SignUp </div> -->
        <!-- <div onclick='logIn();' class="login"> Create Team </div> -->
        <div class="logInp">
            <p> ARE YOU WANT TO DELETE THIS TEAM ?</p>
            <div class="dlt1">
          <a href='dlt.php?id=<?=$team['id'] ?>&conf=yes'>  <button name='yes' action=" " class="log1" type="submit">YES </button></a>

          <a href='dlt.php?id=<?=$team['id'] ?>&conf=no'> <button name='no' action=" " class="log1" type="submit">NO</button></a>
            </div>
        </div>
    </div>
    <!-- </form> -->
    <?php 
}

    ?>
    
   
    <script>
        function signUp() {

        }
    </script>
</body>

</html>