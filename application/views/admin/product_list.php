		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List of Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
						<div class="panel-body">
							<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							  <div class="row">
								 <div class="col-sm-2">
									<a href="<?php echo base_url('admin/product-add');?>" class="btn btn-primary">Add Product</a>
								 </div>
								 <div class="col-sm-10">
									<form action="<?php echo base_url('admin/product-list');?>" method="GET" role="form">
										<div id="dataTables-example_filter" class="dataTables_filter">
											<label>Search by: <select name="category_id" class="form-control input-sm"><option value="">Select Category</option>
											<?php if(count($cat_list) > 0){ ?>
												<?php foreach($cat_list AS $list){?>
													<option value="<?php echo $list->category_id;?>" 
													<?php if($list->category_id == $search_cat_id){echo 'selected';}?>><?php echo $list->categoryname;?></option>
												<?php } ?>
											<?php } ?>
											</select><input name="productname" type="search" class="form-control input-sm" placeholder="Product Name" aria-controls="dataTables-example" id="product-search" value="<?php echo $search_key;?>"></label>
											<button type="submit" class="btn btn-primary">Search</button>
										</div>
									</form>
								 </div>
							  </div>
							  <div class="row">
								 <div class="col-sm-12">
									<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
									   <thead>
										  <tr role="row">
											 <th>Product Name</th>								 
											 <th>Code</th>								 
											 <th>Category</th>								 
											 <th>&nbsp;</th>								 
											 <th>Status</th>
											 <th>Actions</th>
										  </tr>
									   </thead>
									   <tbody>
									    <?php if(count($product_list) > 0){ ?>
										<?php foreach($product_list AS $list) {?>
										  <tr class="gradeA odd" role="row">
											 <td><?php echo $list->productname;?></td>		 
											 <td><?php echo $list->code;?></td>		 
											 <td><?php echo $list->categoryname;?></td>	
											 <?php if($list->imagepathname && file_exists(UPLOAD_RELATIVE_PRODUCT_PATH.$list->imagename)){ ?>
											 <td><img src="<?php echo UPLOAD_PRODUCT_PATH.$list->imagename;?>" width="80"></td>	
											 <?php }else{ ?>
											 <td>&nbsp;</td>
											 <?php } ?>
											 <td class="center"><?php echo ($list->is_active == 1) ? 'Active' : 'Inactive';?></td>
											 <td class="center">
												<a title="Edit" href="<?php echo base_url('admin/product-edit/'.$list->code);?>" class="btn btn-success">Edit</a>&nbsp;
												<a title="Delete" href="<?php echo base_url('admin/product/product_delete/'.$list->code);?>" class="btn btn-danger">Delete<a>												
											</td>
										  </tr>
										  <?php } ?>
										  <?php }else{ ?>
										  <tr class="gradeA odd" role="row"><td colspan="6" style="text-align:center;">No records found</td></tr>
										  <?php } ?>
									   </tbody>
									</table>
								 </div>
							  </div>
							  <div class="pagination" style="float:right;">            
								<?php echo $pagination ?>            
							</div>
							</div>
							<!-- /.table-responsive -->
							</div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>

		</div>
		<!-- /#wrapper -->
		
		<?php echo $footer; ?>