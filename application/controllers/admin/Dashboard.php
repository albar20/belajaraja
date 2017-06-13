<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*

 *

 * @author	M.Fadli Prathama (09081003031)

 *  email : m.fadliprathama@gmail.com

 *

 */



class dashboard extends MY_Controller {

	



	/*===================================================

		1.	GET DATA            

	===================================================*/

	public function index()

	{	

		if($this->session->userdata('login_admin') == true)

		{

			$admin_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 			= 'Halaman Beranda | '.$judul;

			$data['heading'] 		= 'Dashboard Beranda';

			$data['page']					= 'admin/page_dashboard';

			$data['display_chart_format']	= ''; 	

			

			/*===================================================

				1.	GET DATA 

					1.  total sales                                                                                

		            2.  total sales this year                                                                      

		            3.  total orders                                                                               

		            4.  total payments                                                                             

		            5.  Numbers of Customers                                                                       

		            6.  Customers Awaiting Approval                                                      

		            7.  Reviews Awaiting Approval                                                                  

		            8.  Latest Order              

			===================================================*/



				/*===================================================

					1.  total sales

				===================================================*/





				/*===================================================

					2.  total sales this year          

				===================================================*/





				/*===================================================

					3.  total orders 

						1.	FOR CHART 

						2.	FOR total orders

				===================================================*/



					/*===================================================

						1.	FOR CHART

							1.	SET DISPLAY

							1.	for year

							2.	for month 

							3.	for days 

							4.	for one day ( 24 hours ) 

					===================================================*/

					if( isset($_POST['tanggal_order_mulai']) ){

						//$_POST['tanggal_order_mulai'] = '11-03-2016';

						//$_POST['tanggal_order_akhir'] = '11-11-2016';

						$sql_date_format 	= "o.order_date";

						$where_filter		= '';

						$tom 				= $_POST['tanggal_order_mulai'];

						$toa 				= $_POST['tanggal_order_akhir'];

					}else{

						$five_months_ago	= strtotime("today") - 15558000;

						$tom 				= date('d-m-Y',$five_months_ago);

						$toa 				= date('d-m-Y',strtotime("today"));

					}





					if( 	isset($tom) 

						&& 	$tom != ''	

					){

						$tom_seconds  = strtotime($tom);

						$toa_seconds  = strtotime("today");

						if( 	isset($toa) 

							&& 	$toa != ''	

						){

							$toa_seconds =  strtotime($toa);

						}



						/*===================================================

							1.	SET DISPLAY

								1.	YEAR

								2.	MONTH

								3.	DAYS

								4.	ONE DAY ( 24 HOURS )

						===================================================*/	

						if( strtotime($toa) >= strtotime($tom) ){

							

							/*===================================================

								1.	YEAR

							===================================================*/	

							if( strtotime($toa) - strtotime($tom) > 31449600 ){

								$display 			= 'year';

								$sql_date_format 	= 'YEAR(o.order_date)';

							}



							/*===================================================

								2.	MONTH

							===================================================*/	

							if( 	(strtotime($toa) - strtotime($tom) <= 31449600) 

								&&	(strtotime($toa) - strtotime($tom) >= 5184000) 	

							){

								$display = 'month';

								$sql_date_format 	= 'DATE_FORMAT(o.order_date,"%Y-%m-%d")';

							}



							/*===================================================

								3.	DAYS

							===================================================*/	

							if( 	(strtotime($toa) - strtotime($tom) < 5184000) 

								&&	(strtotime($toa) - strtotime($tom) >= 2592000) 	

							){

								$display = 'day';

								$sql_date_format 	= 'DATE_FORMAT(o.order_date, "%Y-%m-%d")';

							}



							/*===================================================

								4.	ONE DAY ( 24 HOURS )

							===================================================*/	

							if( (strtotime($toa) - strtotime($tom) < 2592000) ){

								$display = 'hour';

								//$sql_date_format 	= "HOUR(o.order_date)";

								$sql_date_format 	= 'DATE_FORMAT(o.order_date, "%Y-%m-%d %H:%i:%s")';

							}



						}else{

							echo 'Tanggal order mulai harus lebih awal dari hari ini dan tanggal order akhir';



						}

						

						$tom_date 		= date('Y-m-d',$tom_seconds)." 00:00:00";	

						$toa_date 		= date('Y-m-d',$toa_seconds)." 23:59:59";

						$where_filter 	= " WHERE o.order_date >= '".$tom_date."'";

						$where_filter 	.= " AND o.order_date <= '".$toa_date."'"; 

					}	



						$data['display_chart_format'] 	=	$display;

						//$data['display_chart_format'] 	=	'hour';




							

						

						






			

							// echo "<pre>";

							// 	echo $data['display_chart_format'];

							// 	print_r( $to_bd );

							// 	print_r( $data['total_order_by_date']->result_array() );

							// 	print_r( $data['total_order_by_dates'] );

							// echo "</pre>";

							// die();



					



					/*===================================================

						2.	FOR total orders

					===================================================*/

					
						

				





					/*===================================================

						3.	WAITING APPROVAL

							on , my_controller.php

							$this->total_order_waiting_approval = $total_order_confirm->total_order_confirm;

					===================================================*/





				





				/*===================================================

					4.  total payments       

				===================================================*/

				




				/*===================================================

					5.  Numbers of Customers        

				===================================================*/

				$sql 						= 	"SELECT count(customer_id) as total_customers

												FROM customers  

												WHERE customer_account_status='1'

												";

				$data['total_customers']	= $this->db->query($sql);



				/*===================================================

					6.  Customers Awaiting Approval       

				===================================================*/

				$sql 						= 	"SELECT count(customer_id) as total_customers

												FROM customers  

												WHERE customer_account_status='0'

												";

				$data['total_customers_waitin_approval']	= $this->db->query($sql);	



				/*===================================================

					7.  Reviews Awaiting Approval        

				===================================================*/



				/*===================================================

					8.  Latest Order         

				===================================================*/

				



				/*echo "<pre>";

						print_r($data['total_sales']->result_array());

						print_r($data['total_sales_this_year']->result_array());

						print_r($data['total_order']->result_array());

						print_r($data['total_payments']->result_array());

						print_r($data['total_customers']->result_array());

						print_r($data['total_customers_waitin_approval']->result_array());

						print_r($data['latest_order']->result_array());

					echo "</pre>";

					die();*/





			$this->load->view($this->admin_template, $data);



			$log['user_id']			= $this->session->userdata('id_user');

			$log['activity']		= "lihat dashboard";

			$this->model_utama->insert_data('log_user', $log);

		}

		else

		{

			redirect('login');

		}

	}

	

