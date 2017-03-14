	<?php echo $head;?>
	
	<div id="wrapper">

		<?php echo $header;?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Add Product</h1>
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
							<?php echo $this->session->userdata('productadd_notification');?>
						</div>
					<?php } 
						$this->session->unset_userdata('has_error');
						$this->session->unset_userdata('productadd_notification');
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/product/add_product');?>" method="POST" role="form" enctype="multipart/form-data" novalidate>
										<div class="form-group">
											<label class="control-label">Category <span style="color:#a94442;">*</span></label>
											<select name="category_id" class="form-control">
												<option value="">Select Category</option>
												<?php if(count($cat_list) > 0){ ?>
													<?php foreach($cat_list AS $list) {?>
														<option value="<?php echo $list->category_id;?>"><?php echo $list->categoryname;?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Product Name <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="productname" placeholder="Enter Product Name" value="">
										</div>
										<div class="form-group">
											<label class="control-label">Description</label>
											<textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
										</div>
										<div class="form-group">
											<label class="control-label">Upload Product</label>
											<input type="file" name="product">
										</div>
										<div class="form-group">
											<label class="control-label">Price Range <span style="color:#a94442;">*</span></label>
											<div class="form-inline">
											  <div class="row">
											  <?php 
											  if(count($product_price_range) > 0){ 
												foreach($product_price_range AS $range) {?>
													<div class="col-md-3">
														<label class="help-block">[<?php echo $range;?>]</label>
														<input class="form-control" style="margin: 0 5px 10px 0" type="number" placeholder="<?php echo $range;?>" name="price[]" min="0" value="">
													</div>
													<?php
													}
											    }
											  ?>
												</div>
                                            </div>
										</div>
										<div class="form-group">
											<label class="control-label">Order</label>
											<input class="form-control" type="number" name="order_id" min="0" value="">
										</div>
										<div class="form-group">
											<label class="control-label">Status</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="1" checked>Active
											</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="0">Inactive
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