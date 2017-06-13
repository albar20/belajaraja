<?php

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class contact_model extends CI_Model {
	function insert_contact_gmail($contact_email)
	{
		$this->db->set('contact_email', $contact_email);
		$this->db->insert('gmail_contact');
	}
}