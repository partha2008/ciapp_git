		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List of Users</h1>
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
								 <div class="col-sm-6">
									<a href="<?php echo base_url('admin/user-add');?>" class="btn btn-primary">Add User</a>
								 </div>
								 <div class="col-sm-6">
									<form action="<?php echo base_url('admin/user-list');?>" method="GET" role="form">
										<div id="dataTables-example_filter" class="dataTables_filter">
											<label>Search by:<input name="username" type="search" class="form-control input-sm" placeholder="User Name" aria-controls="dataTables-example" id="user-search" value="<?php echo $search_key;?>"></label>
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
											 <th>User Name</th>
											 <th>Email</th>											 
											 <th>Status</th>
											 <th>Actions</th>
										  </tr>
									   </thead>
									   <tbody>
										<?php 
											if(!empty($user_details)){
												foreach($user_details AS $detail){
										?>
										  <tr class="gradeA odd" role="row">
											 <td><?php echo $detail->username;?></td>
											 <td><?php echo $detail->email;?></td>											 
											 <td class="center"><?php echo ($detail->is_active == '1' ? 'Active' : 'Inactive');?></td>
											 <td class="center">
												<a href="<?php echo base_url('admin/user-edit/'.$detail->username);?>" class="btn btn-success" title="Edit">Edit</a>&nbsp;
												<a href="<?php echo base_url('admin/user/user_delete/'.$detail->username);?>" class="btn btn-danger" title="Delete">Delete<a>
											</td>
										  </tr>
										  <?php } 
											}else{
										  ?>
										  <tr class="gradeA odd" role="row"><td colspan="5" style="text-align:center;">No records found</td></tr>
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