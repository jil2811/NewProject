<?php include_once('connectionDb.php'); ?>
<?php
include_once('header.php');
if(isset($_POST['addpro'])){
	$cat_id=trim($_POST['cat_id']);
	$p_title=trim($_POST['p_title']);
	$p_desc=trim($_POST['p_desc']);
	$p_price=trim($_POST['p_price']);
	$p_img=$_FILES['p_img'];
	$img_ext=strtolower(end(explode('.',$_FILES['p_img']['name'])));
	echo $p_img['type'];
	if(empty($p_img['name'])){
		$pro_error['img_empty']='Please Select An Image';
	}
	$expensions= array("jpeg","jpg","png");
	if(in_array($img_ext,$expensions)===false){
		$pro_error['img_type']='Please Select PNG Or JPG Image';
	}
	if(empty($cat_id)){
		$pro_error['cat_id']='Please Select A Category';
	}
	if(empty($p_title)){
		$pro_error['p_title']='Please Enter Product Title';
	}
	if(empty($p_desc)){
		$pro_error['p_desc']='Please Enter Product Description';
	}
	if(empty($p_price)){
		$pro_error['p_price']='Please Enter Product Price';
	}
	if(empty($pro_error)){
		$tem_name=$p_img['tmp_name'];
		$name=str_replace(' ','_' ,date('Y-m-d h-i-s').'_'.$p_img['name']);
		$path='../assets/images/products/'.$name;
		if(move_uploaded_file($tem_name,$path)){
			$date=date('Y-m-d h:i:s');
			$add_cat_sql="INSERT INTO products (cat_id,p_title,p_desc,p_img,p_price,p_date) VALUES ('$cat_id','$p_title','$p_desc','$name','$p_price','$date')";
			$add_cat_result=mysqli_query($con,$add_cat_sql);
			if($add_cat_result){
				$pro_error['add_success']='Product Added Succesfully';
			}
			else{
				$pro_error['add_fail']='Failed To Add Product';
			}
		}
		
	}
	
}
?>
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-12 well">
					<?php
						if(isset($pro_error['add_success']) and $pro_error['add_success']!=''){
							echo '<div class="alert alert-success">'.$pro_error['add_success'].'</div>';
						}
						if(isset($pro_error['add_fail']) and $pro_error['add_fail']!=''){
							echo '<div class="alert alert-danger">'.$pro_error['add_fail'].'</div>';
						}
					?>
					<h4>Add Ptoduct</h4>
					<form action="" method="post" enctype="multipart/form-data">
						<label class="control-label" for="cat">Category</label>
						<?php
						$cat_sql="SELECT * FROM category";
						$cat_result=mysqli_query($con,$cat_sql);
						?>
						<select name="cat_id" class="form-control">
							<option value="">-- Select A category --</option>
							<?php
							while ($cat=mysqli_fetch_assoc($cat_result)) {
							?>
							<option value="<?php echo $cat['c_id']; ?>"><?php echo $cat['cat_name']; ?></option>
							<?php
							}
							?>
						</select>
						<?php
						if(isset($pro_error['cat_id']) and $pro_error['cat_id']!=''){
							echo '<div class="text-danger">'.$pro_error['cat_id'].'</div>';
						}
						?>
						<label for="p_title" class="control-label">Product Title (*)</label>
						<input type="text" class="form-control" name="p_title" id="p_title">
						<?php
						if(isset($pro_error['p_title']) and $pro_error['p_title']!=''){
							echo '<div class="text-danger">'.$pro_error['p_title'].'</div>';
						}
						?>
						<label for="p_desc" class="control-label">Description (*)</label>
						<textarea class="form-control" name="p_desc" id="p_desc"></textarea>
						<?php
						if(isset($pro_error['p_desc']) and $pro_error['p_desc']!=''){
							echo '<div class="text-danger">'.$pro_error['p_desc'].'</div>';
						}
						?>
						<label for="p_price" class="control-label">Price (*)</label>
						<input type="text" class="form-control" name="p_price" id="p_price">
						<?php
						if(isset($pro_error['p_price']) and $pro_error['p_price']!=''){
							echo '<div class="text-danger">'.$pro_error['p_price'].'</div>';
						}
						?>
						<label for="p_img" class="control-label">Image (*)</label>
						<input type="file" class="form-control" name="p_img" id="p_img">
						<?php
						if(isset($pro_error['img_empty']) and $pro_error['img_empty']!=''){
							echo '<div class="text-danger">'.$pro_error['img_empty'].'</div>';
						}
						if(isset($pro_error['img_type']) and $pro_error['img_type']!=''){
							echo '<div class="text-danger">'.$pro_error['img_type'].'</div>';
						}
						?>
						<br>
						<div class="text-right">
							<button type="reset" class="btn btn-primary">Reset</button>
							<button type="submit" name="addpro" class="btn btn-success">Add Product</button>
						</div>
					</form>
				</div>
	    	</div>
          </section>
      </section>
<?php include_once('footer.php'); ?>