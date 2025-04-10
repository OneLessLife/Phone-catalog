<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("location:index.php");
	}
	else {
		if($_SESSION['admin'] != "secret"){
			header("location:index.php");	
		}
	}
?>
<?php
	require_once "conn.php";
	
	$query = "SELECT * FROM users";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> ADMIN AREA </title>
<style>
	h1{
		text-align:center;	
	}
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
		  </a>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
	<form action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" name="username" id="username" value="" placeholder="Username" required>

      <label for="psw"><b>Password</b></label>
      <input type="text" name="password" id="password" value="" placeholder="Password" required>
        
      <button type="submit">Login</button>
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
<br><br><br>
<h1> Catalog members </h1>

<table border="0" cellpadding="10" align="center" id="catalog" width="80%">
<thead>
	<tr>
        <td> ID </td>
		<td> FIRSTNAME </td>
        <td> LASTNAME  </td>
        <td> CITY      </td>
        <td> PHONE     </td>
        <td> PIC       </td>
        <td> EDIT     </td>
        <td> DELETE       </td>
    </tr>
</thead>

<tbody>

<?php
	$bg = '';
	//loop inside result recordset
	while($row = mysqli_fetch_assoc($result)){
		$id        = $row['id'];
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
		<td> <?= $id  ?></td>
        <td> <?= $firstname  ?></td>
        <td> <?= $lastname   ?></td>
        
        <td> <?= $city       ?></td>
        <td> <?= $phone      ?></td>
        <td align="center"> <?= $pic_tag ?></td>
        <td align="center"> 
            	<a href="edit_member.php?id=<?= $id ?>"><img src="edit.png"></a>     
            </td>
            <td align="center"> 
            	<a href="delete_member.php?id=<?= $id ?>"><img src="delete.png"></a>  
            </td>
    </tr>
    
<?php		
	}
?>

    
    
</tbody>

</table>
<br> <br>
<br>
<div align="center"> <a href="add_member.php"> Add new member </a></div>
</body>
</html>