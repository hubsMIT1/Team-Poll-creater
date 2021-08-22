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



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add user</title>
    <style>
        html {
            font-size: 100%;
            
        }
        
        * {
            text-decoration: none;
        }
        
        body {
            /* /* background: linear-gradient(45deg, rgb(44, 41, 43), rgb(116, 231, 8), rgb(233, 62, 248), rgb(120, 240, 8));
            color: springgreen; */
            background-repeat: no-repeat;
            background-size: 100% 200%;
            /* background-color: #00DBDE; */
            background-image: linear-gradient(45deg, #00DBDE 0%, #FC00FF 100%);
        }
        
        .logPg {
          
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
            color: #f0f0f0;
            /* display: inline; */
            /* color: inherit; */
            font-weight: 700;
            font-size: 4rem;
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
            background: rgba(255, 255, 255, 0.5);
            border: none;
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
        .notice{
            color:maroon ;
            font-size: 1.3rem;

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
            }
        }
    </style>
</head>

<body>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'server2.php';
    $tmId = $_GET['id'];
   
   
    $name = $_POST["name"];
   

    $sql2 = "Select * from users where username = '$name' ";
    
    $result2 = mysqli_query($con, $sql2);
    $num2 = mysqli_num_rows($result2);
  
// echo "ram";
    if ($num2 == 1){
        // echo "ram";
        while($row=mysqli_fetch_assoc($result2)){
            // if (password_verify($password, $row['pswrd'])){ 

               
                $inId =  $row['s_no'];

                $name=  mysqli_real_escape_string($con, $_POST['name']);

                $sql42 = "Select * from invited_users where in_user = '$name' ";

                $result4 = mysqli_query($con, $sql42);
                // $chk2 = mysqli_num_rows($result4);
                

                $sql42 = "Select * from invited_users ";
                 $result4 = mysqli_query($con, $sql42);
                 $invite1 = true;
                       while($k = mysqli_fetch_array($result4)){
                       $arr2 = array();
                       array_push($arr2, $k['team_id']);

                  if( $arr2[0] == $_GET['id']){
                         $invite1 = false;
                   }else{
                         $invite1 = true;
        // echo '5';
        // echo $tmname['id']; 
      }
 }
                if($invite1) {

                $sql_in= "INSERT INTO `invited_users`( `in_user`, `team_id`,`users_in_id`,`i_dt`) VALUES ('$name','$tmId','$inId', current_timestamp())";
                $result_in = mysqli_query($con, $sql_in);
                $sql2 = "Select * from invited_users where in_user = '$name' ";
                $result3 = mysqli_query($con, $sql2);
               
                // echo "ram";
                 session_start();
                 header("location: home.php");
                // echo var_dump(password_verify($password, $row['pswrd']));
            // } 
        }else{
            echo ' Already Added';
        }
            
         
        }
    }
   
}
    
?>

<form action=" " method="POST">
    <div class="logPg">
        <!-- <div onclick="signUp();" class="signup">SignUp </div> -->
        <div onclick='logIn();' class="login"> <?php //echo $_SESSION['s_no']; ?> Add user </div>

        <div class="logInp">

        <div class="notice" name='notice'> </div>
            <input  class="name1" name="name" type="text"onfocus="this.value=''" value="" placeholder=" Enter Username" required>
           
            <button class="log1" type="submit" name='login'>Add</button>
        </div>
    </div>

    </form>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'server2.php';

 if ($num2 == 1){

        } 
    
    else{
        ?>
        <script>
             document.querySelector('.notice').innerHTML = "Invalid Username!";
            //  document.write('hey god');
    </script>
         
    <?php
}
}

?>
    <script>
        function signUp() {
         
        }
    </script>
</body>

</html>