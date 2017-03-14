	<?php echo $head;?>
	
	<div id="wrapper">

		<?php echo $header;?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Add Coupon</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">						
					<?php 
						$sess_notify = $this->session->userdata('has_error');
						if(isset($sess_notify) & $sess_notify){
					?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo $this->session->userdata('couponedit_notification');?>
					</div>
					<?php } 
						$this->session->unset_userdata('has_error');
						$this->session->unset_userdata('couponedit_notification');
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/coupon/edit_coupon');?>" method="POST" role="form" novalidate>
										<div class="form-group">
											<label class="control-label">Coupon Code <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="coupon_code" placeholder="Enter Coupon Code" value="<?php if(isset($coupon_details->coupon_code) && $coupon_details->coupon_code){echo $coupon_details->coupon_code;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Discount <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="discount" placeholder="Enter Discount" value="<?php if(isset($coupon_details->discount) && $coupon_details->discount){echo $coupon_details->discount;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Status</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="1" <?php if(isset($coupon_details->is_active)){if($coupon_details->is_active){echo 'checked';}}else{echo 'checked';}?>>Active
											</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="0" <?php if(isset($coupon_details->is_active)){if(!$coupon_details->is_active){echo 'checked';}}else{echo 'checked';}?>>Inactive
											</label>
										</div>
										<input type="hidden" name="old_coupon_code" value="<?php echo $coupon_details->coupon_code;?>"> 
										<input type="hidden" name="coupon_id" value="<?php echo $coupon_details->coupon_id;?>"> 
										<button type="submit" class="btn btn-primary">Save Changes</button>
									</form>
								</div>
								<!-- /.col-lg-6 (nested) -->									
							</div>
							<!-- /.row (nested) -->
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.page-wrapper -->
	</div>
	<!-- /#wrapper -->
	
	<?php echo $footer; ?>