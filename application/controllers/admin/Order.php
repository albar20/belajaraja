<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class Order extends MY_Controller {
	
	public function index(){
	
		
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Order | '.$judul;
			$data['heading'] 		= "Order List";
			$data['page']			= 'admin/order/order_list';
		
			$sql 			= 	"SELECT 
									o.order_id,
									DATE_FORMAT(o.order_date,'%d-%m-%Y') as order_date,
									o.order_status,
									o.order_total,
									c.customer_fname
								FROM order_master AS o
								INNER JOIN customers AS c 
								ON o.customer_id = c.customer_id
								WHERE o.order_status = 'pending'
								ORDER BY o.order_date DESC";
			$data['order_pending'] = $this->db->query($sql);

			$sql 			= 	"SELECT 
									o.order_id,
									DATE_FORMAT(o.order_date,'%d-%m-%Y') as order_date,
									o.order_status,
									o.order_total,
									c.customer_fname
								FROM order_master AS o
								INNER JOIN customers AS c 
								ON o.customer_id = c.customer_id
								WHERE o.order_status = 'confirm'
								ORDER BY o.order_date DESC";
			$data['order_confirm'] = $this->db->query($sql);

			$sql 			= 	"SELECT 
									o.order_id,
									DATE_FORMAT(o.order_date,'%d-%m-%Y') as order_date,
									o.order_status,
									o.order_total,
									c.customer_fname
								FROM order_master AS o
								INNER JOIN customers AS c 
								ON o.customer_id = c.customer_id
								WHERE o.order_status = 'approve'
								ORDER BY o.order_date DESC";
			$data['order_approve'] = $this->db->query($sql);

			$sql 			= 	"SELECT 
									o.order_id,
									DATE_FORMAT(o.order_date,'%d-%m-%Y') as order_date,
									o.order_status,
									o.order_total,
									o.rekening_salah,
									o.nominal_salah,
									c.customer_fname
								FROM order_master AS o
								INNER JOIN customers AS c 
								ON o.customer_id = c.customer_id
								WHERE o.order_status = 'cancel'
								ORDER BY o.order_date DESC";
			$data['order_cancel'] = $this->db->query($sql);

			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat customer";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}


	public function lihat_pemesanan( $order_id ){

		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Order Details | '.$judul;
		$data['heading'] 		= "Order Detail";
		$data['page']			= 'admin/order/lihat_pemesanan';
		$sql 					= 	"SELECT 
										o.order_id,
										DATE_FORMAT(o.order_date,'%d-%m-%Y') as order_date,
										o.order_status,
										o.order_total,
										o.order_courier,
										o.order_shipping_charge,
										o.order_discount,
										a.nama_penerima,
										a.no_telepon,
										a.alamat_lengkap,
										a.kode_pos,
										a.province_id,
										a.city_id,
										op.product_qty,
										op.size_label,
										c.customer_id,
										c.customer_fname,
										p.product_name,
										p.description AS product_description,
										p.price AS product_price,
										pm.bukti_transfer
									FROM order_master AS o
									INNER JOIN order_products AS op
									ON o.order_id = op.order_id
									INNER JOIN customers AS c
									ON o.customer_id = c.customer_id
									INNER JOIN customer_address AS a 
									ON o.customer_address_id = a.customer_address_id
									INNER JOIN product AS p 
									ON op.product_id = p.product_id
									LEFT JOIN payment_master AS pm 
									ON o.order_id = pm.order_id
									WHERE o.order_id='".$this->security->xss_clean($order_id)."'";
		$data['lihat_pemesanan'] = 	$this->db->query($sql);	

		$this->load->library('rajaongkir');
		$data_pemesanan 		= $data['lihat_pemesanan']->result();
		$data['raja_ongkir'] 	= json_decode($this->rajaongkir->city_detail($data_pemesanan[0]->city_id), true);

		$this->load->view($this->admin_template, $data);

	}

	public function konfirmasi_pembayaran( $order_id ){

		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Menyetujui konfirmasi Pembayaran | '.$judul;
		$data['heading'] 		= "Menyetujui konfirmasi Pembayaran";
		$data['page']			= 'admin/order/konfirmasi_pembayaran';
		$sql 							= 	"SELECT 
												o.order_id,
												o.order_status,
												pm.payment_id,
												pm.nama_pengirim,
												pm.bukti_transfer,
												pm.payment_amount,
												DATE_FORMAT(pm.payment_date,'%d-%m-%Y') as payment_date,
												b.nama_bank,
												b.no_rekening,
												b.nama_pemilik_rekening
											FROM order_master AS o
											INNER JOIN payment_master AS pm
											ON o.order_id = pm.order_id
											INNER JOIN bank as b 
											ON pm.bank_id = b.bank_id
											WHERE o.order_id='".$this->security->xss_clean($order_id)."'";
		$data['kofirmasi_pembayaran'] 	= 	$this->db->query($sql);
		$this->load->view($this->admin_template, $data);	

	}

	public function menyetujui_konfirmasi_pembayaran( $order_id ){

	
		$sql 		= 	"UPDATE order_master
						SET order_status ='approve' 
						WHERE order_id='".$this->security->xss_clean($order_id)."'
						AND order_status = 'confirm'";
		$approval   =  $this->db->query($sql);

		if( $approval ){
		
			$sql 		= 	"SELECT 
								product_id,
								product_qty
							FROM order_products
							WHERE order_id='".$this->security->xss_clean($order_id)."'";
			$order_product = $this->db->query($sql);


				/*echo "<pre>";
					print_r($order_product->result());
				echo "</pre>";
				die();*/

			if( count($order_product->result()) > 0){	
				foreach( $order_product->result() as $op ){
					$sql 		= 	"UPDATE product 
									SET 
										stock = stock - ".$op->product_qty
									." WHERE product_id=".$op->product_id;
					$this->db->query($sql);	
				}
			}
		}
		
		$this->session->set_flashdata('success', 'Order Sudah Dikonfirmasi!');
		redirect(base_url().'admin/order/konfirmasi_pembayaran/'.$order_id);
	}

	public function cancel_konfirmasi_pembayaran(){
		
		$rekening_salah_sql = '';
		if( isset($_POST['rekening_salah']) ){
			$rekening_salah 		= 	'1';
			$rekening_salah_sql  	= ",rekening_salah='1'"; 
		}
		$nominal_salah_sql 	= '';
		if( isset($_POST['nominal_salah']) ){
			$nominal_salah_sql 		= ",nominal_salah='1'"; 
		}

		$order_id = $this->security->xss_clean($_POST['order_id']);
		$sql 		= 	"UPDATE order_master
						SET 
							order_status ='cancel'
							".$rekening_salah_sql.$nominal_salah_sql."
						WHERE order_id='".$this->security->xss_clean($order_id)."'
						AND order_status = 'confirm'";
		$this->db->query($sql);
		redirect(base_url().'admin/order');

	}

	

}