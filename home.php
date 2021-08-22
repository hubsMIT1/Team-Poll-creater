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
include 'server2.php';

$dlt1 = "select * from poll_data ";
$dltqr = mysqli_query($con ,$dlt1);

while ($ftch2 = mysqli_fetch_assoc($dltqr)){


date_default_timezone_set('Asia/Kolkata');
$n_d = date("d",strtotime($ftch2['dt4']));
$n_d2 = date("d",strtotime($ftch2['dt4']));

$c_d2 = date('d');

$id = $ftch2['id'];

// echo $id;

// echo $c_d2 - $n_d2;

if( abs($c_d2 - $n_d2) >= 1 ){

    $dlt1 = "delete from poll_data where id = $id";
    $dlt12 = mysqli_query($con,$dlt1);
     
    // $dlt1 = $conn->prepare("delete from poll_data where id = $id");
    if($dlt12){
        // echo 'success';
        // echo $id;
    }
    $dlt13 = "delete from add_ans where ans_id = $id";
    $dlt13 = mysqli_query($con,$dlt1);
    
}



// echo '<br>';
}
// $pollId =0;
?>

<?php 



?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <title>Welcome</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            box-sizing: border-box;
            /* font-size: 100%; */
        }
        
        nav {
            background-color: black;
            display: flex;
            /* flex-direction: row; */
            color: white;
            height: 3rem;
            /* column-gap: 20rem; */
        }
        
        .nav2 {
            margin: auto 0 ;
            /* text-align: right; */
            display: flex;
            flex-direction: row;
            color: white;
            column-gap: 35vw;
            font-size: 1.3rem;
        }
        .nav3{
          display: flex;
            flex-direction: row;
            color: white;
            column-gap: 25vw;
            /* font-size: 1.5rem; */
            /* float: right; */

        }
        .team2:hover{
          background-color: blue;
        }


  

        
        .team2 {
            width: 10rem;
            /* font-size: 1.5rem; */
            margin: auto;
            padding: 0.5rem 2px;
            cursor: pointer;
            background: rgb(233, 240, 233);
            border-radius: 5px;
            border: 3px white;
            color: black;
            /* box-shadow: 0 6px 16px 0 rgb(0 200 0 / 20%) */
        }
        .lgn{
         color:black;
          /* color:red; */

        }
        .lgn:hover{
          color:red;
        }
        
        h1 {
            /* margin-top: 10vh; */
            text-align: center;
            background: rgb(233, 240, 233);
        }

      table{
  /* table-layout: fixed; */
  width: 100%;
  border-collapse: collapse;
/* margin: 20px; */
padding-bottom:100px;
  /* position: relative; 
  top:100px;  */
 
}
.tr1{
    border-left: 10px solid black;
    position: relative;
    /* top:100px; */
}
/* th{
    border: 0px white;
    
} */

.tr1 th:nth-child(1) {
  width: 50%;
  color: black;
  /* font-size: 5rem; */
  /* margin: 200px; */
  /* text-align-last:left; */

}

.tr1 th:nth-child(2) {
  width: 20%;
  /* font-size: 5rem; */
  padding: 1rem 0px;

}

.tr1 th:nth-child(3) {
  width: 20%;
  padding: 1rem 0px;
}

.tr1 th:nth-child(4) {
  font-size: 1rem;
}


html {
  font-family: 'helvetica neue', helvetica, arial, sans-serif;
}

/* thead th {
  font-family: 'Rock Salt', cursive;
} */



td {
  letter-spacing: 1px;
}


thead {
  /* background: url(leopardskin.jpg); */
  color: white;
  text-shadow: 1px 1px 1px black;

 
}

.tr1 th {
  /* background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.5)); */
  border-left: 3px solid purple;
  /* border-bottom: 3px solid purple; */
  border-top: 3px solid purple;

  /* box-shadow: 10 6px 105px 0 rgb(200 30 0 / 20%);  */
  /* position: relative; */
  /* top: 100px;  */
  margin: 20px;

}



