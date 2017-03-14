	<?php echo $head; ?>
	
	<div id="wrapper">

		<?php echo $header; ?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Add User</h1>
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
							<?php echo $this->session->userdata('useradd_notification');?>
						</div>
					<?php } 
					$this->session->unset_userdata('has_error');
					$this->session->unset_userdata('useradd_notification');
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/user/add_user');?>" method="POST" role="form" novalidate>
										<div class="form-group">
											<label class="control-label">Username <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="username" placeholder="Enter Username" value="<?php if(isset($user_details->username) && $user_details->username){echo $user_details->username;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Password <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="password" name="password" placeholder="Enter Password" value="">
										</div>
										<div class="form-group">
											<label class="control-label">Email Address <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="email" name="email" placeholder="Enter Email" value="<?php if(isset($user_details->email) && $user_details->email){echo $user_details->email;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">User Discount</label>
											<input class="form-control" type="text" name="user_discount" placeholder="Enter Discount" value="<?php if(isset($user_details->user_discount) && $user_details->user_discount){echo $user_details->user_discount;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Status</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="1" <?php if(isset($user_details->is_active)){if($user_details->is_active){echo 'checked';}}else{echo 'checked';}?>>Active
											</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="0" <?php if(isset($user_details->is_active)){if(!$user_details->is_active){echo 'checked';}}?>>Inactive
											</label>
										</div>
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