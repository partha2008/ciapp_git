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
		
		$sql = "SELECT ".TABLE_MAILING_DATE.".mailing_date_id, ".TABLE_MAILING_DATE.".item, ".TABLE_MAILING_DATE.".quantity, ".TABLE_MAILING_DATE.".proof_pdf, ".TABLE_MAILING_DATE.".proofapproved_date, ".TABLE_MAILING_DATE.".proofsent_date, ".TABLE_MAILING_DATE.".total, ".TABLE_MAILING_DATE.".date, ".TABLE_MAILING_DATE.".status, ".TABLE_ORDER.".order_id, ".TABLE_ORDER.".orderid, ".TABLE_ORDER.".email, ".TABLE_ORDER.".first_name, ".TABLE_ORDER.".last_name, ".TABLE_ORDER.".date_added FROM ".TABLE_MAILING_DATE." LEFT JOIN ".TABLE_ORDER." ON ".TABLE_MAILING_DATE.".order_id = ".TABLE_ORDER.".order_id WHERE ".TABLE_ORDER.".status='".$cond['status']."' ".$whr." LIMIT ".$start.", ".$per_page;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function grab_total_order($cond = array(), $limit = array(), $like = array()){
		$whr = "";
		if(!empty($like)){
			$whr .= " AND (".TABLE_ORDER.".first_name LIKE '%".$like['searchname']."%' OR ".TABLE_ORDER.".last_name LIKE '%".$like['searchname']."%')";
		}
		$where = '';
		if(!empty($cond)){
			$cnt = 1;
			foreach($cond AS $key => $val){
				if($cnt == count($cond)){
					$where .= TABLE_ORDER.'.'.$key."=".$val;
				}else{
					$where .= TABLE_ORDER.'.'.$key."=".$val." AND ";
				}				
				
				$cnt++;
			}
		}
		
		$sql = "SELECT ".TABLE_MAILING_DATE.".mailing_date_id, ".TABLE_MAILING_DATE.".item, ".TABLE_MAILING_DATE.".quantity, ".TABLE_MAILING_DATE.".proof_pdf, ".TABLE_MAILING_DATE.".proofapproved_date, ".TABLE_MAILING_DATE.".proofsent_date, ".TABLE_MAILING_DATE.".total, ".TABLE_MAILING_DATE.".date, ".TABLE_MAILING_DATE.".status, ".TABLE_ORDER.".order_id, ".TABLE_ORDER.".orderid, ".TABLE_ORDER.".email, ".TABLE_ORDER.".first_name, ".TABLE_ORDER.".last_name, ".TABLE_ORDER.".date_added FROM mailing_dates LEFT JOIN ".TABLE_ORDER." ON mailing_dates.order_id = ".TABLE_ORDER.".order_id WHERE ".$where.$whr." ORDER BY ".TABLE_ORDER.".date_added DESC";
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function get_order_details_by_item($cond = array()){
		$sql = "SELECT *, ".TABLE_ORDER.".status as ordermode, ".TABLE_ORDER.".order_id as orderids, ".TABLE_MAILING_DATE.".status as orderstat FROM ".TABLE_MAILING_DATE." INNER JOIN ".TABLE_ORDER." ON ".TABLE_MAILING_DATE.".order_id = ".TABLE_ORDER.".order_id LEFT JOIN ".TABLE_UPLOADED_FILE." ON ".TABLE_ORDER.".order_id=".TABLE_UPLOADED_FILE.".order_id WHERE ".TABLE_MAILING_DATE.".mailing_date_id=".$cond['mailing_date_id'];
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function get_order($cond = array(), $like = array(), $limit = array()){
		if(!empty($cond)){
			$this->db->where($cond);
		}		
		if(!empty($like)){
			$this->db->like($like);
		}
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
			$this->db->limit($per_page, $start);
		}
		$this->db->order_by('date_added','desc');		
		$query = $this->db->get(TABLE_ORDER);
		
		return $query->result()[0];
	}
	
	public function grab_mailing_dates($cond = array(), $like = array(), $limit = array()){
		if(!empty($cond)){
			$this->db->where($cond);
		}		
		if(!empty($like)){
			$this->db->like($like);
		}
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
			$this->db->limit($per_page, $start);
		}	
		$query = $this->db->get(TABLE_MAILING_DATE);
		
		return $query->result();
	}
	
	public function grab_uploaded_files($cond = array(), $like = array(), $limit = array()){
		if(!empty($cond)){
			$this->db->where($cond);
		}		
		if(!empty($like)){
			$this->db->like($like);
		}
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
			$this->db->limit($per_page, $start);
		}	
		$query = $this->db->get(TABLE_UPLOADED_FILE);
		
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
	
	public function insert_order($data = array()){

		$this->db->insert(TABLE_ORDER, $data); 
		
		return $this->db->insert_id();
	}
	
	public function insert_mailing_dates($data = array()){

		$this->db->insert(TABLE_MAILING_DATE, $data); 
		
		return $this->db->insert_id();
	}
	
	public function insert_uploaded_files($data = array()){

		$this->db->insert(TABLE_UPLOADED_FILE, $data); 
		
		return $this->db->insert_id();
	}
	
	public function insert_log($data = array()){

		$this->db->insert(TABLE_LOG, $data); 
		
		return $this->db->insert_id();
	}
}