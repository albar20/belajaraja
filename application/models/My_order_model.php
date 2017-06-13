<?php

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class my_order_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function index( $customer_id ){

    	$sql               =   "SELECT 
                                    order_id,
                                    DATE_FORMAT(order_date,'%d-%m-%Y') as order_date,
                                    order_status,
                                    order_total
                                FROM order_master
                                WHERE customer_id=".$customer_id
                                ." AND order_status='pending'";
        $data['pending']    = $this->db->query($sql);

        $sql                =   "SELECT 
                                    order_id,
                                    DATE_FORMAT(order_date,'%d-%m-%Y') as order_date,
                                    order_status,
                                    order_total
                                FROM order_master
                                WHERE customer_id=".$customer_id
                                ." AND order_status='confirm'";
        $data['confirm']    = $this->db->query($sql);

        $sql                =   "SELECT 
                                    order_id,
                                    DATE_FORMAT(order_date,'%d-%m-%Y') as order_date,
                                    order_status,
                                    order_total
                                FROM order_master
                                WHERE customer_id=".$customer_id
                                ." AND order_status='approve'";     
        $data['approve']    = $this->db->query($sql);                                       

        $sql                =   "SELECT 
                                    order_id,
                                    DATE_FORMAT(order_date,'%d-%m-%Y') as order_date,
                                    order_status,
                                    order_total,
                                    rekening_salah,
                                    nominal_salah
                                FROM order_master
                                WHERE customer_id=".$customer_id
                                ." AND order_status='cancel'";  
        $data['cancel']     = $this->db->query($sql);   
		
		return $data;
    }


    function lihat_pemesanan( $order_id ){

        $sql                    =   "SELECT 
                                        o.order_id,
                                        DATE_FORMAT(o.order_date,'%d-%m-%Y') as order_date,
                                        o.order_status,
                                        o.order_shipping_charge,
                                        o.order_discount,
                                        o.order_total,
                                        o.order_courier,
                                        a.nama_penerima,
                                        a.no_telepon,
                                        a.alamat_lengkap,
                                        a.kode_pos,
                                        a.province_id,
                                        a.city_id,
                                        op.product_qty,
                                        p.product_name,
                                        p.description AS product_description,
                                        p.price AS product_price
                                    FROM order_master AS o
                                    INNER JOIN order_products AS op
                                    ON o.order_id = op.order_id
                                    INNER JOIN customer_address AS a 
                                    ON o.customer_address_id = a.customer_address_id
                                    INNER JOIN product AS p 
                                    ON op.product_id = p.product_id
                                    WHERE o.order_id='".$this->security->xss_clean($order_id)."'";
        $data['lihat_pemesanan'] =  $this->db->query($sql);

        $this->load->library('rajaongkir');
        $data_pemesanan         = $data['lihat_pemesanan']->result();
        $data['raja_ongkir']    = json_decode($this->rajaongkir->city_detail($data_pemesanan[0]->city_id), true);

        return $data;
    }



}