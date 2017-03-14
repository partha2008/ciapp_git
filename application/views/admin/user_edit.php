	<?php echo $head; ?>
	
	<div id="wrapper">

		<?php echo $header; ?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Update User</h1>
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
						<?php echo $this->session->userdata('useredit_notification');?>
					</div>
					<?php }
						$this->session->unset_userdata('has_error');
						$this->session->unset_userdata('useredit_notification');
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/user/edit_user');?>" method="POST" role="form" novalidate>
										<div class="form-group">
											<label class="control-label">Username <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="username" placeholder="Enter Username" value="<?php echo $user_details->username;?>">
										</div>										
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" name="password" type="text" value="<?php if(isset($user_details->original_password)){echo $user_details->original_password;}else{echo $user_details->password;}?>" readonly>
										</div>
										<div class="form-group">
											<label class="control-label">Reset Password</label>
											<input class="form-control" type="password" name="reset_password" placeholder="Enter Password" value="">
										</div>										
										<div class="form-group">
											<label class="control-label">Email Address <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="email" name="email" placeholder="Enter Email" value="<?php echo $user_details->email;?>">
										</div>
										<div class="form-group">
											<label class="control-label">User Discount</label>
											<input class="form-control" type="text" name="user_discount" placeholder="Enter Discount" value="<?php echo $user_details->user_discount;?>">
										</div>
										<div class="form-group">
											<label class="control-label">Status</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="1" <?php if($user_details->is_active == 1){echo 'checked';}?> >Active
											</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="0" <?php if($user_details->is_active == 0){echo 'checked';}?> >Inactive
											</label>
										</div>
										
										<input type="hidden" name="user_id" value="<?php echo $user_details->user_id;?>">
										<input type="hidden" name="old_username" value="<?php echo $user_details->username;?>">
										<input type="hidden" name="old_email" value="<?php echo $user_details->email;?>">
										
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