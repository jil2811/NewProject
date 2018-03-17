<?php
include_once('admin/connectionDb.php');
include_once('header.php');
?>
		<div class="container">
			<?php
			$c_id=$_GET['c_id'];
			$product_query="SELECT * FROM products WHERE cat_id='$c_id'";
			$products=mysqli_query($con,$product_query);
			?>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-xs-12 xol-sm-12 product-wrapper">
					<?php if(mysqli_num_rows($products)>0){
						while($product=mysqli_fetch_assoc($products)){
					?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="product">
								<div class="text-center product-image">
									<img src="assets/images/products/<?php echo $product['p_img']; ?>">
								</div>
								<div class="text-center product-info">
									<h4><?php echo $product['p_title']; ?></h4>
									<p><?php echo $product['p_desc']; ?></p>
									<p>Price : $ <?php echo $product['p_price']; ?></p>
									<p>
									Your price: <input type="text" name="user_price" class="user_price">
									<button <?php if(!isset($_SESSION['uid']) || $_SESSION['uid']==''){echo 'disabled'; } ?> type="button" id="btn_user_price" value="<?php echo $product['pid'] ?>" name="myprice">Submit</button>
									</p>
									<p class="ajax_result"></p>
									<?php if(!isset($_SESSION['uid']) || $_SESSION['uid']==''){ ?><p style="color: #f4a442;">Please <a href="login.php">Login Here</a> To Submit</p><?php } ?>
								</div>
							</div>
						</div>
					<?php
						} 
					}
					else{
						echo "<h4>No Product Found In This Category</h4>";
					}
					?>
				</div>
			</div>
		</div>
<?php include_once('footer.php'); ?>