<?php

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class my_account_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function index( $customer_id ){

    	
        $sql            =   "SELECT 
                                customer_id,
                                customer_fname,
                                customer_lname,
                                customer_sex,
                                customer_birthday,
                                customer_email
                            FROM customers 
                            WHERE customer_id=".$customer_id;
        $data['customer'] = $this->db->query($sql);

        $sql            =   "SELECT 
                                customer_address_id,
                                nama_penerima,
                                no_telepon,
                                alamat_lengkap,
                                kode_pos,
                                default_column
                            FROM customer_address 
                            WHERE customer_id=".$customer_id;
        $data['customer_address'] = $this->db->query($sql);

        $this->load->library('rajaongkir');
        $all_province   = json_decode($this->rajaongkir->all_province(), true);
        $data['province']   = $all_province['rajaongkir']['results'];
		
		return $data;
    }

    function edit_customer( $customer_id ){

        $customer_data = $this->db->query("SELECT * FROM customers WHERE customer_id=".$customer_id)->row();
        $data['default']['customer_fname']      = $customer_data->customer_fname;
        $data['default']['customer_lname']      = $customer_data->customer_lname;
        $data['default']['customer_sex']        = $customer_data->customer_sex;
        $data['default']['customer_birthday']   = $customer_data->customer_birthday;
        $data['default']['customer_photo']      = $customer_data->customer_photo;

        return $data;
    }

    function get_customer_address_data(){
        $customer_address_id    =   $this->security->xss_clean($this->input->post('customer_address_id'));
        $sql                    =   "SELECT 
                                        *
                                    FROM customer_address
                                    WHERE customer_address_id=".$customer_address_id ;
        $data['customer_address'] = $this->db->query($sql);
        return $data;
    }



    



}