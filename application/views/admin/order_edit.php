	<?php echo $head;?>
	
	<div id="wrapper">

		<?php echo $header;?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Update Order</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			
			<div class="row">
				<form role="form" action="<?php echo base_url('admin/order/edit_order');?>" method="POST" enctype="multipart/form-data">
					<div class="col-lg-12">
						<?php 
							$sess_notify = $this->session->userdata('has_error');
							if(isset($sess_notify) & $sess_notify){
						?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->userdata('orderedit_notification');?>
						</div>
						<?php } 
							$this->session->unset_userdata('has_error');
							$this->session->unset_userdata('orderedit_notification');
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								Imprint Information
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>First Name</label>
											<input class="form-control" type="text" name="orders_firstName" value="<?php echo $order_details->firstName;?>" placeholder="First Name">
										</div>                                        
										<div class="form-group">
											<label>Company Name</label>
											<input class="form-control" type="text" name="orders_comp_name" value="<?php echo $order_details->comp_name;?>" placeholder="Company Name">
										</div>
										<div class="form-group">
											<label>Telephone Number</label>
											<input class="form-control" type="text" name="orders_tel_num" value="<?php echo $order_details->tel_num;?>" placeholder="Telephone Number">
										</div>	
										<div class="form-group">
											<label>Special Instructions</label>
											<textarea class="form-control" name="orders_instruct" placeholder="Special Instructions"><?php echo $order_details->instruct;?></textarea>
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								
									<div class="col-lg-6">
										<div class="form-group">
											<label>Last Name</label>
											<input class="form-control" type="text" name="orders_lastName" value="<?php echo $order_details->lastName;?>" placeholder="Last Name">
										</div>
										<div class="form-group">
											<label>Website</label>
											<input class="form-control" type="text" name="orders_website" value="<?php echo $order_details->website;?>" placeholder="Website">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input class="form-control" type="email" name="orders_email" value="<?php echo $order_details->email;?>" placeholder="Email">
										</div>	
										<div class="form-group">
											<label>Return Address</label>
											<textarea class="form-control" name="orders_return_addr" placeholder="Return Address"><?php echo $order_details->return_addr;?></textarea>
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								</div>
								<!-- /.row (nested) -->
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
						
						<div class="panel panel-default">
							<div class="panel-heading">
								Payment Information
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>First Name</label>
											<input class="form-control" type="text" name="orders_first_name" value="<?php echo $order_details->first_name;?>" placeholder="First Name">
										</div>                                        
										<div class="form-group">
											<label>Street Address</label>
											<textarea class="form-control" name="orders_billingAddress" placeholder="Street Address"><?php echo $order_details->billingAddress;?></textarea>
										</div>
										<div class="form-group">
											<label>State</label>
											<input class="form-control" type="text" name="orders_billing_state" value="<?php echo $order_details->billing_state;?>" placeholder="State">
										</div>	
										<div class="form-group">
											<label>Phone Number</label>
											<input class="form-control" type="text" name="orders_phone_num" value="<?php echo $order_details->phone_num;?>" placeholder="Phone Number">
										</div>
										<div class="form-group">
											<label>Card Number</label>
											<input class="form-control" type="text" name="orders_card_no" value="<?php echo $order_details->card_no;?>" placeholder="Card Number">
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								
									<div class="col-lg-6">
										<div class="form-group">
											<label>Last Name</label>
											<input class="form-control" type="text" name="orders_last_name" value="<?php echo $order_details->lastName;?>" placeholder="Last Name">
										</div>
										<div class="form-group">
											<label>City</label>
											<input class="form-control" type="text" name="orders_billing_city" value="<?php echo $order_details->billing_city;?>" placeholder="City">
										</div>
										<div class="form-group">
											<label>Zip/Postal Code</label>
											<input class="form-control" type="text" name="orders_zip" value="<?php echo $order_details->zip;?>" placeholder="Zip/Postal Code">
										</div>	
										<div class="form-group">
											<label>Cell Number</label>
											<input class="form-control" type="text" name="orders_cell_num" value="<?php echo $order_details->cell_num;?>" placeholder="Cell Number">
										</div>										
										<div class="form-group form-inline">
											<label style="display:block;">Expiration</label>
											<select class="form-control" name="orders_month">
												<option value="">Select Month</option>
												<?php foreach($month_arr AS $key => $month){ ?>
													<option value="<?php echo $key+1;?>" <?php if($key+1 == $order_details->month){echo 'selected';}?>><?php echo $month;?></option>
												<?php } ?>
											</select>
											<select class="form-control" name="orders_year">
												<option value="">Select Year</option>
												<?php foreach($year_arr AS $year){ 
													$index = substr( $year, -2);
												?>
													<option value="<?php echo $index;?>" <?php if($index == $order_details->year){echo 'selected';} ?>><?php echo $year;?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								</div>
								<!-- /.row (nested) -->
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
						
						<div class="panel panel-default">
							<div class="panel-heading">
								Uploaded Files
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Logo</label>
											<?php if(isset($uploaded_files['logo']) && $uploaded_files['logo']){?>
												<p><a href="<?php echo $uploaded_files['logo'];?>" download>Download</a></p>
											<?php } ?>
										</div>
										<div class="form-group">
											<label>Letter</label>
											<?php if(isset($uploaded_files['letter']) && $uploaded_files['letter']){?>
												<p><a href="<?php echo $uploaded_files['letter'];?>" download>Download</a></p>
											<?php } ?>
										</div>
										<div class="form-group">
											<label>Other Files</label>
											<?php if(isset($uploaded_files['otherfiles']) && $uploaded_files['otherfiles']){?>
												<p><a href="<?php echo $uploaded_files['otherfiles'];?>" download>Download</a></p>
											<?php } ?>
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								
									<div class="col-lg-6">
										<div class="form-group">
											<label>Mailing List</label>
											<?php if(isset($uploaded_files['mailinglist']) && $uploaded_files['mailinglist']){?>
												<p><a href="<?php echo $uploaded_files['mailinglist'];?>" download>Download</a></p>
											<?php } ?>
										</div>
										<div class="form-group">
											<label>Signature</label>
											<?php if(isset($uploaded_files['signature']) && $uploaded_files['signature']){?>
												<p><a href="<?php echo $uploaded_files['signature'];?>" download>Download</a></p>
											<?php } ?>
										</div>
										<div class="form-group">
											<label>Product</label>
											<?php if(isset($uploaded_files['product_url']) && $uploaded_files['product_url']){?>
												<p><a href="<?php echo $uploaded_files['product_url'];?>" download>Download</a></p>
											<?php } ?>
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								</div>
								<!-- /.row (nested) -->
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
						
						<div class="panel panel-default">
							<div class="panel-heading">
								Item Details
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Mailer</label>
											<input class="form-control" type="text" name="item_mailer" value="<?php echo $order_details->mailer;?>" disabled>
										</div>
										<div class="form-group">
											<label>Quantity</label>
											<input class="form-control" type="text" name="item_quantity" value="<?php echo $order_details->quantity;?>" placeholder="Quantity">
										</div>
										<div class="form-group">
											<label>Paper</label>
											<input class="form-control" type="text" name="item_paper" value="<?php echo $order_details->paper;?>" placeholder="Paper">
										</div>
										<div class="form-group">
											<label>Envelope</label>
											<textarea class="form-control" name="item_envelope" placeholder="Envelope"><?php echo $order_details->envelope;?></textarea>
										</div>
										<div class="form-group">
											<label>Per</label>
											<input class="form-control" type="text" name="item_per" value="<?php echo $order_details->per;?>" placeholder="Per">
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								
									<div class="col-lg-6">
										<div class="form-group">
											<label>Item</label>
											<input class="form-control" type="text" name="item_item" value="<?php echo $order_details->item;?>" placeholder="Item">
										</div>
										<div class="form-group">
											<label>Type</label>
											<input class="form-control" type="text" name="item_type" value="<?php echo $order_details->type;?>" placeholder="Type">
										</div>
										<div class="form-group">
											<label>Ink</label>
											<input class="form-control" type="text" name="item_ink" value="<?php echo $order_details->ink;?>" placeholder="Ink">
										</div>
										<div class="form-group">
											<label>Postage</label>
											<textarea class="form-control" name="item_postage" placeholder="Postage"><?php echo $order_details->postage;?></textarea>
										</div>
										<div class="form-group">
											<label>Total</label>
											<input class="form-control" type="text" name="item_total" value="<?php echo $order_details->total;?>" placeholder="Total">
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								</div>
								<!-- /.row (nested) -->
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
						
						<div class="panel panel-default">
							<div class="panel-heading">
								Order Status
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Order Status</label>
											<select class="form-control" name="item_status">
												<option value="">Select Status</option>
												<option value="0" <?php if($order_details->orderstat == 0){echo 'selected';}?>>Awaiting Client Proof approval</option>
												<option value="1" <?php if($order_details->orderstat == 1){echo 'selected';}?>>Proof aproved Awaiting mail Drop</option>
												<option value="2" <?php if($order_details->orderstat == 2){echo 'selected';}?>>Mail Sent</option>
												<option value="3" <?php if($order_details->orderstat == 3){echo 'selected';}?>>Refunded</option>
											</select>
										</div>
										<div class="form-group">
											<label>Proof Sent Date</label>
											<input id="proofsent_date" class="form-control" type="text" name="item_proofsent_date" value="<?php echo date("m-d-Y", $order_details->proofsent_date);?>" placeholder="mm-dd-yyyy">
										</div>
										<div class="form-group">
											<label>Actual Mail Date</label>
											<input id="mail_date" class="form-control" type="text" name="item_date" value="<?php echo date("m-d-Y", $order_details->date);?>" placeholder="mm-dd-yyyy">
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								
									<div class="col-lg-6">
										<div class="form-group">
											<label>Ordered Date</label>
											<input id="created_date" class="form-control" type="text" name="orders_date" value="<?php echo date("m-d-Y", $order_details->date_added);?>" placeholder="mm-dd-yyyy">
										</div>
										<div class="form-group">
											<label>Proof Approved Date</label>
											<input id="proofapproved_date" class="form-control" type="text" name="item_proofapproved_date" value="<?php echo date("m-d-Y", $order_details->proofapproved_date);?>" placeholder="mm-dd-yyyy">
										</div>
										<div class="form-group">
											<label>Proof PDF</label>
											<input type="file" name="item_proof_pdf">
											<?php if($order_details->proof_pdf){ ?>
												<p><a href="<?php echo $order_details->proof_pdf;?>" download>Download</a></p>
											<?php } ?>
										</div>
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
					
					<div class="panel-body">
						<input type="hidden" name="order_id" value="<?php echo $order_details->order_id;?>">
						<input type="hidden" name="mailing_date_id" value="<?php echo $order_details->mailing_date_id;?>">
						<button type="submit" class="btn btn-primary">Save Changes</button>
					</div>
					
				</form>
            </div>
			
		</div>
		<!-- /.page-wrapper -->
	</div>
	<!-- /#wrapper -->
	
	<?php echo $footer;?>