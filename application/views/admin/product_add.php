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
														<option value="<?php echo $list->category_id;?>" <?php if(isset($product_details->category_id)){if($list->category_id == $product_details->category_id){echo 'selected';}}?> ><?php echo $list->categoryname;?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Product Name <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="productname" placeholder="Enter Product Name" value="<?php echo (isset($product_details->productname) && $product_details->productname) ? $product_details->productname : '';?>">
										</div>
										<div class="form-group">
											<label class="control-label">Description</label>
											<textarea name="description" class="form-control" placeholder="Enter Description"><?php echo (isset($product_details->description) && $product_details->description) ? $product_details->description : '';?></textarea>
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
												if(!empty($product_details->price)){
													$price_arr = $product_details->price;
												}
												foreach($product_price_range AS $key => $range) {?>
													<div class="col-md-3">
														<label class="help-block">[<?php echo $range;?>]</label>
														<input class="form-control" style="margin: 0 5px 10px 0" type="number" placeholder="<?php echo $range;?>" name="price[]" min="0" value="<?php echo (isset($price_arr[$key])) ? $price_arr[$key] : '';?>">
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
											<input class="form-control" type="number" name="order_id" min="0" value="<?php echo (isset($product_details->order_id) && $product_details->order_id) ? $product_details->order_id : '';?>">
										</div>
										<div class="form-group">
											<label class="control-label">Status</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="1" <?php if(isset($product_details->is_active)){if($product_details->is_active){echo 'checked';}}else{echo 'checked';}?>>Active
											</label>
											<label class="radio-inline">
												<input type="radio" name="is_active" value="0" <?php if(isset($product_details->is_active)){if(!$product_details->is_active){echo 'checked';}}else{echo 'checked';}?>>Inactive
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