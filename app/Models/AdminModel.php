<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class AdminModel extends Model
{
	protected $table = 'user';



	function checkUserPahone($phone)
	{
		$builder = $this->db->table('user');
		$builder->select('*');
		$builder->where('contact_no', $phone);
		return $builder->get()->getResult();
	}

	function checkUserEsino($esi_no)
	{
		$builder = $this->db->table('user');
		$builder->select('*');
		$builder->where('eis_no', $esi_no);
		return $builder->get()->getResult();
	}

	function createPost($data)
	{
		$query = $this->db->table('post')->insert($data);
		return $this->db->insertID();
		
	}

	function inserPostImage($data)
	{
		$query = $this->db->table('post_image')->insert($data);
		return $query;
	}

	function inserPostVideo($data)
	{
		$query = $this->db->table('post_video')->insert($data);
		return $query;
	}

	function getPost($type)
	{
		$builder = $this->db->table('post');
		$builder->select('*');
		$builder->join('post_image', 'post_image.post_id=post.id');
		$builder->join('post_video', 'post_video.post_id=post.id');
		$builder->where('post_type', $type);
		return $builder->get()->getResult();
	}



	function Settingdata()
	{
		$builder = $this->db->table('settingg');
		$builder->select('*');
		$builder->where('settingg_id', 1);
		return $builder->get()->getResult();
	}

	function userdata($user_id)
	{
		$builder = $this->db->table('user');
		$builder->select('*');
		$builder->where('id', $user_id);
		return $builder->get()->getResult();
	}

	function Customerdata()
	{
		$builder = $this->db->table('user');
		$builder->select('*');
		return $builder->get()->getResult();
	}
	function getAllCms()
	{
		$builder = $this->db->table('cms');
		$builder->select('*');
		return $builder->get()->getResult();
	}
	function AddPages($data)
	{
		$query = $this->db->table('cms')->insert($data);
		return $query;
	}

	function DeleteCsm($pageId)
	{
		$query = $this->db->table('cms')->delete(array('id' => $pageId));
		return $query;
	}
	function single_page($page_id)
	{
		$builder = $this->db->table('cms');
		$builder->select('*');
		$builder->where('id', $page_id);
		return $builder->get()->getResult();
	}

	function UpdatePages($data, $pageId)
	{
		$query = $this->db->table('cms')->update($data, array('id' => $pageId));
		return $query;
	}

	function UpdateSetting($data, $settingid)
	{
		$query = $this->db->table('settingg')->update($data, array('settingg_id' => $settingid));
		return $query;
	}

	function UpdateProfile($data, $user_id)
	{
		$query = $this->db->table('user')->update($data, array('id' => $user_id));
		return $query;
	}
	function getAllBlog()
	{
		$builder = $this->db->table('blog');
		$builder->select('*');
		return $builder->get()->getResult();
	}

	function AddBlog($data)
	{
		$query = $this->db->table('blog')->insert($data);
		return $query;
	}
	function DeleteBlog($blog_id)
	{
		$query = $this->db->table('blog')->delete(array('blog_id' => $blog_id));
		return $query;
	}

	function singleBlog($blog_id)
	{
		$builder = $this->db->table('blog');
		$builder->select('*');
		$builder->where('blog_id', $blog_id);
		return $builder->get()->getResult();
	}
	function UpdateBlog($data, $blog_id)
	{
		$query = $this->db->table('blog')->update($data, array('blog_id' => $blog_id));
		return $query;
	}

	function bannerdata()
	{
		$builder = $this->db->table('banner');
		$builder->select('*');
		$builder->orderBy('orderby', 'ASC');
		return $builder->get()->getResult();
	}
	function addbanner($data)
	{

		$query = $this->db->table('banner')->insert($data);
		return $query;
	}

	function DeleteBanner($BannerId)
	{
		$query = $this->db->table('banner')->delete(array('banner_id' => $BannerId));
		return $query;
	}
	function single_bannerdata($banner_id)
	{
		$builder = $this->db->table('banner');
		$builder->select('*');
		$builder->where('banner_id', $banner_id);
		return $builder->get()->getResult();
	}
	function Editbanner($data, $banner_id)
	{
		$query = $this->db->table('banner')->update($data, array('banner_id' => $banner_id));
		return $query;
	}

	function GetAllCustomer($user_type)
	{
		$builder = $this->db->table('user');
		$builder->select('*');
		$builder->where('user_type', $user_type);
		return $builder->get()->getResult();
	}
	function adduser($data)
	{
		$query = $this->db->table('user')->insert($data);
		return $query;
	}
	function deleteuser($user_id)
	{
		$query = $this->db->table('user')->delete(array('id' => $user_id));
		return $query;
	}
	function UserStatusActive($data, $user_id)
	{
		$query = $this->db->table('user')->update($data, array('id' => $user_id));
		return $query;
	}

	function updateUser($data, $id)

	{
		$query = $this->db->table('user')->update($data, array('id' => $id));
		return $query;
	}

	function testimonial()
	{
		$builder = $this->db->table('testimonial');
		$builder->select('*');
		return $builder->get()->getResult();
	}

	function addtestimonial($data)
	{

		$query = $this->db->table('testimonial')->insert($data);
		return $query;
	}
	function DeleteTestimonial($testimonial_id)
	{
		$query = $this->db->table('testimonial')->delete(array('testimonial_id' => $testimonial_id));
		return $query;
	}
	function Designation()
	{
		$builder = $this->db->table('designation');
		$builder->select('*');
		return $builder->get()->getResult();
	}
	function Department()
	{
		$builder = $this->db->table('department');
		$builder->select('*');
		return $builder->get()->getResult();
	}

	function Company()
	{
		$builder = $this->db->table('company');
		$builder->select('*');
		$builder->join('city', 'city.city_id=company.company_location');
		//$builder->join('union', 'union.union_id=company.company_union');
		//$builder->join('user', 'user.id=company.company_manager');
		return $builder->get()->getResult();
	}
	function Unionposition()
	{
		$builder = $this->db->table('union_position');
		$builder->select('*');
		$builder->join('company', 'company.company_id=union_position.upoffice_id');
		$builder->join('union', 'union.union_id=union_position.upunion_id');
		return $builder->get()->getResult();
	}
	function Getalluser($user_type)
	{
		$builder = $this->db->table('user');
		$builder->select('*');
		$builder->join('company', 'company.company_id=user.office_name');
		$builder->join('city', 'city.city_id=user.office_location');
		$builder->join('union', 'union.union_id=user.office_union');
		$builder->join('designation', 'designation.designation_id=user.member_desgn_id');
		$builder->join('union_position', 'union_position.unposition_id =user.position_in_union');
		$builder->where('user_type', $user_type);
		return $builder->get()->getResult();
	}
	function singleform($segment)
	{
		$builder = $this->db->table('user');
		$builder->select('*');
		$builder->where('id', $segment);
		return $builder->get()->getResult();
	}
	function City()
	{
		$builder = $this->db->table('city');
		$builder->select('*');
		return $builder->get()->getResult();
	}
	function Union()
	{
		$builder = $this->db->table('union');
		$builder->select('*');
		$builder->join('company', 'company.company_id=union.uoffice_name');
		return $builder->get()->getResult();
	}
	function Getunion($officeid)
	{
		$builder = $this->db->table('union');
		$builder->select('*');
		$builder->where('uoffice_name', $officeid);
		return $builder->get()->getResult();
	}
	function Getunionposition($unionid)
	{
		$builder = $this->db->table('union_position');
		$builder->select('*');
		$builder->where('upunion_id', $unionid);
		return $builder->get()->getResult();
	}

	function Getoffice($officelocationid)
	{
		$builder = $this->db->table('company');
		$builder->select('*');
		$builder->where('company_location', $officelocationid);
		return $builder->get()->getResult();
	}


	function Training()
	{
		$builder = $this->db->table('trainingdetails');
		$builder->select('*');
		$builder->join('user', 'user.id=trainingdetails.emp_id');
		return $builder->get()->getResult();
	}

	function Transferdtl()
	{
		$builder = $this->db->table('transferdetails');
		$builder->select('transferdetails.*, user.*, from_company.company_name as from_office,to_company.company_name as to_office');
		$builder->join('user', 'user.id=transferdetails.transferemp_id');
		$builder->join('company as from_company', 'from_company.company_id=transferdetails.from_office');
		$builder->join('company as to_company', 'to_company.company_id=transferdetails.to_office');
		return $builder->get()->getResult();
	}
	function Getalluser2($user_type)
	{
		$builder = $this->db->table('user');
		$builder->select('user.*, from_office.company_name as from_company_name, to_office.company_name as to_company_name, transferdetails.*');
		$builder->join('company as from_office', 'from_office.company_id = user.office_name');
		$builder->join('company as to_office', 'to_office.company_id = user.office_name');
		$builder->join('transferdetails', 'user.id = transferdetails.transferemp_id', 'left');
		$builder->where('user_type', $user_type);
		return $builder->get()->getResult();
	}


	function Singletransferdtl($segment)
	{
		$builder = $this->db->table('transferdetails');
		$builder->select('transferdetails.*, 
                      from_company.company_name as from_office_name, 
                      to_company.company_name as to_office_name, user.*');
		$builder->join('company as from_company', 'from_company.company_id = transferdetails.from_office');
		$builder->join('company as to_company', 'to_company.company_id = transferdetails.to_office');
		$builder->join('user', 'user.id = transferdetails.transferemp_id', 'left');
		$builder->where('transferemp_id', $segment);
		return $builder->get()->getResult();
	}
	public function Singleempdtl($segment)
	{
		$builder = $this->db->table('user');
		$builder->select('user.*, 
                      from_company.company_name as from_company_name, 
                      to_company.company_name as to_company_name, 
                      city.city_name,
                      union.union_name,
                      designation.designation_name,
                      union_position.position_name,
                      transferdetails.*');
		$builder->join('company as from_company', 'from_company.company_id = user.office_name');
		$builder->join('company as to_company', 'to_company.company_id = user.office_name');
		$builder->join('city', 'city.city_id = user.office_location');
		$builder->join('union', 'union.union_id = user.office_union');
		$builder->join('designation', 'designation.designation_id = user.member_desgn_id');
		$builder->join('union_position', 'union_position.unposition_id = user.position_in_union');
		$builder->join('transferdetails', 'user.id = transferdetails.transferemp_id', 'left');
		$builder->where('id', $segment);
		return $builder->get()->getResult();
	}




	function Getalluser3($user_type)
	{
		$builder = $this->db->table('user');
		$builder->select('user.*, 
                      from_company.company_name as from_office_name, 
                      to_company.company_name as to_office_name, empexchangedtl.*');
		$builder->join('company as from_company', 'from_company.company_id = user.office_name');
		$builder->join('company as to_company', 'to_company.company_id = user.office_name');
		$builder->join('empexchangedtl', 'user.id = empexchangedtl.emp_name', 'left');
		$builder->where('user_type', $user_type);
		return $builder->get()->getResult();
	}


	function Ambulance()
	{
		$builder = $this->db->table('ambulance');
		$builder->select('*');
		$builder->join('company', 'company.company_id=ambulance.amb_office_id');
		return $builder->get()->getResult();
	}
	function Bloodbank()
	{
		$builder = $this->db->table('bloodbankservice');
		$builder->select('*');
		$builder->join('company', 'company.company_id=bloodbankservice.bloodbankoffice_id');
		return $builder->get()->getResult();
	}
	function Mediclaservice()
	{
		$builder = $this->db->table('medicalservice');
		$builder->select('*');
		$builder->join('company', 'company.company_id=medicalservice.medoffice_id');
		return $builder->get()->getResult();
	}
	function Holiday()
	{
		$builder = $this->db->table('holiday');
		$builder->select('*');
		return $builder->get()->getResult();
	}
	function Promotion()
	{
		$builder = $this->db->table('promotiondtl');
		$builder->select('*');
		return $builder->get()->getResult();
	}

	// 	function Getalluser1($user_type)
	// 	{
	// 		$builder = $this->db->table('user');
	// 		$builder->select('user.*,promotiondtl.*,current_designation.designation_name as designation,promoted_designation.designation_name as pdesignation,company.company_name,city.city_name,union.union_name,union_position.position_name');
	// 		$builder->join('company', 'company.company_id=user.office_name');
	// 		$builder->join('city', 'city.city_id=user.office_location');
	// 		$builder->join('union', 'union.union_id=user.office_union');
	// 	    $builder->join('designation as current_designation', 'current_designation.designation_id=user.member_desgn_id');
	// 	    $builder->join('designation as promoted_designation', 'promoted_designation.designation_id=user.member_desgn_id');
	// 	    $builder->join('union_position', 'union_position.unposition_id =user.position_in_union');
	// 	     $builder->join('promotiondtl', 'promotiondtl.promoemp_id =user.id','left');
	// 		$builder->where('user_type', $user_type);
	// 		return $builder->get()->getResult();
	// 	}

	function Getalluser1($user_type)
	{
		$builder = $this->db->table('user');
		$builder->select('user.*, 
                      promotiondtl.*, 
                      current_designation.designation_name as designation, 
                      promoted_designation.designation_name as pdesignation, 
                      company.company_name, 
                      city.city_name, 
                      union.union_name, 
                      union_position.position_name');
		$builder->join('company', 'company.company_id = user.office_name');
		$builder->join('city', 'city.city_id = user.office_location');
		$builder->join('union', 'union.union_id = user.office_union');
		$builder->join('designation as current_designation', 'current_designation.designation_id = user.member_desgn_id');
		$builder->join('union_position', 'union_position.unposition_id = user.position_in_union');
		$builder->join('promotiondtl', 'promotiondtl.promoemp_id = user.id', 'left');
		$builder->join('designation as promoted_designation', 'promoted_designation.designation_id = promotiondtl.promotion_position', 'left');
		$builder->where('user_type', $user_type);
		return $builder->get()->getResult();
	}
}
