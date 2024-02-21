<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;

class Admin extends BaseController
{
	public function __construct()
	{
		$db = db_connect();
		$this->db = db_connect();

		$this->AdminModel = new AdminModel($db);
		$this->session = session();
		helper(['form', 'url', 'validation']);
	}
	public function index()
	{
		return view('admin/login');
	}
	function loginAuth()
	{

		$session = session();
		$AdminModel = new AdminModel();
		$username = $this->request->getVar('username');
		$password = base64_encode(base64_encode($this->request->getVar('password')));

		$data = $AdminModel->where('user_name', $username)->first();

		//echo "<pre>";
		//Print_r ($data);exit;
		if ($data) {
			$pass = $data['password'];
			$status = $data['status'];
			//$authenticatePassword = password_verify($password, $pass);

			if ($pass == $password and $status = 1) {
				$ses_data = [
					'user_id' => $data['id'],
					'fullname' => $data['full_name'],
					'email' => $data['email'],
					'isLoggedIn' => TRUE
				];
				$session->set($ses_data);
				return redirect()->to('admin/Dashboard');
			} else {
				$session->setFlashdata('msg', 'Password is incorrect.');
				return redirect()->to('admin/');
			}
		} else {
			$session->setFlashdata('msg', 'username does not exist.');
			return redirect()->to('admin/');
		}
	}
	function profile()
	{

		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			return view('admin/profile_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}
	function pro()
	{

		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			$rules = [
				'fullname' => 'required|min_length[3]',
				'email' => 'required|valid_email',
				'contact' => 'required|numeric|max_length[10]',
				'username' => 'required|min_length[5]',
				'password' => 'required|min_length[6]',

			];

			if ($this->validate($rules)) {
				$fullname = $this->request->getPost('fullname');
				$email = $this->request->getPost('email');
				$contact = $this->request->getPost('contact');
				$username = $this->request->getPost('username');
				$password = base64_encode(base64_encode($this->request->getVar('password')));

				$file = $this->request->getFile('img');
				if ($file->isValid() && !$file->hasMoved()) {
					$imagename = $file->getRandomName();
					$file->move('uploads/', $imagename);
				} else {
					$imagename = "";
				}

				if ($imagename != '') {
					$data = [
						'full_name' => $fullname,
						'email' => $email,
						'contact_no' => $contact,
						'user_name' => $username,
						'password' => $password,
						'profile_image' => $imagename,
					];
				} else {
					$data = [
						'full_name' => $fullname,
						'email' => $email,
						'contact_no' => $contact,
						'user_name' => $username,
						'password' => $password,
					];
				}

				$this->AdminModel->UpdateProfile($data, $user_id);

				return redirect()->to('admin/profile');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/profile_vw', $data);
			}
		} else {
			return redirect()->to('admin/');
		}
	}
	function setting()
	{

		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);



			return view('admin/Setting_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}
	function updatesetting()
	{
		$settingid = $this->request->getPost('settingid');
		$title = $this->request->getPost('title');
		$tagline = $this->request->getPost('tagline');
		$desc = $this->request->getPost('desc');
		$facebook = $this->request->getPost('facebook');
		$tweeter = $this->request->getPost('tweeter');
		$google = $this->request->getPost('google');
		$linkdin = $this->request->getPost('linkdin');
		$instagram = $this->request->getPost('instagram');
		$file = $this->request->getFile('img');
		if ($file->isValid() && !$file->hasMoved()) {
			$imagename = $file->getRandomName();
			$file->move('uploads/', $imagename);
		} else {
			$imagename = "";
		}
		if ($imagename != '') {
			$data = [
				'title' => $title,
				'tagline' => $tagline,
				'description' => $desc,
				'facebook' => $facebook,
				'tweeter' => $tweeter,
				'google' => $google,
				'linkdin' => $linkdin,
				'instagram' => $instagram,
				'logo' => $imagename
			];
		} else {

			$data = [
				'title' => $title,
				'tagline' => $tagline,
				'description' => $desc,
				'facebook' => $facebook,
				'tweeter' => $tweeter,
				'google' => $google,
				'linkdin' => $linkdin,
				'instagram' => $instagram

			];
		}
		//echo "<pre>";
		//print_r($data);exit;

		$this->AdminModel->UpdateSetting($data, $settingid);
		return redirect()->to('admin/Setting');
	}
	public function Logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/admin');
	}
	function dashboard()
	{

		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			return view('admin/dashboard_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}

	function Cms_management()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['allcms'] = $this->AdminModel->getAllCms();


			return view('admin/cms_management_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}
	function Add_page()
	{
		if ($this->session->get('user_id')) {

			$pageName = $this->request->getPost('pageName');
			$pageDetails = $this->request->getPost('pageDetails');
			$pageTitle = $this->request->getPost('pageTitle');
			$KeyWord = $this->request->getPost('KeyWord');
			$PageDescription = $this->request->getPost('PageDescription');



			$file = $this->request->getFile('img');
			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}

			$data = [
				'page_name' => $pageName,
				'details' => $pageDetails,
				'image' => $imagename,
				'page_title' => $pageTitle,
				'page_keyword' => $KeyWord,
				'page_description' => $PageDescription,

			];

			$this->AdminModel->AddPages($data);

			return redirect()->to('/admin/Cms_management');
		} else {
			return redirect()->to('admin/');
		}
	}

	function Delete_page()
	{
		if ($this->session->get('user_id')) {

			$pageId = $this->request->getPost('user_id');
			$this->AdminModel->DeleteCsm($pageId);

			return redirect()->to('/admin/Cms_management');
		} else {
			return redirect()->to('admin/');
		}
	}
	function Edit_cms()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			$page_id = $this->request->uri->getSegment(3);
			$data['singleCsm'] = $this->AdminModel->single_page($page_id);



			if ($page_id == 1) {
				return view('admin/contactus_vw', $data);
			} else {
				return view('admin/edit_cms_vw', $data);
			}
		} else {
			return redirect()->to('admin/');
		}
	}

	function UpdateCsm()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			$pageTitle = $this->request->getPost('pageTitle');
			$KeyWord = $this->request->getPost('KeyWord');
			$PageDescription = $this->request->getPost('PageDescription');



			$pageId = $this->request->getPost('cmsid');
			$pageName = $this->request->getPost('pageName');
			$pageDetails = $this->request->getPost('pageDetails');
			$address = $this->request->getPost('address');
			$email = $this->request->getPost('email');
			$contact = $this->request->getPost('contact');

			$file = $this->request->getFile('img');
			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}
			if ($imagename != '') {
				$data = [
					'page_name' => $pageName,
					'details' => $pageDetails,
					'address' => $address,
					'email' => $email,
					'phone' => $contact,
					'image' => $imagename,

					'page_title' => $pageTitle,
					'page_keyword' => $KeyWord,
					'page_description' => $PageDescription,

				];
			} else {

				$data = [
					'page_name' => $pageName,
					'details' => $pageDetails,
					'address' => $address,
					'email' => $email,
					'phone' => $contact,

					'page_title' => $pageTitle,
					'page_keyword' => $KeyWord,
					'page_description' => $PageDescription,

				];
			}



			$this->AdminModel->UpdatePages($data, $pageId);