table {
  /* background-color: #ff33cc; */
  box-shadow: 0 6px 5px 0 rgb(200 30 0 / 20%);
  padding: 10px;
}
.btn1{
    font-size: 1.5rem;
    color: blanchedalmond;
    background-color:rgba(19,21,255,0.5);
    padding: 0.3rem 0.3rem;
    cursor: pointer;
    border-radius: 5px;
   margin: 2px;
    /* border: 3px black; */
    box-shadow: 0 6px 16px 0 rgb(200 0 0 / 20%);
    
}
.btn1:hover{
    box-shadow: none;
    /* border: 5px black; */
    background-color: lime;
    color: black;

}
.team3{
    /* display: inline-table; */
    text-overflow: hidden;
    word-break:break-all;
    font-size: 2rem;
}
/* .thead1{
    display: flex;
    flex-direction: column;
    row-gap: 30px;
    column-gap: 10px;
} */
.th2{
    margin:10px;
    text-align: center;
    /* width:200px; */
   
  
  /* margin-bottom: 20x; */
  /* padding-left: 300px; */
  border: 2px black;
  /* word-wrap: ellipse; */
  word-break:break-all;
 

}
.th3{
  /* background: cornflowerblue; */
  word-break:break-all;
    margin: 20px;
    /* position: relative; */
    box-shadow: 0 6px 0px 0 rgb(200 30 0 / 20%);
  /* top: 100px; */
    /* width: 80%; */
     /* text-align: center; */
     font-size: 2rem;
     padding-left: 10px;
     border-left: 10px solid gray;

}
.tr1{
    /* position: relative; */
  /* top: 100px; */
  padding: 10px;
  margin: 20px;
}

@media screen and (max-width: 800px){
  table {
    font-size: 90% ;
  }
  tbody{
    font-size: 70% ;
  }
  table .th3 tr,.th3{
/* font-size: 90%; */
/* padding: 90%; */
  }
 .btn1{
    font-size: 80%;
  }
  .th3{
    font-size: 130%;
  }
  .team2{
    font-size: 70%;
    width: 100%;
  }
  .nav2 {
          
            column-gap: 30vw;
            font-size: 1rem;
        }
        .nav3{
         
            column-gap: 20vw;
            font-size: 1rem;
            /* float: right; */

        }

}
   
    </style>

 </head>
 <body>      

    <nav>
        <!-- <img class="img1" src="team1.jpg" /> -->
        <div class="nav2">
        <h4>   <?php echo ' Welcome '.$_SESSION['username']?></h4>
          <div class="nav3">
        <a href="createteam.php" ><input name='crTm'  type='submit' class="team2" value="Create Team"></a> 
      
          
            <!-- <form accept="" method="POST"> -->
           <h4 style = "color:red"; class="lgn" name='logout'><a href="home.php?logout='1'"> Logout </a></h4>
            <!-- </form> -->
            </div>
        </div>
    </nav>
    <h1 class="tm3">All Teams</h1>
    <!-- <ul class="teams2"> -->

    <?php 
    
   require 'server2.php';
