<?php 
/**
* 
*/
class User extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->minify();
	}
	public function index(){
		$data['user']       = $this->db->get_where('user',array('user_id' => $this->session->userdata('user_id_user')))->row();
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/page_profile';
		$data['error']  	= "";
		$limit 				= 4;
		$data['paging']		= $this->db->get('tourism_place')->num_rows();
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman Profile User');	
	}
	public function update_user(){
		// $id = $this->session->userdata('user_id_user');
		$user = $this->db->get_where('user',array('user_id'=>$this->session->userdata('user_id_user')))->row();
			echo "{";
	echo "\"phone\":" . "\"" . $user->phone . "\",";
	echo "\"address\":" . "\"" . $user->address . "\",";
	echo "\"site\":" . "\"" . $user->site . "\",";
	echo "\"birthday\":" . "\"" . $user->birthday . "\",";
	echo "\"gender\":" . "\"" . $user->gender . "\"";
	echo "}";
		
	}
	public function do_update_user(){
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$site = $this->input->post('site');
		$birthday = $this->input->post('birthday');
		$gender = $this->input->post('gender');
		$data = array(
			'phone' => $phone,
			'address' => $address,
			'site' => $site,
			'gender' => $gender,
			'birthday' => $birthday
			);

		 	
		$this->db->where('user_id',$this->session->userdata('user_id_user'));
		$this->db->update('user',$data);
	}
	public function show_user(){
		$data['user']       = $this->db->get_where('user',array('user_id' => $this->session->userdata('user_id_user')))->row();
		$this->load->view('main/infongetrip_template/show_user',$data);
	}
	public function paging(){
		$data['link'] =  $this->input->post('link');
		// $data['page']		= $this->front_folder.$this->themes_folder_name.'/page_paging_user';
		$this->load->view('main/infongetrip_template/page_paging_user',$data);
	}


}
 ?>