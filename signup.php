
<?php
 include 'server2.php' ;
 $err= false;
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $name=  mysqli_real_escape_string($con, $_POST['name']);
    $email= mysqli_real_escape_string($con,$_POST['email']);
    $password= mysqli_real_escape_string($con,$_POST['password']);
    $conf_password= mysqli_real_escape_string($con,$_POST['conf_password']);
    // $pswrd = password_hash($password,PASSWORD_BCRYPT);
    // $cfpswrd = password_hash($conf_password, PASSWORD_BCRYPT);

    $emailqr =  "select * from users where useremail = '$email' ";   //"SELECT * FROM `users` WHERE email = '$email'";;
    $qr = mysqli_query($con, $emailqr);
    $emailCount = mysqli_num_rows($qr);
    // echo " ".$emailCount." ".$email;
    if($emailCount > 0){    
        ?>
    <script>
         document.querySelector('.notice').innerHTML = "Email already exits";
        //  document.write('hey god');
</script>
        <!-- echo"Email already exit!!"; -->
<?php

    }else{
    if($password == $conf_password){
   
           $hash = password_hash($password, PASSWORD_DEFAULT);
            // $hash2 = password_hash($conf_password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`( `username`, `useremail`, `pswrd`, `dt`) VALUES ('$name', '$email','$hash', current_timestamp())";
            $result = mysqli_query($con, $sql);

  if($result){
  
// die($k);
            session_start();
            header("location:lgn.php");
            exit;
//  $hm =  fopen('lgn.php','r');
//  echo fread($hm,filesize('lgn.php'));
// fclose($hm);
// exit();
}
else{
    // echo"connecton not success";
}}else{
    $err = true;
    // unset($err);
    $_SESSION['err']="Password not matching";


    ?>

    <script>
// document.querySelector('.notice').innerHTML = "Password not matching";
        </script>
    
<?php

// echo"Email already exit!!";
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
    <link rel="stylesheet" href="styles.css">
    <title>LoginPage</title>

    

    </style>
</head>

<body>



    <form action='signup.php' method="POST">
    <div class="btn1">
        <div onclick="signUp();" class="signup">SignUp </div>
       

        <!-- <div class='success'> Success! Your account have been created Succesfully!! </div> -->
        
        <div class="sign1">
            <div class="notice"> <?php  if($err){echo $_SESSION['err'];
            $err = false;}?></div>
            <input  class="name1" name="name" type="text"onfocus="this.value=''" value="" placeholder="Username" required>
            <input  type="email" class="email1" name="email" onfocus="this.value=''" value="" placeholder="Your Email" required>
            <input  type="password" class="pswrd" name="password" onfocus="this.value=''" value="" placeholder="Your password" required>
            <input  type="password" class="pswrd" name="conf_password"onfocus="this.value=''" value="" placeholder="Confirm password" required>
            <div class="btns">
            <button class="create" type="submit" name='submit'> Create </button>
            <!-- <button  class="goLogin"   name='submit'> <a href='./lgn.php'> LogIn </a></button> -->
            </div>
            <!-- <button class="create" type="submit" name='submit'><a href='./wlcm.html'> Create </a></button> -->
        </div>
        <div class="alrd">Already have an account : <a href='./lgn.php'>Login</a></div>
    </div>
    </form>
    
    <script> 
        function signUp() {
document.querySelector('.success').innerHTML = "Success! Your account have been created Succesfully!!"
}

// <a href='./wlcm.html'
//      
</script>
</body>

</html>