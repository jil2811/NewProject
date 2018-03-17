<div class="footer">
			<small>All rights reserved @ Price List &copy; 2018 .</small>
		</div>
	</div>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/custom.jquery.js"></script>
	<script type="text/javascript">
		$('#btn_user_price').click(function(){
			var p_id=$(this).val();
			var user_price=$('.user_price').val();
			$.ajax({
				type: 'GET',
				url : 'submit_price.php?p_id='+p_id+'&user_price='+user_price,
				dataType: 'html',
				success: function(data){
					console.log(data);
					if(data){
						$('.ajax_result').html('<div class="text-success">Submitted Successfull. You\'ll Be Notify</div>');
					}
					else{
						$('.ajax_result').html('<div class="text-danger">Sorry try Again</div>');
					}
				},
				error: function(){
					$('.text-danger').text('<div class="text-danger">Something went wrong</div>');
				}
			});
		});
	</script>
</body>
</html>