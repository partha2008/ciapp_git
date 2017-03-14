<?php
class Orderdata extends CI_Model {
	
	public function grab_order($cond = array(), $limit = array(), $like = array()){
		
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
		}
		
		$whr = "";
		if(!empty($like)){
			$whr .= " AND (orders.first_name LIKE '%".$like['searchname']."%' OR orders.last_name LIKE '%".$like['searchname']."%')";
		}
		
		$sql = "SELECT mailing_dates.mailing_date_id, mailing_dates.item, mailing_dates.quantity, mailing_dates.proof_pdf, mailing_dates.proofapproved_date, mailing_dates.proofsent_date, mailing_dates.total, mailing_dates.date, mailing_dates.status, orders.order_id, orders.orderid, orders.email, orders.first_name, orders.last_name, orders.date_added FROM mailing_dates LEFT JOIN orders ON mailing_dates.order_id = orders.order_id WHERE orders.status='".$cond['status']."' ".$whr."ORDER BY orders.date_added DESC LIMIT ".$start.", ".$per_page;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function grab_total_order($cond = array(), $limit = array(), $like = array()){
		$whr = "";
		if(!empty($like)){
			$whr .= " AND (orders.first_name LIKE '%".$like['searchname']."%' OR orders.last_name LIKE '%".$like['searchname']."%')";
		}
		
		$sql = "SELECT mailing_dates.mailing_date_id, mailing_dates.item, mailing_dates.quantity, mailing_dates.proof_pdf, mailing_dates.proofapproved_date, mailing_dates.proofsent_date, mailing_dates.total, mailing_dates.date, mailing_dates.status, orders.orderid, orders.email, orders.first_name, orders.last_name, orders.date_added FROM mailing_dates LEFT JOIN orders ON mailing_dates.order_id = orders.order_id WHERE orders.status='".$cond['status']."' ".$whr." ORDER BY orders.date_added DESC";
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function get_order_details_by_item($cond = array()){
		$sql = "SELECT *, orders.status as ordermode, orders.order_id as orderids, mailing_dates.status as orderstat FROM `mailing_dates` INNER JOIN `orders` ON mailing_dates.order_id = orders.order_id LEFT JOIN `uploaded_files` ON orders.order_id=uploaded_files.order_id WHERE mailing_dates.mailing_date_id=".$cond['mailing_date_id'];
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function update_order($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_ORDER, $data); 
		
		return true;
	}
	
	public function update_mailing_dates($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_MAILING_DATE, $data); 
		
		return true;
	}
	
	public function delete_order($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_ORDER);
		
		return true;
	}
}