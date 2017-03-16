<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	$config['site_info'] = array(
		"admin_name" => "jc@gcfrog.com",
		"site_name" => "https://rewwprintmail.com", 
		"email_smtp_host" => "smtp.gmail.com",
		"email_smtp_port" => "587",
		"smtp_email" => "logs@nettrackers.net",
		"smtp_password" => "bldpvudabejjrksd",
		"email_cc" => "partha.chowdhury@nettrackers.net, rohit@nettrackers.net, lauren@gcfrog.com, hsk@gcfrog.com, karen@gcfrog.com, denise@gcfrog.com, emma@gcfrog.com, brc@gcfrog.com, alan@gcfrog.com",
		"email_sub_admins" => "orders@gcfrog.com, jc@gcfrog.com, partha.chowdhury@nettrackers.net, rohit@nettrackers.net"
	);
	
	// Bootstrap Pagination Configuration
	$config['pagination']['per_page'] = PAGINATION_PER_PAGE;
	$config['pagination']["uri_segment"] = 3;
	$config['pagination']["num_links"] = 2;
	
	$config['pagination']['use_page_numbers'] = TRUE;
	$config['pagination']['page_query_string'] = TRUE;
	$config['pagination']['query_string_segment'] = 'page';
	$config['pagination']['reuse_query_string'] = TRUE;
	
	$config['pagination']['full_tag_open'] = '<ul class="pagination">';
	$config['pagination']['full_tag_close'] = '</ul>';

	$config['pagination']['first_link'] = '&laquo; First';
	$config['pagination']['first_tag_open'] = '<li class="prev page">';
	$config['pagination']['first_tag_close'] = '</li>';

	$config['pagination']['last_link'] = 'Last &raquo;';
	$config['pagination']['last_tag_open'] = '<li class="next page">';
	$config['pagination']['last_tag_close'] = '</li>';

	$config['pagination']['next_link'] = 'Next &rarr;';
	$config['pagination']['next_tag_open'] = '<li class="next page">';
	$config['pagination']['next_tag_close'] = '</li>';

	$config['pagination']['prev_link'] = '&larr; Previous';
	$config['pagination']['prev_tag_open'] = '<li class="prev page">';
	$config['pagination']['prev_tag_close'] = '</li>';

	$config['pagination']['cur_tag_open'] = '<li class="active"><a href="">';
	$config['cur_tag_close'] = '</a></li>';

	$config['pagination']['num_tag_open'] = '<li class="page">';
	$config['pagination']['num_tag_close'] = '</li>';

	$config['pagination']['anchor_class'] = 'follow_link';
	// Ends
	
	// SMTP configuration
	$config['smtp']['protocol'] = "smtp";
	$config['smtp']['smtp_host'] = "smtp.gmail.com";
	$config['smtp']['smtp_crypto'] = "ssl";
	$config['smtp']['smtp_port'] = "587";
	$config['smtp']['smtp_user'] = "logs@nettrackers.net"; 
	$config['smtp']['smtp_pass'] = "bldpvudabejjrksd";
	$config['smtp']['charset'] = "iso-8859-1";
	$config['smtp']['mailtype'] = "html";
	$config['smtp']['newline'] = "\r\n";
	// Ends
	
	// Price Range for products
	$config['product_price_range'][] = '100 >= Price < 250'; 
	$config['product_price_range'][] = '250 >= Price < 500'; 
	$config['product_price_range'][] = '500 >= Price < 1000'; 
	$config['product_price_range'][] = '1000 >= Price < 2500'; 
	$config['product_price_range'][] = '2500 >= Price < 5000'; 
	$config['product_price_range'][] = '5000 >= Price < 10000'; 
	$config['product_price_range'][] = 'Price >= 10000';
	// Ends
	
	// Months array
	$config['month'][] = 'January'; 
	$config['month'][] = 'February'; 
	$config['month'][] = 'March'; 
	$config['month'][] = 'April'; 
	$config['month'][] = 'May'; 
	$config['month'][] = 'June'; 
	$config['month'][] = 'July'; 
	$config['month'][] = 'August'; 
	$config['month'][] = 'Sepetember'; 
	$config['month'][] = 'October'; 
	$config['month'][] = 'November'; 
	$config['month'][] = 'December'; 
	// Ends
	
	// Mailing Date Status
	$config['mailing_dates_status'][0] = 'Awaiting Client Proof approval'; 
	$config['mailing_dates_status'][1] = 'Proof aproved Awaiting'; 
	$config['mailing_dates_status'][2] = 'Mail Sent'; 
	$config['mailing_dates_status'][3] = 'Refunded';
	// Ends