<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends MY_Controller {

		

		public function __construct()

        {

                parent::__construct();

                // Your own constructor code

				if($this->session->userdata('login_admin') != true){redirect(base_url());}							

        }

		

		public function index()

		{
			$user_id 				= $this->session->userdata('id_user');
			
			$search_produk			= $this->input->post("searchProduct");
			
			$limit					= 50;

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 		= 'Halaman Daftar product | '.$judul;

			$data['heading'] 		= "product";

			$data['page']			= 'admin/product/page_list';
			
			$start 	= 	0;

			$where	= "";
			
			if($search_produk != "")
			{
				$search_product	= ($search_produk == "" ? $this->session->userdata("search_produk") : $search_produk);
				$this->session->set_userdata("search_produk", $search_product);
				$where = "where product.product_name like '%".$search_product."%'";
			}
			
			
			$sql = $this->load_product(	$start, 


												$limit, $where );


			$data['product_list']	= $this->db->query($sql);
			
			if(is_numeric($this->security->xss_clean($this->uri->segment(4))))
			{
			
				if($this->session->userdata("search_produk") != "")
				{
					$search_product	= $this->session->userdata("search_produk");
					$this->session->set_userdata("search_produk", $search_produk);
					$where = "where product.product_name like '%".$search_product."%'";
				}
			
				$start 					= $this->security->xss_clean($this->uri->segment(4));


				$sql 					= $this->load_product(	$start, 


																		$limit, $where );


				$data['product_list']	= $this->db->query($sql);


				$log['activity']		= "lihat halaman product halaman ke $start";
			
			}
			
			$base_url 		= 	base_url().'admin/product/page';


			$total_row 		=	$this->db->query("select count(*) as total from product ".$where)->row()->total;


			$uri_segment	= 	4;


			$this->product_pagination_admin(	$limit,


												$base_url,


												$total_row,


												$uri_segment		


												);
				
			

			$this->load->view($this->admin_template, $data);



			$this->insert_log('lihat data product');

		}
		
		function page()
		{
			$user_id 				= $this->session->userdata('id_user');
			
			$limit					= 50;

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 		= 'Halaman Daftar product | '.$judul;

			$data['heading'] 		= "product";

			$data['page']			= 'admin/product/page_list';
			
			$where = "";
			
			
			if(is_numeric($this->security->xss_clean($this->uri->segment(4))))


			{

				if($this->session->userdata("search_produk") != "")
				{
					$search_product	= $this->session->userdata("search_produk");
					$this->session->set_userdata("search_produk", $search_product);
					$where = "where product.product_name like '%".$search_product."%'";
				}
			
				$start 					= $this->security->xss_clean($this->uri->segment(4));


				$sql 					= $this->load_product(	$start, 


																		$limit, $where );


				$data['product_list']	= $this->db->query($sql);


				$log['activity']		= "lihat halaman product halaman ke $start";
			 
			}
			
			else
			{
				redirect(base_url()."admin/product");
			}
			
			$base_url 		= 	base_url().'admin/product/page';


			$total_row 		=	$this->db->query("select count(*) as total from product ".$where)->row()->total;


			$uri_segment	= 	4;


			$this->product_pagination_admin(	$limit,


												$base_url,


												$total_row,


												$uri_segment		


												);
				
			

			$this->load->view($this->admin_template, $data);



			$this->insert_log('lihat data product');
		}

		

		function add()

		{			

			$user_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 			= 'Halaman Tambah product | '.$judul;

			$data['heading'] 		= 'Add product';

			$data['form_action'] 	= site_url('admin/product/add_process');

			$data['page']			= 'admin/product/page_form';

			$data['query_tabel']	= $this->db->query("select * from category_product");

			$data['primary_key']	= $this->db->query("SHOW KEYS FROM category_product WHERE Key_name = 'PRIMARY'")->row();
			
			$data['merk']			= $this->db->query("select * from merk");
			
			$data['vendor']			= $this->db->query("select * from vendor");

			$data['size_huruf']		= $this->db->query("select * from size_master where type = '1'")->result();

			$data['size_angka']		= $this->db->query("select * from size_master where type = '2'")->result();

			$this->load->view($this->admin_template, $data);



			$this->insert_log('lihat form product');

		}

		

		function add_process()

		{

			$user_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 			= 'Halaman Tambah product | '.$judul;

			$data['heading'] 		= 'Add product';

			$data['form_action'] 	= site_url('admin/product/add_process');

			$data['page']			= 'admin/product/page_form';



			$data['query_tabel']	= $this->db->query("select * from category_product");

			$data['primary_key']	= $this->db->query("SHOW KEYS FROM category_product WHERE Key_name = 'PRIMARY'")->row();

			$data['size_huruf']		= $this->db->query("select * from size_master where type = '1'")->result();

			$data['size_angka']		= $this->db->query("select * from size_master where type = '2'")->result();

			$merk					= $this->input->post('merk');
			
			$vendor					= $this->input->post('pt');
			
			$cek_merk				= $this->db->query("select * from merk where merk_name = '$merk' limit 1");
			
			$cek_vendor				= $this->db->query("select * from vendor where vendor_name = '$vendor' limit 1");
			
			if($cek_merk->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', "Merk tidak ada dalam database");
				redirect(base_url()."admin/product/add");
			}
			else if($cek_vendor->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', "PT tidak ada dalam database");
				redirect(base_url()."admin/product/add");
			}

			//$this->form_validation->set_rules('subcategory_product_id', 'subcategory_product_id', 'required');



			//$this->form_validation->set_rules('category_product_id','category_product_id','required');

		

			$this->form_validation->set_rules('name', 'name', 'required|min_length[3]');	

		

			//$this->form_validation->set_rules('weight', 'weight', 'required');	

		

			//$this->form_validation->set_rules('stock', 'stock', 'required');	

		

			//$this->form_validation->set_rules('price', 'price', 'required');	

		

			//$this->form_validation->set_rules('description', 'description', 'required|min_length[3]');	

		

			if ($this->form_validation->run() == TRUE)

			{

				

				$insert_data = array (

		

								'subcategory_product_id'		=> $this->security->xss_clean($this->input->post('subcategory_product_id')), 

			

								'category_product_id'			=> $this->security->xss_clean($this->input->post('category_product_id')),

								

								'product_name'					=> $this->security->xss_clean($this->input->post('name')), 

								'product_code'					=> $this->security->xss_clean($this->input->post('product_code')), 
								
								'slug'							=> url_title($this->security->xss_clean($this->input->post('name')), 'dash', TRUE),

			

								'weight'						=> $this->security->xss_clean($this->input->post('weight')), 

			

								'stock'							=> $this->security->xss_clean($this->input->post('stock')), 

			

								'price'							=> $this->security->xss_clean($this->input->post('price')), 

			

								'description'					=> $this->security->xss_clean($this->input->post('description')), 

								'release_date'					=> date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('tahun_terbit')) )),
								
								'merk_id'						=> $cek_merk->row()->merk_id,
								
								'vendor_id'						=> $cek_vendor->row()->vendor_id,
								
								'from'							=> $this->input->post('asal'),

								'create_date'					=> date("Y-m-d H:i:s"),

			

								);	

		

				$this->model_utama->insert_data('product', $insert_data);

				

				$subcategory_product	= $this->input->post('subcategory_product_id');

			

				$list_additional		= $this->db->query("select * from subcategory_specific_information where subcategory_product_id = '$subcategory_product'");



				$product_id = $this->model_utama->get_last('create_date','product')->row()->product_id;

				

				if($list_additional->num_rows() > 0)

				{

					foreach($list_additional->result() as $row)

					{

						$insert_additional['product_id']						= $product_id;

						$insert_additional['subcategory_specific_information_id']	= $row->subcategory_specific_information_id;

						$insert_additional['value']								= $this->input->post($row->specific_name);

					}	

	

					$this->model_utama->insert_data('product_detail',$insert_additional);

				}

				



				if(     isset($_POST['size']) 

		            &&  COUNT( $_POST['size'] ) > 0 

		        ){



		            foreach($_POST['size'] as $val)

		            {

		                $insert_size['product_id']      = $product_id;

		                $insert_size['size_id']         = $val;

		                

		                $this->model_utama->insert_data('product_size_master',$insert_size);

		            }



		        }





		        if(     isset($_POST['size2']) 

		            &&  COUNT( $_POST['size2'] ) > 0 

		        ){

		            

		            foreach($_POST['size2'] as $val)

		            {

		                $insert_size['product_id']      = $product_id;

		                $insert_size['size_id']         = $val;

		                

		                $this->model_utama->insert_data('product_size_master',$insert_size);

		            }

		        }

	

				$this->session->set_flashdata('success', 'Data berhasil disimpan!');

					

				$this->insert_log('tambah data product');

				redirect('admin/product/update/'.$product_id);

			}

			else

			{

				$this->load->view($this->admin_template, $data);

			}

		}

		

		function delete($kode)

		{

			$log['user_id']				= $this->session->userdata('id_user');

			$log['activity']			= 'hapus data product dengan id : '.$kode.'  ';

			$this->model_utama->insert_data('log_user', $log);



			$this->model_utama->delete_data($kode, 'product_id','product');

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');

			redirect('admin/product');

		}

		

		function update($kode)

		{

			$user_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 		= 'Halaman Ubah product | '.$judul;

			$data['heading'] 		= 'Update product';

			$data['form_action'] 	= site_url('admin/product/update_process');

				

			$data['query_tabel']	= $this->db->query("select * from category_product");

			$data['primary_key']	= $this->db->query("SHOW KEYS FROM category_product WHERE Key_name = 'PRIMARY'")->row();

			$data['product_picture']= $this->db->query("select * from product_picture where product_id = '$kode'");

			$data['size_huruf']		= $this->db->query("select * from size_master where type = '1'")->result();

			$data['size_angka']		= $this->db->query("select * from size_master where type = '2'")->result();

			

			$wew = $this->db->query("select * from product left join vendor on vendor.vendor_id = product.vendor_id left join merk on merk.merk_id = product.merk_id where product.product_id = '$kode'")->row();

			$wew->subcategory_product_id	= ($wew->subcategory_product_id != "" ? $wew->subcategory_product_id : 0);

			$subcategory_product			= $this->db->query('select * from subcategory_product,category_product where subcategory_product.category_product_id = category_product.category_product_id and subcategory_product.subcategory_product_id = "'.$wew->subcategory_product_id.'" limit 1');

			$this->session->set_userdata('kd_update', $wew->product_id);

		

			$data['default']['category_product_id']				= ($subcategory_product->num_rows() > 0 ? $subcategory_product->row()->category_product_id : "");

		

			$data['default']['category_product_name']				= ($subcategory_product->num_rows() > 0 ? $subcategory_product->row()->category_product_name : "");

			

			$data['default']['subcategory_product_name']				= ($subcategory_product->num_rows() > 0 ? $subcategory_product->row()->subcategory_product_name : "");

			$data['default']['subcategory_product_id']		 	= $wew->subcategory_product_id;	
			$data['default']['name']		 	= $wew->product_name;	
			$data['default']['weight']		 	= $wew->weight;	
			$data['default']['stock']		 	= $wew->stock;
			$data['default']['price']		 	= $wew->price;	
			$data['default']['description']		= $wew->description;			
			$data['default']['merk_name']		= $wew->merk_name;
			$data['default']['vendor_name']		= $wew->vendor_name;
			
			$list_size				= $this->db->query("select * from product_size_master where product_id = '$wew->product_id'");

			

			$data['default']['size'] = array();

			

			foreach($list_size->result() as $row)

			{

				array_push($data['default']['size'], $row->size_id);

			}

		

			$sql 					=	"SELECT * 

										FROM subcategory_specific_information AS s

										LEFT JOIN product_detail AS p

										ON s.subcategory_specific_information_id = p.subcategory_specific_information_id 

										WHERE s.subcategory_product_id = ".$wew->subcategory_product_id

										. " AND p.product_id =".$kode;

			$list_additional		= 	$this->db->query($sql);



				/*echo "<pre>";

					print_r($list_additional->result());

				echo "</pre>";

				die();

			*/



			

			foreach($list_additional->result() as $row)

			{

				$data['default']['additional'.$row->subcategory_specific_information_id]		= $row->value;

			}

			

			$data['list_additional'] = $list_additional;

			

			$data['page']			= 'admin/product/page_form_update';

			$this->load->view($this->admin_template, $data);



			$this->insert_log('klik ubah data category dengan id : '.$kode);

			

		}

		

		function update_process()

		{

			$user_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 			= 'Halaman Ubah product | '.$judul;

			$data['heading'] 		= 'Update product';

			$data['form_action'] 	= site_url('admin/product/update_process');

			$merk					= $this->input->post('merk');
			
			$vendor					= $this->input->post('pt');
			
			$cek_merk				= $this->db->query("select * from merk where merk_name = '$merk' limit 1");
			
			$cek_vendor				= $this->db->query("select * from vendor where vendor_name = '$vendor' limit 1");
			
			if($cek_merk->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', "Merk tidak ada dalam database");
				redirect(base_url()."admin/product/update/".$this->session->userdata('kd_update'));
			}
			else if($cek_vendor->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', "PT tidak ada dalam database");
				redirect(base_url()."admin/product/update/".$this->session->userdata('kd_update'));
			}

			$this->form_validation->set_rules('subcategory_product_id', 'subcategory_product_id', 'required');	

			$this->form_validation->set_rules('category_product_id','category_product_id','required');

			$this->form_validation->set_rules('name', 'name', 'required|min_length[3]');	

			$this->form_validation->set_rules('weight', 'weight', 'required');	

			$this->form_validation->set_rules('stock', 'stock', 'required');	

			$this->form_validation->set_rules('price', 'price', 'required');	

			$this->form_validation->set_rules('description', 'description', 'required|min_length[3]');	

			if ($this->form_validation->run() == TRUE)

			{

				$update_data = array (

			

								'subcategory_product_id'				=> $this->security->xss_clean($this->input->post('subcategory_product_id')), 

								

								'category_product_id'					=> $this->security->xss_clean($this->input->post('category_product_id')),

			

								'product_name'							=> $this->security->xss_clean($this->input->post('name')), 

								

								'slug'									=> url_title($this->security->xss_clean($this->input->post('name')), 'dash', TRUE),

			

								'weight'								=> $this->security->xss_clean($this->input->post('weight')), 

			

								'stock'									=> $this->security->xss_clean($this->input->post('stock')), 

			

								'price'									=> $this->security->xss_clean($this->input->post('price')), 

			

								'description'							=> $this->security->xss_clean($this->input->post('description')), 

								'vendor_id'								=> $cek_vendor->row()->vendor_id,
								
								'merk_id'								=> $cek_merk->row()->merk_id,
								
								);

					

				$this->model_utama->update_data($this->session->userdata('kd_update'),'product_id','product',$update_data);

				

				$product_id = $this->session->userdata('kd_update');

				$subcategory_product		= $this->security->xss_clean($this->input->post('subcategory_product_id'));

				

				$this->db->query("delete from product_detail where product_id = '$product_id'");

				

				$list_additional		= $this->db->query("select * from subcategory_specific_information where subcategory_product_id = '$subcategory_product'");





				

				if($list_additional->num_rows() > 0)

				{

					foreach($list_additional->result() as $row)

					{

					

						$insert_additional['product_id']					   = $product_id;

						$insert_additional['subcategory_specific_information_id'] = $category_specific_information_id = $row->subcategory_specific_information_id;

						$insert_additional['value']							   = $this->security->xss_clean($this->input->post('specific'.$row->subcategory_specific_information_id));

					

						$this->model_utama->insert_data('product_detail',$insert_additional);

					}	

				}



				$this->db->query("delete from product_size_master where product_id = '$product_id'");

				

				if(     isset($_POST['size']) 

		            &&  COUNT( $_POST['size'] ) > 0 

		        ){



		            foreach($_POST['size'] as $val)

		            {

		                $insert_size['product_id']      = $product_id;

		                $insert_size['size_id']         = $val;

		                

		                $this->model_utama->insert_data('product_size_master',$insert_size);

		            }



		        }





		        if(     isset($_POST['size2']) 

		            &&  COUNT( $_POST['size2'] ) > 0 

		        ){

		            

		            foreach($_POST['size2'] as $val)

		            {

		                $insert_size['product_id']      = $product_id;

		                $insert_size['size_id']         = $val;

		                

		                $this->model_utama->insert_data('product_size_master',$insert_size);

		            }

		        }



				$this->session->set_flashdata('success', 'Data berhasil diupdate!');

				

				$log['user_id']			= $user_id;

				$log['activity']			= 'ubah data product dengan id : '.$this->session->userdata('kd_update').'  ';

				$this->model_utama->insert_data('log_user', $log);

	

				// redirect('admin/category/update/'.$this->session->userdata('kd_update'));

				$this->session->set_flashdata('success', 'Data Berhasil diupdate!');

				redirect('admin/product/update/'.$this->session->userdata('kd_update'));

				

			}

			else

			{

				$this->session->set_flashdata('danger', 'Data gagal diupdate!');

				redirect('admin/product/update/'.$this->session->userdata('kd_update'));

			}

		}

		

		function insert_log($activity)

		{

			$log['user_id']			= $this->session->userdata('id_user');

			$log['activity']		= $this->security->xss_clean($activity);

			$this->model_utama->insert_data('log_user', $log);

		}

		

		function get_subcategory()

		{

			$category					= $this->security->xss_clean($this->input->post("categoryId"));

			$list_subcategory			= $this->db->query("select * from subcategory_product where category_product_id = '$category'");

			

			$html		= '<option value="">-- Choose Subcategory --</option>';

			

			foreach($list_subcategory->result() as $row)

			{

				$html	.= '<option value="'.$row->subcategory_product_id.'">'.$row->subcategory_product_name.'</option>';

			}

			

			echo $html;

		}

		

		function get_additional_info()

		{

			$subcategory_product	= $this->security->xss_clean($this->input->post("subcategoryId"));

			$list_additional		= $this->db->query("select * from subcategory_specific_information where subcategory_product_id = '$subcategory_product'");

			

			$form_element			= "";

			

			foreach($list_additional->result() as $row)

			{

				$form_element		.= '<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

                            <div class="row">

                                <label class="col-sm-2 control-label">'.ucwords($row->specific_name).'</label>

                                <div class="col-sm-8">

                                    

								<input type="text" name="'.$row->specific_name.'" class="form-control" placeholder="'.$row->specific_name.'">

                                </div>

                            </div>

						</div>';

			}

			

			echo $form_element;

		}

		

		function add_picture()

		{

			$upload_path		= 	'./uploads/product/'.$this->session->userdata('kd_update');

			$allowed_types		=	'gif|jpg|png|jpeg';

			$file_name			= 	'product_picture'; 

			$file_dokumen 		= 	$this->upload_files($upload_path,$allowed_types,$file_name);

			

			if( $file_dokumen != '' ){

				$insert_data['product_id']			= $this->session->userdata('kd_update');

				$insert_data['product_picture']		= $file_dokumen;

				$insert_data['picture_highlight'] 	= 'no';

				$insert_data['create_date']			= date("Y-m-d H:i:s");

				

				$this->model_utama->insert_data('product_picture', $insert_data);

				

				$this->session->set_flashdata('success', 'Data Berhasil diupdate!');

			}

			else

			{

				$this->session->set_flashdata('Danger', 'Data Gagal diupdate!');

			}

			

			redirect('admin/product/update/'.$this->session->userdata('kd_update'));

		}

		

		function set_cover_picture($product_picture_id,$product_id)

		{

			$set_none['picture_highlight']	= 'no';

			$this->model_utama->update_data($product_id,'product_id','product_picture',$set_none);

			

			$set_cover['picture_highlight']	= 'yes';

			$this->model_utama->update_data($product_picture_id,'product_picture_id','product_picture',$set_cover);

		

			redirect('admin/product/update/'.$this->session->userdata('kd_update'));

		}

		

		function delete_picture($product_picture_id)

		{

			$picture		= $this->db->query("select * from product_picture where product_picture_id = '$product_picture_id' limit 1");

			if($picture->num_rows() == 0)

			{

				$this->session->set_flashdata('danger', "The Picture doesn't exist!");

				redirect('admin/product/update/'.$this->session->userdata('kd_update'));

			}

			else

			{

				$Path 	= './uploads/product/'.$picture->row()->product_id.'/'.$picture->row()->product_picture;

				$Path2 	= './uploads/product/'.$picture->row()->product_id.'/thumb_'.$picture->row()->product_picture;

				unlink($Path);

				unlink($Path2);

				

				$this->db->query("delete from product_picture where product_picture_id = '$product_picture_id'");

			

				$this->session->set_flashdata('success', "The Picture Successfully Deleted!");

				redirect('admin/product/update/'.$this->session->userdata('kd_update'));

			}

		}

		

		function upload_files($upload_path,$allowed_types,$file_name,$remove_space=''){

	

			//if($this->session->userdata('login_pelaksana') == true ){



				$config['upload_path'] 		= $upload_path;

				$config['allowed_types'] 	= $allowed_types;

				if( $remove_space != '' ){

					$config['remove_spaces'] 	= $remove_space;	

				}

				$this->load->library('upload', $config);

				

				if( !is_dir($upload_path) ){

					mkdir($upload_path, 0777, true);

					

				}

				

				if ( !$this->upload->do_upload($file_name) ){

					$file_dokumen	= '';

				}else{

					$dokumen		= $this->upload->data();

					$file_dokumen	= $dokumen['file_name'];

				}



				if( 	$file_dokumen != ''

					&&	( stripos($file_dokumen,'jpg') > 0	||	stripos($file_dokumen,'png') > 0 )

				){

					$config_array = array(

											'upload_path'	=>	$upload_path,

											'image_name'	=>	$file_dokumen	

										);

					$this->image_manipulation($config_array);

				}

				return $file_dokumen;

			//}

			//else

			//{

			//	redirect('login');

			//}

		}

		

		function image_manipulation($config_array){





			$this->load->library('image_lib');

	 



			$config['image_library']    = 'gd2';

			$config['source_image']     = $config_array['upload_path'].'/'.$config_array['image_name'];

			$config['new_image']        = $config_array['upload_path'].'/thumb_'.$config_array['image_name'];

			$config['create_thumb'] 	= TRUE;

			$config['maintain_ratio']   = TRUE;

			$config['width']            = 250;

			$config['quality'] 			= 60;

			$config['thumb_marker'] 	= '';

			$this->image_lib->initialize($config);

			$this->image_lib->resize();

			$this->image_lib->clear();



		}
		
		public function product_pagination_admin(	$limit,


												$base_url,


												$total_row,


												$uri_segment


	){


		


		$session_show_total_product = $this->session->userdata('show_total_product');


		if( 	isset($session_show_total_product) 


			&& 	$session_show_total_product != ''


		){


			$limit = $this->security->xss_clean($session_show_total_product);


		}	





		$this->load->library('pagination');


		$config['full_tag_open'] 	= '<ul class="pagination">';


		$config['full_tag_close'] 	= '<ul>';


		$config['first_tag_open'] 	= '<li>';


		$config['first_tag_close'] 	= '</li>';


		$config['last_tag_open'] 	= '<li>';


		$config['last_tag_close'] 	= '</li>';


		$config['next_tag_open'] 	= '<li>';


		$config['next_tag_close'] 	= '</li>';


		$config['prev_tag_open'] 	= '<li>';


		$config['prev_tag_close'] 	= '</li>';


		$config['cur_tag_open'] 	= '<li><a class="active">';


		$config['cur_tag_close'] 	= '</a></li>';


		$config['num_tag_open'] 	= '<li>';


		$config['num_tag_close'] 	= '</li>';


		$config['base_url'] 		= $base_url;


		$config['total_rows'] 		= $total_row;


		$config['per_page'] 		= $limit; 


		$config['uri_segment'] 		= $uri_segment;


		$this->pagination->initialize($config); 


	}	
	
	public function load_product( $start, 

                                        $limit, $where=""

    ){

        

        $order_by   = "ORDER BY product.product_name ASC";

        $filter     = $this->sort_and_limit_filter_helper(  $limit,

                                                            $order_by

                                                            );

        $order_by   = $filter['order_by'];

        $limit      = $filter['limit'];

        



        /*========================================================

            3.  SQL 

        ========================================================*/

		$sql = "select * from product left join subcategory_product on subcategory_product.subcategory_product_id = product.subcategory_product_id left join category_product on category_product.category_product_id = subcategory_product.category_product_id left join merk on product.merk_id = merk.merk_id ".$where." " .$order_by. " LIMIT ".$start.",".$limit;
		
        /* $sql    =   "SELECT 

                        p.product_id,

                        p.product_name,

                        p.description,

                        p.slug,

                        p.price,

                        pp.product_picture

                    FROM product AS p 

                    LEFT JOIN product_picture AS pp 

                    ON p.product_id = pp.product_id 

                    WHERE p.stock !=0 " 

                    .$order_by. 

                    " LIMIT ".$start.",".$limit;
 */


        return $sql;

    }

}	

		