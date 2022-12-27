<?php 
session_start();
error_reporting(0);
include 'include/config.php';
$uid=$_SESSION['uid'];

if(isset($_POST['submit']))
{ 
$pid=$_POST['pid'];


$sql="INSERT INTO tblbooking (package_id,userid) Values(:pid,:uid)";

$query = $dbh -> prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Package has been booked.');</script>";
echo "<script>window.location.href='booking-history.php'</script>";

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="sty.css">
    <link rel="javascript" href="script.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <title>Health2us</title>
  </head>
  <body>
    
    <div class="nav-bar">
<nav>
  <input type="checkbox" id="check" >
<label for="check" class="checkbtn">

<i class="fa fa-align-justify"></i>
</label>
<div class="logo-img">
  <img src="images/doct.png">
</div>
  <div class="logo">
  <a href="index.html"><img src="images/logo.png"></a>
  </div>
<ul>
	<li><a href="index.html">Home</li>
	<li><a href="about.html">About-Us</li>
	<li><a href="">Services</li>
	<li><a href="">Contact-Us</li>
<button><a href="#">Sign in</button>
<button><a href="#">Register</button>
</ul>

</nav>
</div>
<section class="devo">
    <div class="move">
    <h2 class="move">Connect with a Medical Consultant<br> at the comfort of your home</h2>
    <a href=""><button>Meet a Dr.</button></a>
    <div>
      <div class="glue">
    <h2 class="glue">Connect with a Medical Consultant<br> at the comfort of your home</h2>
    <a href=""><button>Meet a Dr.</button></a>
    <div>
    
</section>


<!-- Header Section -->
<?php include 'include/header.php';?>
	<!-- Header Section end -->

  <?php 

$sql ="SELECT id, category, titlename, PackageType, PackageDuratiobn, Price, uploadphoto, Description, create_date from tbladdpackage";
$query= $dbh -> prepare($sql);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
				<div class="col-lg-3 col-sm-6">
					<div class="pricing-item begginer">
						<div class="pi-top">
							<h4><?php echo $result->titlename;?></h4>
						</div>
						<div class="pi-price">
							<h3><?php echo htmlentities($result->Price);?></h3>
							<p>	<?php echo $result->PackageDuratiobn;?></p>
						</div>
						<ul>
							<?php echo $result->Description;?>
							
						</ul>
						<?php if(strlen($_SESSION['uid'])==0): ?>
						<a href="login.php" class="site-btn sb-line-gradient">Book Now</a>
						<?php else :?>
							<!-- <a href="#" class="site-btn sb-line-gradient">Booking Now</a> -->
							 <form method='post'>
                            <input type='hidden' name='pid' value='<?php echo htmlentities($result->id);?>'>
                          

                        <input class='site-btn sb-line-gradient' type='submit' name='submit' value='Booking Now' onclick="return confirm('Do you really want to book this package.');"> 
                        </form> 
							 <?php endif;?>
					</div>
				</div>
				<?php  $cnt=$cnt+1; } } ?>
			</div>
		</div>
	</section>
	

	<!-- Footer Section -->
	<?php include 'include/footer.php'; ?>
	<!-- Footer Section end -->


  </body>
</html>
