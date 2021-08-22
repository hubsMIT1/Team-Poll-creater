<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>LoginPage</title>
    <style>
       
    </style>
</head>

<body>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'server2.php';
    // include 'signup.php';
    // $name = $_POST["name"];
    // $email = $_POST["email"];
   
    $name = $_POST["name"];
    $password = $_POST["password"]; 
    

    $sql2 = "Select * from users where username='$name' ";
   
    $result2 = mysqli_query($con, $sql2);
    $num2 = mysqli_num_rows($result2);
   

    if ($num2 == 1){
        while($row=mysqli_fetch_assoc($result2)){
            if (password_verify($password, $row['pswrd'])){ 
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $name;
               
                $_SESSION['id'] = $row['s_no'];
                header("location: home.php?id=".$_SESSION['id']);
                exit;
                // echo var_dump(password_verify($password, $row['pswrd']));
            } 
           
        }
        
    } 
   
}
    
?>

<form action="" method="POST">
    <div class="logPg">
        <!-- <div onclick="signUp();" class="signup">SignUp </div> -->
        <div onclick='logIn();' class="login"> Log In </div>

        <div class="logInp">
        <div class="notice" name='notice'> </div>
            <input  class="name1" name="name" type="text"onfocus="this.value=''" value="" placeholder="Username" required>
            <!-- <input onfocus="this.value=''" value=""class="urEmail" type='email' name="email" placeholder="Your username or email" required> -->
            <input onfocus="this.value=''" value=""class="urpswrd" type="password" name="password" placeholder="Your password" required>
            <button class="log1" type="submit" name='login'>Log In </button>
        </div>
    </div>
    </form>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'server2.php';
  $name = $_POST["name"];
  $password = $_POST["password"];
  $sql2 = "Select * from users where username='$name' ";
  $sql = "Select * from users where pswrd = '$password'";

  $result = mysqli_query($con, $sql);
  $num = mysqli_num_rows($result);
  $result2 = mysqli_query($con, $sql2);
  $num2 = mysqli_num_rows($result2); 

 if ($num2 == 1){
    while($row = mysqli_fetch_assoc($result2)){
        // echo $row;
        if (password_verify($password, $row['pswrd']) == false){ 
     
?>  
            <script>
        document.querySelector('.notice').innerHTML = "Invalid Password!";
                //    document.write('hey god');

          </script>
                  <!-- echo"Email already exit!!"; -->
          <?php
        } 
    }
}else{
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