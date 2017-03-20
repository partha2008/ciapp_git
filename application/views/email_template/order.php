<div class="rcmBody" style="background: #F2F2F2">
    <div style="padding: 0px; background: #F2F2F2">
        <table style="margin: 0px auto" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
            <tbody>
            <tr>
                <td valign="top" style="padding: 40px 20px">
                    <table cellpadding="0" cellspacing="0" width="90%" style="margin: 0px auto">
                        <tbody>
                        <tr>
                            <td valign="top" bgcolor="#FFFFFF" style="border: 1px solid #dadada; padding: 30px 30px 20px">
                                <div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px; line-height: 1.5em; font-weight: normal; color: #222222">
                                    <?php echo $site_title;?>,
                                    <div style="padding: 15px 0px; font-size: 14px; color: #999999">We have received an order. Here is a copy of your order details.</div>
									<div style="padding: 10px 0px;width:100%;text-align:center;"><img style="max-width:100%;height:auto;" 
									src="https://rewwprintmail.com/app/assets/images/logo1.png" border="0" alt="Logo"></div>
									<?php echo $error_msg;?>									
                                    <div style="padding: 10px 0px">
                                        
										<div style="border: 1px solid #F2F2F2; border-left: none">
                                            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1)">
                                                <tbody>
                                                <tr>
                                                    <td width="2" bgcolor="#a82700"></td>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="padding: 10px 20px">
                                                            <tbody>
                                                            <tr>
                                                                <td align="left" style="padding: 10px 5px 10px 0px" width="105" valign="top">
                                                                    <div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px">
                                                                        <span style="color: #999999; font-size: 14px; font-weight:bold;">
																			<table class="tbl_msg_body_content" cellpadding="2" cellspacing="2" width="100%">
																				<tr>
																					<td style="color: #353535;width:30%;">Order #</td>
																					<td style="color: #999999;width:70%;"><?php echo $order_id;?></td>
																				</tr>
																				<tr>
																					<td style="color: #353535;width:30%;">Name</td>
																					<td style="color: #999999;width:70%;"><?php echo $sender_email;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Postal address</td>
																					<td style="color: #999999;width:70%;"><?php echo $postal_addr;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Phone Number</td>
																					<td style="color: #999999;width:70%;"><?php echo $phone_num;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Cell Number</td>
																					<td style="color: #999999;width:70%;"><?php echo $cell_num;?></td>
																				</tr>
																			</table>
																		</span>
																	</div>
																</td>
															</tr>
															</tbody>
														</table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
										
										<!--  Order Details -->
										<div style="border: 1px solid #F2F2F2; border-left: none;padding-top:10px;">
                                            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1)">
                                                <tbody>												
                                                <tr>
                                                    <td width="2" bgcolor="#a82700"></td>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="padding: 10px 20px">
                                                            <tbody>
                                                            <tr>
                                                                <td align="left" style="padding: 10px 5px 10px 0px" width="105" valign="top">
                                                                    <div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px">
                                                                        <span style="color: #999999; font-size: 14px; font-weight:bold;">
																			<table class="tbl_msg_body_content" cellpadding="2" cellspacing="2" width="100%">
																				<tr>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:10%;">&nbsp;</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Description</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Quantity</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Type</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Paper</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Ink</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Envelope</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Postage</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Each</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Total</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:9%;">Mailing Date</td>
																				</tr>
																				<tr><td>&nbsp;</td></tr>
																				<?php echo $order_details;?>
																				<tr><td>&nbsp;</td></tr>
																			</table>
																		</span>
																	</div>
																</td>
															</tr>
															</tbody>
														</table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
										<!-- Order Details Ends -->
										
										<!--  Product Description -->										
										<div style="border: 1px solid #F2F2F2; border-left: none;padding-top:10px;">
                                            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1)">
                                                <tbody>												
                                                <tr>
                                                    <td width="2" bgcolor="#a82700"></td>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="padding: 10px 20px">
                                                            <tbody>
                                                            <tr>
                                                                <td align="left" style="padding: 10px 5px 10px 0px" width="105" valign="top">
                                                                    <div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px">
                                                                        <span style="color: #999999; font-size: 14px; font-weight:bold;">
																			<table class="tbl_msg_body_content" cellpadding="2" cellspacing="2" width="100%">
																				<tr>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:50%;">Product description</td>
																					<td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;width:50%;">Price</td>
																				</tr>
																				<tr>
																					<td>Sub Total</td>
																					<td>$<?php echo $sub_total;?></td>
																				</tr>
																				<tr>
																					<td>Item Discount</td>
																					<td>$<?php echo $discount;?></td>
																				</tr>
																				<tr>
																					<td style="color: #c0392b;font-weight:700;">Grand Total</td>
																					<td style="color: #c0392b;font-weight:700;"><?php echo $grand_total;?></td>
																				</tr>
																			</table>
																		</span>
																	</div>
																</td>
															</tr>
															</tbody>
														</table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>										
										<!-- Product Description Ends -->										
										
										<!-- Imprint Details -->
										<div style="border: 1px solid #F2F2F2; border-left: none;padding-top:10px;">
                                            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1)">
                                                <tbody>												
                                                <tr>
                                                    <td width="2" bgcolor="#a82700"></td>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="padding: 10px 20px">
                                                            <tbody>
                                                            <tr>
                                                                <td align="left" style="padding: 10px 5px 10px 0px" width="105" valign="top">
                                                                    <div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px">
                                                                        <span style="color: #999999; font-size: 14px; font-weight:bold;">
																			<table class="tbl_msg_body_content" cellpadding="2" cellspacing="2" width="100%">
																				<tr><td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;" colspan="2">Imprint Details</td></tr>
																				<tr><td>&nbsp;</td></tr>
																				<tr>
																					<td style="color: #353535;width:30%;">Order Number</td>
																					<td style="color: #999999;width:70%;"><?php echo $order_id;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Your First Name</td>
																					<td style="color: #999999;width:70%;"><?php echo $first_name;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Your Last Name</td>
																					<td style="color: #999999;width:70%;"><?php echo $last_name;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Company Name</td>
																					<td style="color: #999999;width:70%;"><?php echo $comp_name;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Website</td>
																					<td style="color: #999999;width:70%;"><?php echo $website;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Email Address</td>
																					<td style="color: #999999;width:70%;"><?php echo $email;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Telephone</td>
																					<td style="color: #999999;width:70%;"><?php echo $tel_num;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Special Instructions</td>
																					<td style="color: #999999;width:70%;"><?php echo $instruct;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Return Address</td>
																					<td style="color: #999999;width:70%;"><?php echo $return_addr;?></td>
																				</tr>
																			</table>
																		</span>
																	</div>
																</td>
															</tr>
															</tbody>
														</table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
										<!-- Imprint Details Ends -->
										
										<!-- Mailing Dates -->
										<div style="border: 1px solid #F2F2F2; border-left: none;padding-top:10px;">
                                            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1)">
                                                <tbody>												
                                                <tr>
                                                    <td width="2" bgcolor="#a82700"></td>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="padding: 10px 20px">
                                                            <tbody>
                                                            <tr>
                                                                <td align="left" style="padding: 10px 5px 10px 0px" width="105" valign="top">
                                                                    <div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px">
                                                                        <span style="color: #999999; font-size: 14px; font-weight:bold;">
																			<table class="tbl_msg_body_content" cellpadding="2" cellspacing="2" width="100%">
																				<tr><td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;" colspan="2">Mailling Dates</td></tr>
																				<tr><td>&nbsp;</td></tr>
																				<?php echo $mailing_date;?>
																			</table>
																		</span>
																	</div>
																</td>
															</tr>
															</tbody>
														</table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
										<!-- Mailing Dates -->
										
										<!-- Text & Images -->
										<div style="border: 1px solid #F2F2F2; border-left: none;padding-top:10px;">
                                            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1)">
                                                <tbody>												
                                                <tr>
                                                    <td width="2" bgcolor="#a82700"></td>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="padding: 10px 20px">
                                                            <tbody>
                                                            <tr>
                                                                <td align="left" style="padding: 10px 5px 10px 0px" width="105" valign="top">
                                                                    <div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px">
                                                                        <span style="color: #999999; font-size: 14px; font-weight:bold;">
																			<table class="tbl_msg_body_content" cellpadding="2" cellspacing="2" width="100%">
																				<tr><td style="font-weight:700;color:#fff;background-color:#a82700;padding:10px;" colspan="2">Text And Images</td></tr>
																				<tr><td>&nbsp;</td></tr>
																				<tr>
																					<td style="color: #353535;width:30%;">Logo</td>
																					<td style="color: #999999;width:70%;"><?php echo $logo;?></td>
																				</tr>
																				<tr>
																					<td style="color: #353535;width:30%;">Mailing List</td>
																					<td style="color: #999999;width:70%;"><?php echo $mailing_list;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Letter</td>
																					<td style="color: #999999;width:70%;"><?php echo $letter;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Signature</td>
																					<td style="color: #999999;width:70%;"><?php echo $signature;?></td>
																				</tr>
																				<tr>
																					<td style="vertical-align:top;color: #353535;width:30%;">Other Files</td>
																					<td style="color: #999999;width:70%;"><?php echo $other_files;?></td>
																				</tr>
																			</table>
																		</span>
																	</div>
																</td>
															</tr>
															</tbody>
														</table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
										<!-- Text & Images Ends -->
										
										<div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px; line-height: 2em; color: #C0392B; padding-top: 20px;text-align:center;font-weight:700;">Thank you for your order</div>
										<div style="padding-top: 20px;"><img src="http://www.realestatepostcardsonline.com/cvox/images/logo1.png" border="0" alt="Graphic Connections Group"></div>
										<div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px; line-height: 1.5em; font-weight: normal; color: #222222;padding-top:10px;">Graphic Connections Group, LLC<br>174 Chesterfield Ind. Blvd.<br>Chesterfield, MO 63005<br>800-378-0378<br>636-519-8320<br>Fax: 636-519-8310</div>
										<div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px; line-height: 1.5em; color: #C0392B; padding-top: 10px;"><a href="http://www.gcfrog.com">www.gcfrog.com</a></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
