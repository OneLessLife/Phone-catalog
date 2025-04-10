<?php
	session_start();
	require_once "conn.php"; //εναλλακτικες εντολες [include, require, include_once]
	//message for user after login attempt
	$message = '';
	
	//if post data exist
	if($_POST){
		//read field values
		$firstname='';
		if(isset($_POST['firstname'])){
			$firstname = $_POST['firstname'];
		}
		
		$admin='';
		if(isset($_POST['admin'])){
			$admin = $_POST['admin'];
		}	
		
		if($firstname && $admin){
			//build query
			$query = "SELECT * FROM users 
						WHERE 
						firstname='$firstname' 
						AND 
						admin='$admin' ";
						
			//execute query - $conn is initialised in conn.php
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			//number of records retreived
			$found = mysqli_num_rows($result);
			
			if($found){
				//initialise session variable
				$_SESSION['admin'] = "secret";
				//redirect to protected area
				header("location:admin1.php");
			}
			else {
				//set message for user
				$message = "Login failed. Please try again.";
			}
		}
		
		
		
	}
?>
<?php
	//include connection file to mysql server
	require_once "conn.php";
	
	//σχηματισμός ερωτήματος για την προβολή όλων των μελών
	$query = "SELECT * FROM users ORDER BY firstname ASC";
	//εκτέλεση ερωτήματος και εκχώρηση αποτελέσματος στη μεταβλητή $result
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Catalog members </title>
<style>
	.pic{
		border-radius:90px;
		box-shadow:#666 2px 2px 10px;
	}
	h1{
		text-align:center;
	}
	.even{
		background-color:#ecece6;	
	}
	.odd{
		background-color:#DDD;
	}
	
	thead td{
		background-color:#369;
		color:white;
		font-family:Tahoma;
		font-size:18px;
		align:center;
	}
</style>
</head>

<body>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>


<div class="wrapper">
    <nav>
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      <div class="logo"><a href="#">11880</a></div>
        <ul class="links">
          <li><a href="index2.php">Home</a></li>
		  <li><a href="#">Browse</a></li>
          <li>
            <a href="contact-form.php">Contact</a>
          </li>
		  <li><a href,button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
</li></a>

<div id="id01" class="modal">
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
	<form action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="container">
      <label for="firstname"><b>Firstname</b></label>
      <input type="text" name="firstname" id="firstname" value="" placeholder="firstname" required>

      <label for="admin"><b>Admin</b></label>
      <input type="text" name="admin" id="admin" value="" placeholder="admin" required>
        
      <button type="submit">Login</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
</form>
<script>
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

                </ul>
      </div>
      </form>
    </nav>
  </div>
<br><br>

<br><br>
<h1> Catalog members </h1>
<br><br>
<div align="left"> <a href="edit-delete_CLIENTasc.php"> Show members by alphabetical order(A-Z) </a></div>
<div align="left"> <a href="edit-delete_CLIENTdesc.php"> Show members by alphabetical order(Z-A) </a></div>

<br><br>
<table border="0" cellpadding="10" align="center" id="catalog" width="80%">
<thead>
	<tr>
        <td> FIRSTNAME </td>
        <td> LASTNAME  </td>
        <td> CITY      </td>
        <td> PHONE     </td>
        <td> PIC       </td>
       
    </tr>
</thead>

<tbody>

<?php
	$bg = '';
	//loop inside result recordset
	while($row = mysqli_fetch_assoc($result)){
		$firstname = $row['firstname'];
		$lastname  = $row['lastname'];
		$city      = $row['city'];
		$phone     = $row['phone'];
		$pic       = $row['pic'];
		$pic_tag   = '';
		if($pic){
			$pic_tag = "<img src='$pic' class='pic'>";
		}
		
		//set css style to tr elements ($bg)
		if($bg != "odd"){
			$bg = "odd";
		} else {
			$bg ="even";
		}
?>		
	<tr class="<?= $bg ?>">
        <td> <?= $firstname  ?></td>
        <td> <?= $lastname   ?></td>
        
        <td> <?= $city       ?></td>
        <td> <?= $phone      ?></td>
        <td align="center"> <?= $pic_tag ?></td>
        
    </tr>
    
<?php		
	}
?>

    
    
</tbody>

</table>

</body>
</html>