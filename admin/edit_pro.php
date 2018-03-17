<?php include_once('connectionDb.php'); ?>
<?php
include_once('header.php');
$pid=$_GET['p_id'];
$fetch_pro_details_sql="SELECT pid,p_price FROM products WHERE pid='$pid'";
$products_result=mysqli_query($con,$fetch_pro_details_sql);
$product=mysqli_fetch_assoc($products_result);
if(isset($_POST['editpro'])){
	$p_id=trim($_POST['pid']);
	$p_price=trim($_POST['p_price']);


	if(empty($p_price)){
		$pro_error['p_price']='Please Enter Product Price';
	}
	if(empty($pro_error)){
		$price_update_sql="UPDATE products SET p_price='$p_price' WHERE pid='$p_id'";
		if(mysqli_query($con,$price_update_sql)){
			$user_price_sql="SELECT DISTINCT u_id,p_id,price FROM user_price WHERE p_id='$p_id' ORDER BY id DESC";
			$user_price_result=mysqli_query($con,$user_price_sql);
			while($price_details=mysqli_fetch_assoc($user_price_result)){
				$uids[]=$price_details['u_id'];
				$pid=$price_details['p_id'];
				$user_price=$price_details['price'];
			}
			if($user_price>=$p_price){
				foreach($uids as $uid){
					$user_sql="SELECT fname,lname,email FROM users WHERE uid='$uid'";
					$product_sql="SELECT p_title FROM products WHERE pid='$pid'";
					$user_ruselts=mysqli_query($con,$user_sql);
					while($user=mysqli_fetch_assoc($user_ruselts)){
						$name=$user['fname'].' '.$user['lname'];
						$email=$user['email'];


						$product_ruselts=mysqli_query($con,$product_sql);
						$product=mysqli_fetch_assoc($product_ruselts);
						$pro_title=$product['p_title'];


						$to = $email;
						$subject = "At Your Price";
						$txt = "Hello ".$name.". The Product ".$pro_title." is now available at $ ".$p_price;
						$headers = "From: webmaster@example.com" . "\r\n" .
						"CC: somebodyelse@example.com";

						if(mail($to,$subject,$txt,$headers)){
							$pro_error['mail_success']="Notification sent by email";
						}
						else{
							$pro_error['mail_fail']="Failed to sent notification";
						}
					}
				}
			}
			$pro_error['update_success']='Price Of The Product Has Been Updatedd';
		}
		else{
			$pro_error['update_fail']='Sorry Try Again';
		}
	}
	
}
?>
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-12 well">
					<?php
						if(isset($pro_error['mail_success']) and $pro_error['mail_success']!=''){
							echo '<div class="alert alert-success">'.$pro_error['mail_success'].'</div>';
						}
						if(isset($pro_error['mail_fail']) and $pro_error['mail_fail']!=''){
							echo '<div class="alert alert-danger">'.$pro_error['mail_fail'].'</div>';
						}
					?>
					<?php
						if(isset($pro_error['update_success']) and $pro_error['update_success']!=''){
							echo '<div class="alert alert-success">'.$pro_error['update_success'].'</div>';
						}
						if(isset($pro_error['update_fail']) and $pro_error['update_fail']!=''){
							echo '<div class="alert alert-danger">'.$pro_error['update_fail'].'</div>';
						}
					?>
					<h4>Edit Price Of Ptoduct</h4>
					<form action="" method="post" enctype="multipart/form-data">
						<label for="p_price" class="control-label">Price (*)</label>
						<input type="text" class="form-control" name="p_price" id="p_price" value="<?php if(isset($product['p_price'])){echo $product['p_price']; } ?>">
						<?php
						if(isset($pro_error['p_price']) and $pro_error['p_price']!=''){
							echo '<div class="text-danger">'.$pro_error['p_price'].'</div>';
						}
						?>
						<input type="hidden" name="pid" value="<?php echo $product['pid']; ?>">
						<br>
						<div class="text-right">
							<button type="reset" class="btn btn-primary">Reset</button>
							<button type="submit" name="editpro" class="btn btn-success">Edit Price</button>
						</div>
					</form>
				</div>
	    	</div>
          </section>
      </section>
<?php include_once('footer.php'); ?>