	function bonus_voucher()

	{

		if($this->session->userdata('login_admin') == true)

		{

			$admin_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 			= 'Halaman Beranda | '.$judul;

			$data['heading'] 		= 'Dashboard Beranda';

			$data['page']			= 'admin/dashboard/page_bonus';

			$data['bulan_ini_list']	= $this->model_utama->cek_order('bulan_ini','tipe','create_date','desc','bonus_voucher');

			$data['bulan_depan_list']	= $this->model_utama->cek_order('bulan_depan','tipe','create_date','desc','bonus_voucher');

			$data['banner_gratis_list']	= $this->model_utama->cek_order('banner_gratis_materi','tipe','create_date','desc','bonus_voucher');

			$this->load->view($this->admin_template, $data);



			$log['user_id']			= $this->session->userdata('id_user');

			$log['activity']		= "lihat dashboard";

			$this->model_utama->insert_data('log_user', $log);

		}

		else

		{

			redirect('login');

		}

	}



	function beconnected()

	{

		if($this->session->userdata('login_admin') == true)

		{

			$admin_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 			= 'Beconnected | '.$judul;

			$data['heading'] 		= 'Beconnected';

			$data['page']			= 'admin/dashboard/page_beconnected';

			$data['beconnected_list']	= $this->model_utama->get_data('registrasi_beconnected');

			$this->load->view($this->admin_template, $data);



			$log['user_id']			= $this->session->userdata('id_user');

			$log['activity']		= "lihat dashboard";

			$this->model_utama->insert_data('log_user', $log);

		}

		else

		{

			redirect('login');

		}

	}

}



