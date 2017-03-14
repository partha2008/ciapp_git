	<?php echo $head;?>
	
	<div id="wrapper">

		<?php echo $header;?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Update Category</h1>
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
							<?php echo $this->session->userdata('catadd_notification');?>
						</div>
					<?php } 
					$this->session->unset_userdata('has_error');
					$this->session->unset_userdata('catedit_notification');
					?>					
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/category/edit_category');?>" method="POST" role="form" novalidate>
										<div class="form-group">
											<label class="control-label">Category Name <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="categoryname" placeholder="Enter Category Name" value="<?php if(isset($cat_details->categoryname) && $cat_details->categoryname){echo $cat_details->categoryname;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Status</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="1" <?php if(isset($cat_details->is_active)){if($cat_details->is_active){echo 'checked';}}else{echo 'checked';}?>>Active
											</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="0" <?php if(isset($cat_details->is_active)){if(!$cat_details->is_active){echo 'checked';}}?>>Inactive
											</label>
										</div>
										<input type="hidden" name="old_categoryname" value="<?php echo $cat_details->categoryname;?>">
										<input type="hidden" name="code" value="<?php echo $cat_details->code;?>">
										
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