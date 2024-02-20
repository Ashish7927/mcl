<?php 
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class UserModel extends Model {

	function Settingdata()
		{
			 $builder = $this->db->table('settingg');
			 $builder->select('*');
			 $builder->where('settingg_id', 1);               
			 return $builder->get()->getResult();
		}

	
	
}



