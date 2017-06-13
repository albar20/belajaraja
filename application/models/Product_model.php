<?php

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class product_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function additional_info_and_size($product){

    	$data['additional_info']= $this->db->query("select * from subcategory_specific_information as ssi left join product_detail as pd  on ssi.subcategory_specific_information_id = pd.subcategory_specific_information_id where ssi.subcategory_product_id = '$product->subcategory_product_id'");
        $data['size']           = $this->db->query("select * from product_size_master as p,size_master as s where p.size_id = s.size_id and p.product_id = '$product->product_id'");
		
		return $data;
    }



    function get_product_by_category(   $subcategory_product_slug,
                                        $order_by,
                                        $start,
                                        $limit  
    ){

        $sql                    =   "SELECT 
                                        p.product_id,
                                        p.product_name,
                                        p.description,
                                        p.slug,
                                        p.price,
                                        pp.product_picture,
                                        c.slug AS subcategory_product_slug
                                    FROM product AS p 
                                    LEFT JOIN product_picture AS pp 
                                    ON p.product_id = pp.product_id 
                                    INNER JOIN subcategory_product AS c 
                                    ON p.subcategory_product_id = c.subcategory_product_id
                                    WHERE c.slug='".$subcategory_product_slug
                                    ."' "
                                    .$order_by.
                                    " LIMIT ".$start.",".$limit;
        $data['product_list']   = $this->db->query($sql);   
    
        return $data;
    }


    


}