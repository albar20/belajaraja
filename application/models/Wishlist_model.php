<?php

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class wishlist_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function index( $customer_id ){

    	$sql           =   "SELECT 
                                p.product_id,
                                p.product_name,
                                p.price, 
                                p.slug,
                                p.description,
                                pp.product_picture
                            FROM wishlists AS w 
                            LEFT JOIN product AS p  
                            ON w.product_id = p.product_id
                            LEFT JOIN product_picture as pp 
                            ON p.product_id = pp.product_id

                            WHERE customer_id=".$customer_id
                            ." ORDER BY w.create_date";

        $data['wishlist'] = $this->db->query($sql);
		return $data;
    }

    function delete( $product_id ){

        $sql            =   "DELETE
                            FROM wishlists 
                            WHERE product_id=".$product_id;                            
        if( $this->db->query($sql) ){
            return true; 
        }else{
            return false;
        }
    }

}