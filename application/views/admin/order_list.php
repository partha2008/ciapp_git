		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
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
								 <div class="col-sm-12">
									<?php $sess_notify = $this->session->userdata('has_error');
									if(isset($sess_notify) & !$sess_notify){?>
									<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<?php echo $this->session->userdata('resend_notification');?>
									</div>
									<?php } ?>
									<?php if(isset($sess_notify) & $sess_notify){?>
									<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<?php echo $this->session->userdata('resend_notification');?>
									</div>
									<?php } 
										$this->session->unset_userdata('has_error');
										$this->session->unset_userdata('resend_notification');						
									?>								 
									<form action="<?php echo base_url('admin/'.$redirect);?>" method="GET" role="form">
										<div id="dataTables-example_filter" class="dataTables_filter">
											<label>Search by: <input name="searchname" type="search" class="form-control input-sm" placeholder="Name" aria-controls="dataTables-example" value="<?php echo $search_key;?>"></label>
											<button type="submit" class="btn btn-primary">Search</button>
										</div>
									</form>
								 </div>
							  </div>
							  <div class="row">
								 <div class="col-sm-12">
									<div class="table-responsive">
										<table width="100%" class="table table-striped table-bordered table-hover no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
										   <thead>
											  <tr role="row">
												 <th>Name</th>								 
												 <th>Order Number</th>								 
												 <th>Email</th>								 
												 <th>Item</th>								 
												 <th>Quantity</th>
												 <th>Total</th>
												 <th>Mail Sent</th>
												 <th>Status</th>
												 <th>Ordered Date</th>
												 <th>Action</th>
											  </tr>
										   </thead>
										   <tbody>
											<?php 
											if(count($order_list) > 0){ 
												$arr = array();
												foreach($order_list AS $list) {
												
													if(!in_array($list->orderid, $arr)){
														echo '<tr class="gradeA odd" role="row" style="text-align:right;"><td colspan="10"><a href="'.base_url('admin/order/resend_mail_to_user/'.$list->order_id).'" class="btn btn-primary">Send Email to User</a></td></tr>';
													}
													$arr[] = $list->orderid;
													
													switch ($list->status) {
														case "0":
															$ord_status = 'Awaiting Client Proof approval';
															$color_code = '#A94442';
															break;
														case "1":
															$ord_status = 'Proof aproved Awaiting mail Drop';
															$color_code = '#8a6d3b';
															break;
														case "2":
															$ord_status = 'Mail Sent';
															$color_code = '#3c763d';
															break;
														default:
															$ord_status = 'Refunded';
															$color_code = '#31708f';
													}
													
													if($list->is_order_mail_sent == 'Y'){
														$mail_status = 'Sent';
														$color_cls = '#3c763d';
													}else{
														$mail_status = 'Not Sent';
														$color_cls = '#a94442';
													}
												?>
											  <tr class="gradeA odd" role="row">
												 <td><?php echo $list->first_name.'&nbsp;'.$list->last_name;?></td>		 
												 <td><?php echo $list->orderid;?></td>		 
												 <td><?php echo $list->email;?></td>	
												 <td><?php echo $list->item;?></td>	
												 <td><?php echo $list->quantity;?></td>	
												 <td>$<?php echo $list->total;?></td>	
												 <td style="color: <?php echo $color_cls;?>"><?php echo $mail_status;?></td>	
												 <td class="center" style="color: <?php echo $color_code;?>"><?php echo $ord_status;?></td>
												 <td><?php echo date("m-d-Y", $list->date_added);?></td>											 
												<td class="center"><a class="btn btn-success" title="Edit" href="<?php echo base_url('admin/order-edit/'.$list->mailing_date_id);?>">Edit</a></td>
											  </tr>
											  <?php } ?>
											  <?php }else{ ?>
											  <tr class="gradeA odd" role="row"><td colspan="10" style="text-align:center;">No records found</td></tr>
											  <?php } ?>
										   </tbody>
										</table>
									</div>
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