			return redirect()->to('/admin/Edit_cms/' . $pageId);
		} else {
			return redirect()->to('admin/');
		}
	}
	function Blog()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['blog_data'] = $this->AdminModel->getAllBlog();



			return view('admin/blog_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}
	function Addblog()
	{
		if ($this->session->get('user_id')) {

			$fullname = $this->request->getPost('fullname');
			$author_name = $this->request->getPost('author_name');
			$date = $this->request->getPost('date');
			$details = $this->request->getPost('details');
			$p_cat = $this->request->getPost('p_cat');
			$file = $this->request->getFile('img');
			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}

			$data = [
				'title' => $fullname,
				'name' => $author_name,
				'date' => $date,
				'message' => $details,
				'category' => $p_cat,
				'image' => $imagename,
			];

			$this->AdminModel->AddBlog($data);

			return redirect()->to('/admin/Blog');
		} else {
			return redirect()->to('admin/');
		}
	}
	function deleteblog()
	{
		if ($this->session->get('user_id')) {

			$blog_id = $this->request->getPost('blog_id');

			$this->AdminModel->DeleteBlog($blog_id);

			return redirect()->to('/admin/blog');
		} else {
			return redirect()->to('admin/');
		}
	}
	function view_edit()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			$blog_id = $this->request->uri->getSegment(3);
			$data['blog_details'] = $this->AdminModel->singleBlog($blog_id);




			return view('admin/editblog_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}

	function edit_blog()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			$blog_id = $this->request->uri->getSegment(3);
			$data['blog_details'] = $this->AdminModel->singleBlog($blog_id);




			$blog_id = $this->request->getPost('blog_id');
			$title = $this->request->getPost('title');
			$name = $this->request->getPost('name');
			$date = $this->request->getPost('date');
			$p_cat = $this->request->getPost('p_cat');
			$details = $this->request->getPost('details');
			$file = $this->request->getFile('img');

			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}
			if ($imagename != '') {
				$data = [
					'title' => $title,
					'name' => $name,
					'date' => $date,
					'category' => $p_cat,
					'message' => $details,
					'image' => $imagename

				];
			} else {

				$data = [
					'title' => $title,
					'name' => $name,
					'date' => $date,
					'category' => $p_cat,
					'message' => $details


				];
			}



			$this->AdminModel->UpdateBlog($data, $blog_id);


			return redirect()->to('/admin/view_edit/' . $blog_id);
			return view('admin/editblog_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}

	function Banner()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['banner_data'] = $this->AdminModel->bannerdata();


			return view('admin/banner_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}
	function addbanner()
	{
		if ($this->session->get('user_id')) {

			$title = $this->request->getPost('title');
			$subtitle = $this->request->getPost('subtitle');
			$url = $this->request->getPost('url');
			$description = $this->request->getPost('description');
			$ban_type = $this->request->getPost('ban_type');
			$orderby = $this->request->getPost('orderby');
			$file = $this->request->getFile('img');


			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}

			$data = [
				'banner_title' => $title,
				'banner_subtitle' => $subtitle,
				'urrl' => $url,
				'description' => $description,
				'type' => $ban_type,
				'orderby' => $orderby,
				'image' => $imagename

			];

			$this->AdminModel->addbanner($data);
			return redirect()->to('admin/Banner');
		} else {
			return redirect()->to('admin/');
		}
	}

	function Delete_Banner()
	{
		if ($this->session->get('user_id')) {

			$BannerId = $this->request->getPost('user_id');

			$this->AdminModel->DeleteBanner($BannerId);

			return redirect()->to('/admin/Banner');
		} else {
			return redirect()->to('admin/');
		}
	}
	function edit_banner()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			$banner_id = $this->request->uri->getSegment(3);
			$data['single_banner_data'] = $this->AdminModel->single_bannerdata($banner_id);


			return view('admin/banner_edit_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}
	function Update_Banner()
	{
		if ($this->session->get('user_id')) {

			$banner_id = $this->request->getPost('EditId');
			$title = $this->request->getPost('title');
			$subtitle = $this->request->getPost('subtitle');
			$url = $this->request->getPost('url');
			$description = $this->request->getPost('description');
			$ban_type = $this->request->getPost('ban_type');
			$orderby = $this->request->getPost('orderby');
			$file = $this->request->getFile('img');

			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}
			if ($imagename != '') {
				$data = [
					'banner_title' => $title,
					'banner_subtitle' => $subtitle,
					'urrl' => $url,
					'description' => $description,
					'type' => $ban_type,
					'orderby' => $orderby,
					'image' => $imagename

				];
			} else {
				$data = [
					'banner_title' => $title,
					'banner_subtitle' => $subtitle,
					'urrl' => $url,
					'description' => $description,
					'type' => $ban_type,
					'orderby' => $orderby,
				];
			}
			$this->AdminModel->Editbanner($data, $banner_id);
			return redirect()->to('admin/edit_banner/' . $banner_id);
		} else {
			return redirect()->to('admin/');
		}
	}


	function Subadmin()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['allsubadmin'] = $this->AdminModel->GetAllCustomer(3);
			$data['company'] = $this->AdminModel->Company();

			return view('admin/sub_admin_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}
	// 	function addsubadmin()
	// 	{
	// 		if ($this->session->get('user_id')) {

	// 			$user_id = $this->session->get('user_id');

	// 			$data['setting'] = $this->AdminModel->Settingdata();
	// 			$data['singleuser'] = $this->AdminModel->userdata($user_id);
	// 			$data['allsubadmin'] = $this->AdminModel->GetAllCustomer(2);
	// 			$data['company'] = $this->AdminModel->Company();

	// 			$rules = [
	// 				'name' => 'required|min_length[3]',
	// 				'email' => 'required|valid_email|is_unique[user.email]',
	// 				'contact' => 'required|numeric|max_length[10]|is_unique[user.contact_no]',
	// 				'username' => 'required|max_length[10]|is_unique[user.user_name]',
	// 				'password' => 'required|min_length[6]',
	// 				'office' => 'required',
	// 			];

	// 			if ($this->validate($rules)) {
	// 				$file = $this->request->getFile('img');
	// 				if ($file->isValid() && !$file->hasMoved()) {
	// 					$imagename = $file->getRandomName();
	// 					$file->move('uploads/', $imagename);
	// 				} else {
	// 					$imagename = "";
	// 				}


	// 				$data = [
	// 					'full_name' => $this->request->getVar('name'),
	// 					'email'  => $this->request->getVar('email'),
	// 					'user_name'  => $this->request->getVar('username'),
	// 					'contact_no'  => $this->request->getVar('contact'),
	// 					'password'  => base64_encode(base64_encode($this->request->getVar('password'))),
	// 					'profile_image'  => $imagename,
	// 					'office_name'  => $this->request->getVar('office'),,
	// 					'status'  => 1,
	// 					'user_type'  => 2
	// 				];

	// 				$this->AdminModel->adduser($data);
	// 				return redirect()->to('admin/Subadmin');
	// 			} else {
	// 				$data['validation'] = $this->validator;
	// 				echo view('admin/sub_admin_vw', $data);
	// 			}
	// 		} else {
	// 			return redirect()->to('admin/');
	// 		}
	// 	}
	function addsubadmin()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['allsubadmin'] = $this->AdminModel->GetAllCustomer(2);
			$data['company'] = $this->AdminModel->Company();

			$rules = [
				'name' => 'required|min_length[3]',
				'email' => 'required|valid_email|is_unique[user.email]',
				'contact' => 'required|numeric|max_length[10]|is_unique[user.contact_no]',
				'username' => 'required|max_length[10]|is_unique[user.user_name]',
				'password' => 'required|min_length[6]',
				'office' => 'required',
			];

			if ($this->validate($rules)) {
				$file = $this->request->getFile('img');
				if ($file->isValid() && !$file->hasMoved()) {
					$imagename = $file->getRandomName();
					$file->move('uploads/', $imagename);
				} else {
					$imagename = "";
				}

				$userData = [
					'full_name' => $this->request->getVar('name'),
					'email' => $this->request->getVar('email'),
					'user_name' => $this->request->getVar('username'),
					'contact_no' => $this->request->getVar('contact'),
					'password' => base64_encode(base64_encode($this->request->getVar('password'))),
					'profile_image' => $imagename,
					'office_name' => $this->request->getVar('office'),
					'status' => 1,
					'user_type' => 3,
				];

				$this->AdminModel->adduser($userData);
				return redirect()->to('admin/Subadmin');
			} else {
				$data['validation'] = $this->validator;
				echo view('admin/sub_admin_vw', $data);
			}
		} else {
			return redirect()->to('admin/');
		}
	}

	function deleteSubadmin()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->request->getVar('user_id');
			$this->AdminModel->deleteuser($user_id);
			return redirect()->to('admin/Subadmin');
		} else {
			return redirect()->to('admin/');
		}
	}
	function statusBlock()
	{
		$user_id = $this->request->uri->getSegment(3);
		$data = [
			'status'  => 0
		];
		$this->AdminModel->UserStatusActive($data, $user_id);
		redirect('/', 'refresh');
	}
	function statusActive()
	{
		$user_id = $this->request->uri->getSegment(3);
		$data = [
			'status'  => 1
		];
		$this->AdminModel->UserStatusActive($data, $user_id);
		return redirect()->to('admin/Subadmin');
	}
	function editsubadmin()
	{
		if ($this->session->get('user_id')) {

			$id = $this->request->getPost('id');
			$name = $this->request->getPost('name');
			$email = $this->request->getPost('email');
			$contact = $this->request->getPost('contact');
			$username = $this->request->getPost('username');
			$office = $this->request->getPost('office');

			$password = base64_encode(base64_encode($this->request->getVar('password')));

			$CountEmail = $this->db->query("SELECT * FROM user  where email='$email' and id!='$id' ")->getResult();
			$CountContact = $this->db->query("SELECT * FROM user  where contact_no='$contact' and id!='$id' ")->getResult();
			$CountUsername = $this->db->query("SELECT * FROM user  where user_name='$username' and id!='$id' ")->getResult();
			if (count($CountEmail) == 0) {
				if (count($CountContact) == 0) {

					if (count($CountUsername) == 0) {
						$file = $this->request->getFile('img');
						if ($file->isValid() && !$file->hasMoved()) {
							$imagename = $file->getRandomName();
							$file->move('uploads/', $imagename);
						} else {
							$imagename = "";
						}


						if ($imagename) {
							$data = [
								'full_name' => $name,
								'email'  => $email,
								'user_name'  => $username,
								'contact_no'  => $contact,
								'office_name'  => $office,
								'password'  => $password,
								'profile_image'  => $imagename,
								'status'  => 1,
								'user_type'  => 3
							];
						} else {

							$data = [
								'full_name' => $name,
								'email'  => $email,
								'user_name'  => $username,
								'contact_no'  => $contact,
								'office_name'  => $office,
								'password'  => $password,
								'status'  => 1,
								'user_type'  => 3
							];
						}

						$this->AdminModel->updateUser($data, $id);
						return redirect()->to('admin/Subadmin');
					} else {
						$this->session->setFlashdata('msg', 'Username  Already  exist.');
						$this->session->setFlashdata('uid', $id);
					}
				} else {
					$this->session->setFlashdata('msg', 'Contact Number  Already  exist.');
					$this->session->setFlashdata('uid', $id);
				}
			} else {
				$this->session->setFlashdata('msg', 'Email Already  exist.');
				$this->session->setFlashdata('uid', $id);
			}


			return redirect()->to('admin/Subadmin');
		} else {
			return redirect()->to('admin/');
		}
	}
	function role()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			//	if ($this->session->get('user_type')!=1 AND $this->session->get('user_type')!=2 ){return redirect()->to('admin/');}

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['allsubadmin'] = $this->AdminModel->GetAllCustomer(2);

			$id = $this->request->getVar('id');
			$role = $this->request->getVar('role[]');

			$job = implode(',', $role);

			$data = [
				'roles' => $job,
			];

			$this->db->table('user')->update($data, array('id' => $id));

			return redirect()->to('admin/Subadmin');
		} else {
			return redirect()->to('ABLOGIN/');
		}
	}

	function Testimonial()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['testimonial_data'] = $this->AdminModel->testimonial();


			return view('admin/testimonial_vw.php', $data);
		} else {
			return redirect()->to('admin/');
		}
	}

	function addtestimonial()
	{
		if ($this->session->get('user_id')) {

			$title = $this->request->getPost('fname');
			$description = $this->request->getPost('message');
			$file = $this->request->getFile('img');

			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}

			$data = [
				'name' => $title,
				'message' => $description,
				'image' => $imagename

			];

			$this->AdminModel->addtestimonial($data);
			return redirect()->to('admin/Testimonial');
		} else {
			return redirect()->to('admin/');
		}
	}
	function edittestimonial()
	{
		if ($this->session->get('user_id')) {
			$testimonialid = $this->request->getPost('testimonial_id');
			$title = $this->request->getPost('fname');
			$description = $this->request->getPost('message');
			$file = $this->request->getFile('img');

			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}
			if ($imagename == "") {

				$data = [
					'name' => $title,
					'message' => $description,

				];
			} else {
				$data = [
					'name' => $title,
					'message' => $description,
					'image' => $imagename,
				];
			}
			$this->db->table('testimonial')->update($data, array('testimonial_id' => $testimonialid));
			return redirect()->to('admin/Testimonial');
		} else {
			return redirect()->to('admin/');
		}
	}

	function Delete_testimonial()
	{
		if ($this->session->get('user_id')) {
			$testimonial_id = $this->request->uri->getSegment(3);



			$this->AdminModel->DeleteTestimonial($testimonial_id);

			return redirect()->to('/admin/Testimonial');
		} else {
			return redirect()->to('admin/');
		}
	}
	function Designation()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['designation'] = $this->AdminModel->Designation();

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			return view('admin/designation_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Insertdesignation()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['designation'] = $this->AdminModel->Designation();

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			$rules = [
				'designation' => 'required|is_unique[designation.designation_name]',
			];

			if ($this->validate($rules)) {
				$designation = $this->request->getPost('designation');

				$data = [
					'designation_name' => $designation,
				];

				$this->db->table('designation')->insert($data);
				return redirect()->to('Admin/Designation');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/designation_vw', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}
	function editdesignation()
	{
		if ($this->session->get('user_id')) {

			$desgid = $this->request->getPost('desgid');
			$designation = $this->request->getPost('designation');

			$countdesn = $this->db->query("SELECT * FROM designation  where designation_name='$designation' and designation_id!='$desgid' ")->getResult();
			if (count($countdesn) == 0) {

				$data = [
					'designation_id' => $desgid,
					'designation_name' => $designation,
				];
				$this->db->table('designation')->update($data, array('designation_id' => $desgid));
			} else {
				$this->session->setFlashdata('msg', 'Designation Name  Already  exist.');
				$this->session->setFlashdata('uid', $stateid);
			}

			return redirect()->to('Admin/Designation');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deletedesignation()
	{
		$desnid = $this->request->getPost('user_id');
		$this->db->table('designation')->delete(array('designation_id' => $desnid));
		return redirect()->to('Admin/Designation');
	}

	function statusdesignation()
	{
		if ($this->session->get('user_id')) {
			$degn_id  = $this->request->getPost('degn_id');
			$degn_status = $this->request->getPost('degn_status');

			$data = [
				'designation_status'  => $degn_status,
			];

			$this->db->table('designation')->update($data, array('designation_id' => $degn_id));
			return redirect()->to('Admin/Designation');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Department()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['department'] = $this->AdminModel->Department();

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			return view('admin/department_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Insertdepartment()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['department'] = $this->AdminModel->Department();

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			$rules = [
				'department' => 'required|is_unique[department.department_name]',
			];

			if ($this->validate($rules)) {
				$department = $this->request->getPost('department');

				$data = [
					'department_name' => $department,
				];

				$this->db->table('department')->insert($data);
				return redirect()->to('Admin/Department');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/department_vw', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}
	function editdepartment()
	{
		if ($this->session->get('user_id')) {

			$deptid = $this->request->getPost('deptid');
			$department = $this->request->getPost('department');

			$countdept = $this->db->query("SELECT * FROM department  where department_name='$department' and department_id!='$deptid' ")->getResult();
			if (count($countdept) == 0) {

				$data = [
					'department_id' => $deptid,
					'department_name' => $department,
				];
				$this->db->table('department')->update($data, array('department_id' => $deptid));
			} else {
				$this->session->setFlashdata('msg', 'Department Name  Already  exist.');
				$this->session->setFlashdata('uid', $deptid);
			}

			return redirect()->to('Admin/Department');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deletedepartment()
	{
		$deptid = $this->request->getPost('user_id');
		$this->db->table('department')->delete(array('department_id' => $deptid));
		return redirect()->to('Admin/Department');
	}

	function statusdepartment()
	{
		if ($this->session->get('user_id')) {
			$dept_id  = $this->request->getPost('dept_id');
			$dept_status = $this->request->getPost('dept_status');

			$data = [
				'department_status'  => $dept_status,
			];

			$this->db->table('department')->update($data, array('department_id' => $dept_id));
			return redirect()->to('Admin/Department');
		} else {
			return redirect()->to('Admin/');
		}
	}
	function City()
	{

		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['city'] = $this->AdminModel->City();

			return view('admin/city_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}

	function Insertcity()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['city'] = $this->AdminModel->City();


			$rules = [
				'cityname' => 'required|is_unique[city.city_name]',
			];

			if ($this->validate($rules)) {

				$cityname = $this->request->getPost('cityname');

				$data = [
					'city_name' => $cityname,
				];

				$this->db->table('city')->insert($data);
				return redirect()->to('admin/City');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/city_vw', $data);
			}
		} else {
			return redirect()->to('admin/');
		}
	}

	function Editcity()
	{
		if ($this->session->get('user_id')) {
			$cityid = $this->request->getPost('cityid');
			$cityname = $this->request->getPost('cityname');

			$countcity = $this->db->query("SELECT * FROM city where city_name='$cityname' and city_id!='$cityid' ")->getResult();
			if (count($countcity) == 0) {

				$data = [
					'city_name' => $cityname,
				];
				$this->db->table('city')->update($data, array('city_id' => $cityid));
			} else {
				$this->session->setFlashdata('msg', 'city Name  Already  exist.');
				$this->session->setFlashdata('uid', $cityid);
			}

			return redirect()->to('admin/City');
		} else {
			return redirect()->to('admin/');
		}
	}

	function deletecity()
	{
		$cityid = $this->request->getPost('user_id');
		$this->db->table('city')->delete(array('city_id' => $cityid));
		return redirect()->to('admin/City');
	}

	function statuscity()
	{
		if ($this->session->get('user_id')) {
			$city_id  = $this->request->getPost('city_id');
			$city_status = $this->request->getPost('city_status');

			$data = [
				'city_status'  => $city_status,
			];

			$this->db->table('city')->update($data, array('city_id' => $city_id));
			return redirect()->to('admin/City');
		} else {
			return redirect()->to('admin/');
		}
	}
	function Office()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['company'] = $this->AdminModel->Company();
			$data['city'] = $this->AdminModel->City();
			//	$data['union'] = $this->AdminModel->Union();
			//	$data['employee'] = $this->AdminModel->GetAllCustomer(2);
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			return view('admin/office_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Insertoffice()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['company'] = $this->AdminModel->Company();

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			$rules = [
				'officename' => 'required',
				'branchoffice' => 'required',
				'officelocation' => 'required',
				'officephoneno' => 'required',
				'officeaddress' => 'required',
				//'manager' => 'required',
				//'officeunion' => 'required',

			];


			$officename = $this->request->getPost('officename');
			$branchoffice = $this->request->getPost('branchoffice');
			$officelocation = $this->request->getPost('officelocation');
			$officephoneno = $this->request->getPost('officephoneno');
			$officeaddress = $this->request->getPost('officeaddress');
			$manager = $this->request->getPost('manager');
			//$officeunion = $this->request->getPost('officeunion');

			$file = $this->request->getFile('image');
			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}

			if ($this->validate($rules)) {
				$data = [
					'company_name' => $officename,
					'company_type' => $branchoffice,
					'company_location' => $officelocation,
					'company_phoneno' => $officephoneno,
					'company_address' => $officeaddress,
					//	'company_manager' => $manager,
					//	'company_union' => $officeunion,
					'company_image' => $imagename,
				];

				$this->db->table('company')->insert($data);
				return redirect()->to('Admin/Office');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/office_vw', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Editoffice()
	{
		if ($this->session->get('user_id')) {

			$officeid = $this->request->getPost('officeid');
			$officename = $this->request->getPost('officename');
			$branchoffice = $this->request->getPost('branchoffice');
			$officelocation = $this->request->getPost('officelocation');
			$officephoneno = $this->request->getPost('officephoneno');
			$officeaddress = $this->request->getPost('officeaddress');
			//	$manager = $this->request->getPost('manager');

			$file = $this->request->getFile('image');
			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}

			if ($imagename) {
				$data = [
					'company_name' => $officename,
					'company_type' => $branchoffice,
					'company_location' => $officelocation,
					'company_phoneno' => $officephoneno,
					'company_address' => $officeaddress,
					//	'company_manager' => $manager,
					//	'company_union' => $officeunion,
					'company_image' => $imagename,
				];
			} else {
				$data = [
					'company_name' => $officename,
					'company_type' => $branchoffice,
					'company_location' => $officelocation,
					'company_phoneno' => $officephoneno,
					'company_address' => $officeaddress,
					//	'company_manager' => $manager,
					//	'company_union' => $officeunion,
					//	'company_image' => $imagename,
				];
			}
			//Print_r($data);exit;
			$this->db->table('company')->update($data, array('company_id' => $officeid));

			return redirect()->to('Admin/Office');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deleteoffice()
	{
		$officeid = $this->request->getPost('user_id');
		$this->db->table('company')->delete(array('company_id' => $officeid));
		return redirect()->to('Admin/Office');
	}

	function statusoffice()
	{
		if ($this->session->get('user_id')) {
			$office_id  = $this->request->getPost('office_id');
			$office_status = $this->request->getPost('office_status');

			$data = [
				'company_status'  => $office_status,
			];

			$this->db->table('company')->update($data, array('company_id' => $office_id));
			return redirect()->to('Admin/Office');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Union()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['union'] = $this->AdminModel->Union();

			return view('admin/union_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Insertunion()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['union'] = $this->AdminModel->Union();

			$rules = [
				'mainoffice' => 'required',
				'unionname' => 'required',
			];

			if ($this->validate($rules)) {

				$mainoffice = $this->request->getPost('mainoffice');
				$unionname = $this->request->getPost('unionname');

				$data = [
					'union_name' => $unionname,
					'uoffice_name' => $mainoffice,
				];

				$this->db->table('union')->insert($data);
				return redirect()->to('admin/Union');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/union_vw', $data);
			}
		} else {
			return redirect()->to('admin/');
		}
	}

	function Editunion()
	{
		if ($this->session->get('user_id')) {

			$unionid = $this->request->getPost('unionid');
			$mainoffice = $this->request->getPost('mainoffice');
			$unionname = $this->request->getPost('unionname');


			$data = [
				'union_name' => $unionname,
				'uoffice_name' => $mainoffice,
			];

			$this->db->table('union')->update($data, array('union_id' => $unionid));


			return redirect()->to('Admin/Union');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deleteunion()
	{
		$unionid = $this->request->getPost('user_id');
		$this->db->table('union')->delete(array('union_id' => $unionid));
		return redirect()->to('Admin/Union');
	}

	function statusunion()
	{
		if ($this->session->get('user_id')) {
			$union_id  = $this->request->getPost('union_id');
			$union_status = $this->request->getPost('union_status');

			$data = [
				'union_status'  => $union_status,
			];

			$this->db->table('union')->update($data, array('union_id' => $union_id));
			return redirect()->to('Admin/Union');
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Branchoffice()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			return view('admin/branch_office_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}


	function Transferlist()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['transferdtl'] = $this->AdminModel->Transferdtl();
			$data['employee'] = $this->AdminModel->Getalluser2(2);
			$data['company'] = $this->AdminModel->Company();
			return view('admin/transferlist_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Transferdetails()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$segment = $this->request->uri->getSegment(3);
			$data['transferdtl'] = $this->AdminModel->Singletransferdtl($segment);
			return view('admin/transferdetails_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}


	function Emptransferdetails()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$segment = $this->request->uri->getSegment(3);
			$data['empdtl'] = $this->AdminModel->Singleempdtl($segment);
			$data['company'] = $this->AdminModel->Company();
			$data['city'] = $this->AdminModel->City();
			$data['designation'] = $this->AdminModel->Designation();
			$data['unionposition'] = $this->AdminModel->Unionposition();
			$data['union'] = $this->AdminModel->Union();
			return view('admin/employeetransferdetails_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Inserttransferdata()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['employee'] = $this->AdminModel->GetAllCustomer(2);

			$rules = [
				'emptransid' => 'required',   // Make sure to use the correct field name here
				'fromoffice' => 'required',
				'tooffice' => 'required',
				'transferdate' => 'required',
			];

			if ($this->validate($rules)) {
				$employee = $this->request->getPost('emptransid');
				$fromoffice = $this->request->getPost('fromoffice');
				$tooffice = $this->request->getPost('tooffice');
				$transferdate = $this->request->getPost('transferdate');

				$data = [
					'transferemp_id' => $employee,
					'from_office' => $fromoffice,
					'to_office' => $tooffice,
					'transfer_date' => $transferdate,
				];

				$this->db->table('transferdetails')->insert($data);
				return redirect()->to('Admin/Transferlist');
			} else {

				$data['validation'] = $this->validator;
				return view('admin/transferlist_vw', $data);
			}
		} else {

			return redirect()->to('Admin/');
		}
	}

	function Exchangeemployee()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['allemp'] = $this->AdminModel->Getalluser3(2);
			$data['company'] = $this->AdminModel->Company();

			return view('admin/exchangeemployee_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Insertempexdata()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['allemp'] = $this->AdminModel->Getalluser3(2);

			$rules = [
				'exempname' => 'required',   // Make sure to use the correct field name here
				'fromoffice' => 'required',
				'tooffice' => 'required',
				'exchangedate' => 'required',
			];

			if ($this->validate($rules)) {
				$employee = $this->request->getPost('empexid');
				$exempname = $this->request->getPost('exempname');
				$fromoffice = $this->request->getPost('fromoffice');
				$tooffice = $this->request->getPost('tooffice');
				$exchangedate = $this->request->getPost('exchangedate');

				$data = [
					'emp_name' => $employee,
					'exemp_name' => $exempname,
					'exfrom_office' => $fromoffice,
					'exto_office' => $tooffice,
					'exchange_date' => $exchangedate,
				];

				$this->db->table('empexchangedtl')->insert($data);
				return redirect()->to('Admin/Exchangeemployee');
			} else {

				$data['validation'] = $this->validator;
				return view('admin/exchangeemployee_vw', $data);
			}
		} else {

			return redirect()->to('Admin/');
		}
	}





	function Employeepromotion()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['designation'] = $this->AdminModel->Designation();
			$data['employee'] = $this->AdminModel->Getalluser1(2);

			// echo "<pre>";
			//         	print_r($data);exit;

			return view('admin/employee_promotion_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Insertpromotion()
	{

		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['designation'] = $this->AdminModel->Designation();
			$data['member'] = $this->AdminModel->Getalluser1(2);

			$rules = [
				'cposition' => 'required',
				'promoposition' => 'required',
				'promotiondate' => 'required',

			];

			if ($this->validate($rules)) {

				$employeeid = $this->request->getPost('employeeid');
				$cposition = $this->request->getPost('cposition');
				$promoposition = $this->request->getPost('promoposition');
				$promotiondate = $this->request->getPost('promotiondate');



				$data = [
					'promoemp_id' => $employeeid,
					'current_position' => $cposition,
					'promotion_position' => $promoposition,
					'promotion_date' => $promotiondate,

				];
				//print_r($data);exit;

				$this->db->table('promotiondtl')->insert($data);
				return redirect()->to('Admin/Employeepromotion');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/employee_promotion_vw', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Trainingdetails()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['training'] = $this->AdminModel->Training();

			return view('admin/training_details_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Trainingdata()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['training'] = $this->AdminModel->Training();

			$data['employee'] = $this->AdminModel->GetAllCustomer(2);
			return view('admin/training_data', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Inserttrainingdata()
	{


		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['employee'] = $this->AdminModel->Getalluser(2);
			$data['training'] = $this->AdminModel->Training();

			$rules = [
				'employee' => 'required',
				'trainingdate' => 'required',
				'trainingtime' => 'required',
				'venue' => 'required',
				'topic' => 'required',
				'trainingdescr' => 'required',
				'regdlast_date' => 'required',
				'trainer_name' => 'required',
				'trainer_descr' => 'required',

			];

			if ($this->validate($rules)) {

				$employee = $this->request->getPost('employee');
				$trainingdate = $this->request->getPost('trainingdate');
				$trainingtime = $this->request->getPost('trainingtime');
				$venue = $this->request->getPost('venue');
				$topic = $this->request->getPost('topic');
				$trainingdescr = $this->request->getPost('trainingdescr');
				$regdlast_date = $this->request->getPost('regdlast_date');
				$trainer_name = $this->request->getPost('trainer_name');
				$trainer_descr = $this->request->getPost('trainer_descr');

				$data = [
					'emp_id' => $employee,
					'training_date' => $trainingdate,
					'training_time' => $trainingtime,
					'training_venue' => $venue,
					'training_topic' => $topic,
					'training_description' => $trainingdescr,
					'registration_lastdate' => $regdlast_date,
					'trainer_name' => $trainer_name,
					'trainer_description' => $trainer_descr,

				];
				//print_r($data);exit;

				$this->db->table(' trainingdetails')->insert($data);
				return redirect()->to('Admin/Trainingdetails');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/training_data', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Ambulance()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['ambulance'] = $this->AdminModel->Ambulance();


			return view('admin/ambulance_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Insertambulance()
	{


		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['ambulance'] = $this->AdminModel->Ambulance();


			$rules = [
				'officename' => 'required',
				'ambno' => 'required',
				'ambservice' => 'required',

			];

			if ($this->validate($rules)) {

				$officename = $this->request->getPost('officename');
				$ambno = $this->request->getPost('ambno');
				$ambservice = $this->request->getPost('ambservice');

				$data = [
					'amb_office_id' => $officename,
					'ambulance_service' => $ambno,
					'ambulance_no' => $ambservice,
				];
				//print_r($data);exit;

				$this->db->table('ambulance')->insert($data);
				return redirect()->to('Admin/Ambulance');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/ambulance_vw', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Editambulance()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$ambulance_id = $this->request->getPost('ambulance_id');
			$officename = $this->request->getPost('officename');
			$ambno = $this->request->getPost('ambno');
			$ambservice = $this->request->getPost('ambservice');

			$data = [
				'amb_office_id' => $officename,
				'ambulance_service' => $ambservice,
				'ambulance_no' => $ambno,
			];


			//print_r($data);exit;

			$this->db->table('ambulance')->update($data, array('ambulance_id' => $ambulance_id));
			return redirect()->to('Admin/Ambulance');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deleteambulance()
	{
		$ambulance_id = $this->request->getPost('user_id');
		$this->db->table('ambulance')->delete(array('ambulance_id' => $ambulance_id));
		return redirect()->to('admin/Ambulance');
	}
	function statusambulance()
	{
		if ($this->session->get('user_id')) {

			$ambulance_id  = $this->request->getPost('ambulance_id');
			$ambulance_status = $this->request->getPost('ambulance_status');

			$data = [
				'amb_status'  => $ambulance_status,
			];

			$this->db->table('ambulance')->update($data, array('ambulance_id' => $ambulance_id));
			return redirect()->to('admin/Ambulance');
		} else {
			return redirect()->to('admin/');
		}
	}

	function Bloodbank()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['bloodbank'] = $this->AdminModel->Bloodbank();

			return view('admin/bloodbank_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Insertbloodbank()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['bloodbank'] = $this->AdminModel->Bloodbank();

			$rules = [
				'officename' => 'required',
				'bloodbankname' => 'required',
				'bloodgroupsociety' => 'required',
				'pname' => 'required',
				'pphoneno' => 'required',

			];

			if ($this->validate($rules)) {

				$officename = $this->request->getPost('officename');
				$bloodbankname = $this->request->getPost('bloodbankname');
				$bloodgroupsociety = $this->request->getPost('bloodgroupsociety');
				$pname = $this->request->getPost('pname');
				$pphoneno = $this->request->getPost('pphoneno');

				$data = [
					'bloodbankoffice_id' => $officename,
					'bloodbank_name' => $bloodbankname,
					'bloodgroupsociety_name' => $bloodgroupsociety,
					'person_name' => $pname,
					'person_phoneno' => $pphoneno,
				];
				//print_r($data);exit;

				$this->db->table('bloodbankservice')->insert($data);
				return redirect()->to('Admin/Bloodbank');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/bloodbank_vw', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Editbloodbank()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$bloodbank_id = $this->request->getPost('bloodbank_id');
			$officename = $this->request->getPost('officename');
			$bloodbankname = $this->request->getPost('bloodbankname');
			$bloodgroupsociety = $this->request->getPost('bloodgroupsociety');
			$pname = $this->request->getPost('pname');
			$pphoneno = $this->request->getPost('pphoneno');

			$data = [
				'bloodbankoffice_id' => $officename,
				'bloodbank_name' => $bloodbankname,
				'bloodgroupsociety_name' => $bloodgroupsociety,
				'person_name' => $pname,
				'person_phoneno' => $pphoneno,
			];


			//print_r($data);exit;

			$this->db->table('bloodbankservice')->update($data, array('bloodbank_id' => $bloodbank_id));
			return redirect()->to('Admin/Bloodbank');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deletebloodbank()
	{
		$bloodbank_id = $this->request->getPost('user_id');
		$this->db->table('bloodbankservice')->delete(array('bloodbank_id' => $bloodbank_id));
		return redirect()->to('admin/Bloodbank');
	}
	function statusbloodbank()
	{
		if ($this->session->get('user_id')) {

			$bloodbank_id  = $this->request->getPost('bloodbank_id');
			$bloodbank_status = $this->request->getPost('bloodbank_status');

			$data = [
				'bloodbank_status'  => $bloodbank_status,
			];

			$this->db->table('bloodbankservice')->update($data, array('bloodbank_id' => $bloodbank_id));
			return redirect()->to('admin/Bloodbank');
		} else {
			return redirect()->to('admin/');
		}
	}
	function Medical()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['medicalservice'] = $this->AdminModel->Mediclaservice();
			return view('admin/medical_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Insertmedical()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['company'] = $this->AdminModel->Company();
			$data['medicalservice'] = $this->AdminModel->Mediclaservice();

			$rules = [
				'officename' => 'required',
				'medicalname' => 'required',
				'medicaladdress' => 'required',
				'medicalphoneno' => 'required',

			];

			if ($this->validate($rules)) {

				$officename = $this->request->getPost('officename');
				$medicalname = $this->request->getPost('medicalname');
				$medicaladdress = $this->request->getPost('medicaladdress');
				$medicalphoneno = $this->request->getPost('medicalphoneno');

				$data = [
					'medoffice_id' => $officename,
					'medical_name' => $medicalname,
					'medical_address' => $medicaladdress,
					'medical_phoneno' => $medicalphoneno,
				];
				//print_r($data);exit;

				$this->db->table('medicalservice')->insert($data);
				return redirect()->to('Admin/Medical');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/medical_vw', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Editmedical()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$medical_id = $this->request->getPost('medical_id');
			$officename = $this->request->getPost('officename');
			$medicalname = $this->request->getPost('medicalname');
			$medicaladdress = $this->request->getPost('medicaladdress');
			$medicalphoneno = $this->request->getPost('medicalphoneno');

			$data = [
				'medoffice_id' => $officename,
				'medical_name' => $medicalname,
				'medical_address' => $medicaladdress,
				'medical_phoneno' => $medicalphoneno,
			];


			//print_r($data);exit;

			$this->db->table('medicalservice')->update($data, array('medical_id' => $medical_id));
			return redirect()->to('Admin/Medical');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deletemedical()
	{
		$medical_id = $this->request->getPost('user_id');
		$this->db->table('medicalservice')->delete(array('medical_id' => $medical_id));
		return redirect()->to('admin/Medical');
	}
	function statusmedical()
	{
		if ($this->session->get('user_id')) {

			$medical_id  = $this->request->getPost('medical_id');
			$medical_status = $this->request->getPost('medical_status');

			$data = [
				'medical_status'  => $medical_status,
			];

			$this->db->table('medicalservice')->update($data, array('medical_id' => $medical_id));
			return redirect()->to('admin/Medical');
		} else {
			return redirect()->to('admin/');
		}
	}
	function Holidaylist()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['holiday'] = $this->AdminModel->Holiday();

			return view('admin/holiday_list_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Member()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['member'] = $this->AdminModel->GetAllUserList(2);
			$data['company'] = $this->AdminModel->Company();
			$data['designation'] = $this->AdminModel->Designation();
			$data['department'] = $this->AdminModel->Department();
			$data['unionposition'] = $this->AdminModel->Unionposition();
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			return view('admin/member_registration_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}

	function manageAnnualLeave()
	{
		if ($this->session->get('user_id')) {
			$user_id = $this->session->get('user_id');
			$data['leave_setting'] = $this->AdminModel->annualLeaveData();
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			return view('admin/annual_leave_vw', $data);
		} else {
			return redirect()->to('admin/');
		}
	}

	function updateAnnualLeave()
	{
		if ($this->session->get('user_id')) {
			$settingid = $this->request->getPost('settingid');
			$no_of_cl = $this->request->getPost('no_of_cl');
			$no_of_el = $this->request->getPost('no_of_el');
			$no_of_hpl = $this->request->getPost('no_of_hpl');
			$user_id = $this->session->get('user_id');

			$data = [
				'no_of_cl' => $no_of_cl,
				'no_of_el' => $no_of_el,
				'no_of_hpl' => $no_of_hpl,
				'updated_by' => $user_id
			];

			$this->AdminModel->UpdateAnnualLeave($data, $settingid);
			return redirect()->to('admin/manageAnnualLeave');
		} else {
			return redirect()->to('admin/');
		}
	}

	function Member_register()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['company'] = $this->AdminModel->Company();
			$data['city'] = $this->AdminModel->City();
			$data['designation'] = $this->AdminModel->Designation();
			$data['department'] = $this->AdminModel->Department();
			$data['unionposition'] = $this->AdminModel->Unionposition();
			$data['union'] = $this->AdminModel->Union();

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			return view('admin/member_registration_form', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}

	function Insertmemberform()
	{


		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$data['member'] = $this->AdminModel->Getalluser(2);

			$data['company'] = $this->AdminModel->Company();
			$data['city'] = $this->AdminModel->City();
			$data['designation'] = $this->AdminModel->Designation();
			$data['department'] = $this->AdminModel->Department();
			$data['unionposition'] = $this->AdminModel->Unionposition();
			$data['union'] = $this->AdminModel->Union();

			$rules = [
				'name' => 'required|min_length[3]',
				'email' => 'required|valid_email|is_unique[user.email]',
				'mobileno' => 'required|numeric|exact_length[10]|is_unique[user.contact_no]',
				'altmobileno' => 'required|numeric|exact_length[10]|is_unique[user.alter_cnum]',
				'maritalstatus' => 'required',
				'gender' => 'required',
				// 'spousename' => 'required|min_length[3]',
				// 'no_of_child' => 'required',
				'bloodgroup' => 'required',
				'dob' => 'required',
				'officename' => 'required',
				'officelocation' => 'required',
				'unionname' => 'required',
				'designation' => 'required',
				'department' => 'required',
				'position_union' => 'required',
				'joiningdate' => 'required',
				'address' => 'required',
				'user_name' => 'required|is_unique[user.user_name]',
				'password' => 'required|min_length[6]',

			];

			if ($this->validate($rules)) {

				$name = $this->request->getPost('name');
				$email = $this->request->getPost('email');
				$mobileno = $this->request->getPost('mobileno');
				$altmobileno = $this->request->getPost('altmobileno');
				$maritalstatus = $this->request->getPost('maritalstatus');
				$gender = $this->request->getPost('gender');
				$spousename = $this->request->getPost('spousename');
				$no_of_child = $this->request->getPost('no_of_child');
				$bloodgroup = $this->request->getPost('bloodgroup');
				$dob = $this->request->getPost('dob');
				$officename = $this->request->getPost('officename');
				$officelocation = $this->request->getPost('officelocation');
				$unionname = $this->request->getPost('unionname');
				$officelocation = $this->request->getPost('officelocation');
				$designation = $this->request->getPost('designation');
				$department = $this->request->getPost('department');
				$position_union = $this->request->getPost('position_union');
				$joiningdate = $this->request->getPost('joiningdate');
				$user_name = $this->request->getPost('user_name');
				$password = base64_encode(base64_encode($this->request->getVar('password')));
				$address = $this->request->getPost('address');

				$file = $this->request->getFile('image');
				if ($file->isValid() && !$file->hasMoved()) {
					$imagename = $file->getRandomName();
					$file->move('uploads/', $imagename);
				} else {
					$imagename = "";
				}
				$data = [
					'full_name' => $name,
					'email' => $email,
					'contact_no' => $mobileno,
					'alter_cnum' => $altmobileno,
					'marital_status' => $maritalstatus,
					'gender' => $gender,
					'spouse_name' => $spousename,
					'no_of_children' => $no_of_child,
					'blood_group' => $bloodgroup,
					'dob' => $dob,
					'office_name' => $officename,
					'city_id' => $officelocation,
					'office_union' => $unionname,
					'member_desgn_id' => $designation,
					'member_dept_id' => $department,
					'position_in_union' => $position_union,
					'joining_date' => $joiningdate,
					'user_name' => $user_name,
					'password' => $password,
					'address1' => $address,
					'profile_image' => $imagename,
					'user_type' => 2,

				];
				//print_r($data);exit;

				$this->db->table('user')->insert($data);
				return redirect()->to('Admin/Member');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/member_registration_form', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}


	function Editmemberform()
	{

		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);
			$segment = $this->request->uri->getSegment(3);
			$data['singleform'] = $this->AdminModel->singleform($segment);
			$data['member'] = $this->AdminModel->Getalluser(2);

			$data['company'] = $this->AdminModel->Company();
			$data['city'] = $this->AdminModel->City();
			$data['designation'] = $this->AdminModel->Designation();
			$data['department'] = $this->AdminModel->Department();
			$data['unionposition'] = $this->AdminModel->Unionposition();
			$data['union'] = $this->AdminModel->Union();

			return view('admin/edit_member_form', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}


	function Editform()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$segment = $this->request->uri->getSegment(3);
			$data['singleform'] = $this->AdminModel->singleform($segment);
			$member_id = $this->request->getPost('member_id');
			$name = $this->request->getPost('name');
			$email = $this->request->getPost('email');
			$mobileno = $this->request->getPost('mobileno');
			$altmobileno = $this->request->getPost('altmobileno');
			$maritalstatus = $this->request->getPost('maritalstatus');
			$gender = $this->request->getPost('gender');
			$spousename = $this->request->getPost('spousename');
			$no_of_child = $this->request->getPost('no_of_child');
			$bloodgroup = $this->request->getPost('bloodgroup');
			$dob = $this->request->getPost('dob');
			$officename = $this->request->getPost('officename');
			$officelocation = $this->request->getPost('officelocation');
			$unionname = $this->request->getPost('unionname');
			$officelocation = $this->request->getPost('officelocation');
			$designation = $this->request->getPost('designation');
			$department = $this->request->getPost('department');
			$position_union = $this->request->getPost('position_union');
			$joiningdate = $this->request->getPost('joiningdate');
			$user_name = $this->request->getPost('user_name');
			$password = base64_encode(base64_encode($this->request->getVar('password')));
			$address = $this->request->getPost('address');

			$file = $this->request->getFile('image');
			if ($file->isValid() && !$file->hasMoved()) {
				$imagename = $file->getRandomName();
				$file->move('uploads/', $imagename);
			} else {
				$imagename = "";
			}

			if ($imagename) {

				$data = [
					'full_name' => $name,
					'email' => $email,
					'contact_no' => $mobileno,
					'alter_cnum' => $altmobileno,
					'marital_status' => $maritalstatus,
					'gender' => $gender,
					'spouse_name' => $spousename,
					'no_of_children' => $no_of_child,
					'blood_group' => $bloodgroup,
					'dob' => $dob,
					'office_name' => $officename,
					'city_id' => $officelocation,
					'office_union' => $unionname,
					'member_desgn_id' => $designation,
					'member_dept_id' => $department,
					'position_in_union' => $position_union,
					'joining_date' => $joiningdate,
					'user_name' => $user_name,
					'password' => $password,
					'address1' => $address,
					'profile_image' => $imagename,
					'user_type' => 2,
				];
			} else {
				$data = [
					'full_name' => $name,
					'email' => $email,
					'contact_no' => $mobileno,
					'alter_cnum' => $altmobileno,
					'marital_status' => $maritalstatus,
					'gender' => $gender,
					'spouse_name' => $spousename,
					'no_of_children' => $no_of_child,
					'blood_group' => $bloodgroup,
					'dob' => $dob,
					'office_name' => $officename,
					'city_id' => $officelocation,
					'office_union' => $unionname,
					'member_desgn_id' => $designation,
					'member_dept_id' => $department,
					'position_in_union' => $position_union,
					'joining_date' => $joiningdate,
					'user_name' => $user_name,
					'password' => $password,
					'address1' => $address,
					'user_type' => 2,
				];
			}

			//print_r($data);exit;

			$this->db->table('user')->update($data, array('id' => $member_id));
			return redirect()->to('Admin/Member');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deletememberform()
	{
		$id = $this->request->getPost('user_id');
		$this->db->table('user')->delete(array('id' => $id));
		return redirect()->to('admin/Member');
	}
	function statusmemberform()
	{
		if ($this->session->get('user_id')) {

			$member_id  = $this->request->getPost('member_id');
			$member_status = $this->request->getPost('member_status');

			$data = [
				'status'  => $member_status,
			];

			$this->db->table('user')->update($data, array('id' => $member_id));
			return redirect()->to('admin/Member');
		} else {
			return redirect()->to('admin/');
		}
	}
	function Position_union()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['unionposition'] = $this->AdminModel->Unionposition();
			$data['company'] = $this->AdminModel->Company();
			$data['union'] = $this->AdminModel->Union();

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);


			return view('admin/position_union_vw', $data);
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Insertunposition()
	{
		if ($this->session->get('user_id')) {

			$user_id = $this->session->get('user_id');
			$data['unionposition'] = $this->AdminModel->Unionposition();
			$data['company'] = $this->AdminModel->Company();
			$data['union'] = $this->AdminModel->Union();

			$data['setting'] = $this->AdminModel->Settingdata();
			$data['singleuser'] = $this->AdminModel->userdata($user_id);

			$rules = [
				'mainoffice' => 'required',
				'union' => 'required',
				'position' => 'required',
			];

			if ($this->validate($rules)) {
				$mainoffice = $this->request->getPost('mainoffice');
				$union = $this->request->getPost('union');
				$position = $this->request->getPost('position');

				$data = [
					'position_name' => $position,
					'upunion_id' => $union,
					'upoffice_id' => $mainoffice,
				];

				$this->db->table('union_position')->insert($data);
				return redirect()->to('Admin/Position_union');
			} else {
				$data['validation'] = $this->validator;
				return view('admin/position_union_vw', $data);
			}
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Editunposition()
	{
		if ($this->session->get('user_id')) {

			$positionid = $this->request->getPost('positionid');
			$mainoffice = $this->request->getPost('mainoffice');
			$union = $this->request->getPost('union');
			$position = $this->request->getPost('position');

			$data = [
				'position_name' => $position,
				'upunion_id' => $union,
				'upoffice_id' => $mainoffice,
			];
			$this->db->table('union_position')->update($data, array('unposition_id' => $positionid));


			return redirect()->to('Admin/Position_union');
		} else {
			return redirect()->to('Admin/');
		}
	}

	function deleteunposition()
	{
		$positionid = $this->request->getPost('user_id');
		$this->db->table('union_position')->delete(array('unposition_id' => $positionid));
		return redirect()->to('Admin/Position_union');
	}

	function statusunposition()
	{
		if ($this->session->get('user_id')) {
			$position_id  = $this->request->getPost('position_id');
			$position_status = $this->request->getPost('position_status');

			$data = [
				'position_status'  => $position_status,
			];

			$this->db->table('union_position')->update($data, array('unposition_id' => $position_id));
			return redirect()->to('Admin/Position_union');
		} else {
			return redirect()->to('Admin/');
		}
	}
	function Getunion()
	{
		$officeid = $this->request->getPost('office');
		//	echo $officeid;exit;
		$union = $this->AdminModel->Getunion($officeid);
?>

		<select name="union" class="form-control">
			<option value="">select</option>
			<?php foreach ($union as $unionn) { ?>
				<option value="<?= $unionn->union_id ?>"><?= $unionn->union_name ?></option>
			<?php } ?>
		</select>
	<?php
	}

	function Getunionposition()
	{
		$unionid = $this->request->getPost('union');
		//	echo $officeid;exit;
		$unionposition = $this->AdminModel->Getunionposition($unionid);
	?>

		<select name="unionposition" class="form-control">
			<option value="">select</option>
			<?php foreach ($unionposition as $up) { ?>
				<option value="<?= $up->unposition_id ?>"><?= $up->position_name ?></option>
			<?php } ?>
		</select>
	<?php
	}

	function Getoffice()
	{
		$officelocationid = $this->request->getPost('officelocation');
		//	echo $officeid;exit;
		$office = $this->AdminModel->Getoffice($officelocationid);
	?>

		<select name="union" class="form-control">
			<option value="">select</option>
			<?php foreach ($office as $ofc) { ?>
				<option value="<?= $ofc->company_id ?>"><?= $ofc->company_name ?></option>
			<?php } ?>
		</select>
<?php
	}


	public function Importholiday()
	{
		if (isset($_FILES['csv_file'])) {
			$file = $_FILES['csv_file']['tmp_name'];
			$handle = fopen($file, "r");

			while (($data = fgetcsv($handle, 1000, ",")) !== false) {
				$holiday = array(
					'day' => $data[0],
					'date' => date('Y-m-d', strtotime($data[1])),
					'holidayname' => $data[2],
				);

				// Check for existing holiday with the same date and name
				$existingholiday = $this->db->table('holiday')
					->where('date', $holiday['date'])
					->where('holidayname', $holiday['holidayname'])
					->get()
					->getRow();

				if (!$existingholiday) {
					// Insert data if no duplicate found
					$result = $this->db->table('holiday')->insert($holiday);

					if (!$result) {
						// Handle insert errors
						echo "Error inserting data into the database.";
					}
				} else {
					// Handle duplicate data
					echo "Duplicate data found: holiday with date '{$data[1]}' and holidayname '{$data[2]}' already exists.";
				}
			}

			fclose($handle);

			// Redirect user to success page
			return redirect()->to('Admin/Holidaylist');
		} else {
			// If no file has been uploaded, show an error message
			echo "Error: No file selected.";
		}
	}


	function deleteholiday()
	{
		$holidayid = $this->request->getPost('user_id');
		$this->db->table('holiday')->delete(array('holiday_id' => $holidayid));
		return redirect()->to('Admin/Holidaylist');
	}
}
