<?php
class Productdata extends CI_Model {
	
	public function grab_product($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_PRODUCT);
		
		return $query->result();
	}
	
	public function grab_product_join_category($cond = array(), $like = array(), $limit = array()){		
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
		}
		$likes = '';
		if(!empty($like)){
			if($like['category_id']){
				$likes .= " AND ".TABLE_PRODUCT.".category_id = ".$like['category_id'];
			}
			if($like['productname']){
				$likes .= " AND ".TABLE_PRODUCT.".productname LIKE '%".$like['productname']."%'";
			}
		}
		
		$sql = "SELECT *, ".TABLE_CATEGORY.".code as cat_code, ".TABLE_PRODUCT.".code as product_code, ".TABLE_CATEGORY.".date_added as cat_date_added, ".TABLE_PRODUCT.".date_added as prd_date_added FROM ".TABLE_CATEGORY." LEFT JOIN ".TABLE_PRODUCT." ON ".TABLE_PRODUCT.".category_id = ".TABLE_CATEGORY.".category_id WHERE ".TABLE_PRODUCT.".product_id <> '' ".$likes." ORDER BY ".TABLE_PRODUCT.".date_added DESC LIMIT ".$start.", ".$per_page;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function grab_product_join_category_all($cond = array(), $like = array()){		
		
		$likes = '';
		if(!empty($like)){
			if($like['category_id']){
				$likes .= " AND ".TABLE_PRODUCT.".category_id = ".$like['category_id'];
			}
			if($like['productname']){
				$likes .= " AND ".TABLE_PRODUCT.".productname LIKE '%".$like['productname']."%'";
			}
		}
		
		$sql = "SELECT ".TABLE_CATEGORY.".code as cat_code, ".TABLE_PRODUCT.".code as code, ".TABLE_PRODUCT.".description as description, ".TABLE_PRODUCT.".imagename as imagename, ".TABLE_PRODUCT.".price as price, ".TABLE_PRODUCT.".order_id as order_id, ".TABLE_PRODUCT.".productname as caption, ".TABLE_PRODUCT.".imagepathname as url FROM ".TABLE_CATEGORY." LEFT JOIN ".TABLE_PRODUCT." ON ".TABLE_PRODUCT.".category_id = ".TABLE_CATEGORY.".category_id WHERE ".TABLE_CATEGORY.".is_active = '1' AND ".TABLE_PRODUCT.".is_active = '1' ".$likes." ORDER BY ".TABLE_PRODUCT.".date_added DESC";
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function insert_product($data = array()){

		$this->db->insert(TABLE_PRODUCT, $data); 
		
		return true;
	}
	
	public function update_product($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_PRODUCT, $data); 
		
		return true;
	}
	
	public function delete_product($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_PRODUCT);
		
		return true;
	}
}