//  $k=0;
   $_SESSION['m']=0; 
   $m = 0;

   $selectTeam = "select * from teams ";

   $tmqr = mysqli_query($con,$selectTeam);
  
   $tmnum = mysqli_num_rows($tmqr);
  
   $sql42 = "Select * from invited_users ";
   $result4 = mysqli_query($con, $sql42);
  
  // echo var_dump($invite1);
     while( $tmname = mysqli_fetch_array($tmqr)){
     $tm =$tmname['id'];
     $invite1 = false;
    while($k = mysqli_fetch_array($result4)){
      // echo ;
     
      $arr = array();
      $arr2 = array();
      array_push($arr, $k['users_in_id']);
      array_push($arr2, $k['team_id']);
      
      if( $arr[0] == $_SESSION['id'] && $arr2[0] == $tmname['id'] ){
        //  echo $tmname['id'];  
        //  echo '5';
        $invite1 = true;
          
      }else{
        $invite1 = false;
        // echo '5';
        // echo $tmname['id']; 
      }


   }
  //  echo var_dump($invite1);
         if( $_SESSION['id'] == $tmname['M_id'] || $invite1 == true ){
          $m = $tmname['id'];
?>
<table>
 <thead> 
   <!-- <span class="thead1"> -->
     <tr class="tr1">
     <th class="team3"><?php echo $tmname['teamname'];
    //  echo '<br>';
    // echo $tmname['id'];
    //  echo $tmname['id']; ?></th>
      <th  scope="col"><a href='add_user.php?id=<?=$tmname['id'] ?>'> <button class="btn1"> Add users </button></a></th>
     

      <th scope="col"> <a href=" creat.php?id=<?=$tmname['id'];?>"> <button class="btn1"> Create Polls </button></a></th>
      <!-- <th> <a href="polls/dlt.php?id2=<?//=$tmname['id']?>" class="trash"> delete</a> -->
         </th>
      </tr>
      <!-- </span> -->
  </table>
  </thead>
  <?php
    
  
?>
  <tbody>
    <div class="th3">
      <?php 


    }
      include 'polls/pollserver.php';

      $insertIn = "SELECT p.*, GROUP_CONCAT(pa.ans ORDER BY p.id) AS answers FROM poll_data p LEFT JOIN add_ans pa ON pa.ans_id = p.id GROUP BY p.id";
      
      
      $add3 = $conn->query($insertIn);
      
      
      $polls = $add3->fetchAll(PDO::FETCH_ASSOC);
    
     
  foreach($polls as $poll){ ?>
 
  <?php

      if($_SESSION['id'] == $poll['poll_id'] || $invite1 ==true  ){
       
       if($tmname['id'] ==  $poll['getId']) { 
      
   ?>
      <th class="th2" scope="row"> <?php  


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	
        <link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<style>
        .home table tbody tr td.actions .view, .home table tbody tr td.actions .edit, .home table tbody tr td.actions .trash {
      display: inline-flex;
      text-align: right;
      text-decoration: none;
      color: #FFFFFF;
      padding: 10px 12px;
      border-radius: 5px;
}
.title {
  background-color: lightslategrey;
}
.titleV:hover{
background-color:limegreen;

}
table{
  padding: 120px;
  /* margin: 120px; */
}

.titleV{
  margin: 120px;
}
.titleA2{
 margin:  110px;
 padding: 120px;
}
.home table tbody tr td.actions .trash {
      background-color: #b73737;
}
.home table tbody tr td.actions .trash:hover {
      background-color: #a33131;
}

.home table tbody tr td.actions .edit {
    background-color: #37afb7;
}

.home table tbody tr td.actions .edit:hover {
    background-color: #319ca3;
}

.home table tbody tr td.actions .view {
    background-color: #37b770;
}

.home table tbody tr td.actions .view:hover {
    background-color: #31a364;
}
</style>
    </head>
	<body>
<div class="content home">
	<h2>Polls</h2>

	<table>
        <thead class="titleA">
            <tr class="title">
                <td> </td>
                <td><u>Title</u></td>
				        <td><u>Answers</u></td>
                <td></td>
            </tr>
        </thead>
        <tbody class="titleA2">

            <?php 
           
                require 'server2.php' ;
                $_SESSION['m']=0;
           
               foreach($polls as $poll) {
                
          
                     if($poll['getId'] == $tmname['id'] + $_SESSION['m']){
                  
                ?>
           
            <tr class="titleV">
                <td > &nbsp;&nbsp;&nbsp;&nbsp;<?//=$poll['id']?></td>
                <td><u><?=$poll['title']?></u></td>
			        	<td><u><?=$poll['answers']?></u></td>
                <td class="actions">
				           	<a href="polls/voting.php?id=<?=$poll['id']?>" class="view" title="View Poll"><i class="fas fa-eye fa-xs"></i></a>
                    <a href="polls/dlt.php?id=<?=$poll['id']?>" class="trash" title="Delete Poll"><i class="fas fa-trash fa-xs"></i></a>
                </td>
                
            </tr>
            
            <?php  
          //   } 
          //  } ;
          // } 
        }
     // = $poll['getId'];
     //echo $poll['id'];
     } 
            //  }
         ?>
        
        </tbody>
       
    </table>
</div>
    </body>
</html>   </th>
<!-- <br> -->

<?php  
         
     
     break;    } 
    }
   
             }
         ?>
         </div>
  </tbody>
      
       <?php
     
       $_SESSION['m'] += 1;
      
      $m++; }//}
  
  ?>  

</body>

</html>