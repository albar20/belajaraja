<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
// link nya : https://accounts.google.com/o/oauth2/auth?client_id=618217893352-qkhrvhhbh0jg0mdscc0v4ovhg2n81gh5.apps.googleusercontent.com&redirect_uri=http://www.babastudio.com/oauth2callback&scope=https://www.google.com/m8/feeds/&response_type=code

class Google extends MY_Controller {

	public function index()
	{
		$Google_api_client_id = "618217893352-qkhrvhhbh0jg0mdscc0v4ovhg2n81gh5.apps.googleusercontent.com";
		$Google_client_secret = "OBGKm5IR0u2Ex-uQPMu7hyP8";
		$Google_redirect_url = "http://www.babastudio.com/oauth2callback"; // redirect url mentioned in aapi console
		$Google_contact_max_result = "100"; // integer value
		$authcode= $_GET["code"];
		$clientid=$Google_api_client_id;
		$clientsecret=$Google_client_secret;
		$redirecturi=$Google_redirect_url;
		$fields=array(
		'code'=>  urlencode($authcode),
		'client_id'=>  urlencode($clientid),
		'client_secret'=>  urlencode($clientsecret),
		'redirect_uri'=>  urlencode($redirecturi),
		'grant_type'=>  urlencode('authorization_code')
		);
		$fields_string="";
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		$fields_string=rtrim($fields_string,'&');
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
		curl_setopt($ch,CURLOPT_POST,5);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		// Set so curl_exec returns the result instead of outputting it.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//to trust any ssl certificates
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//execute post
		$result = curl_exec($ch);
		//close connection
		curl_close($ch);
		//extracting access_token from response string
		$response   =  json_decode($result);
		$accesstoken= $response->access_token;
		if( $accesstoken!="")
		$_SESSION['token']= $accesstoken;
		//passing accesstoken to obtain contact details
		$xmlresponse=  file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?&max-results='.$Google_contact_max_result .'&oauth_token='.$_SESSION['token']);
		//reading xml using SimpleXML
		$xml=  new SimpleXMLElement($xmlresponse);
		$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2008');
		$result = $xml->xpath('//gd:email');
		$count = 0;
		$this->load->model('contact_model');
		foreach ( $result as $title )
		{
			$fetched_email = $title->attributes()->address;
			$data['contact_email'] 			= $fetched_email;
			$data['authentication_code']	= $authcode;
			$this->model_utama->insert_data('gmail_contact',$data);
			// $contact_key[] = $this->contact_model->insert_contact_gmail($fetched_email);
		}

		redirect('terima-kasih-telah-menambahkan-kontak-anda','refresh');
	}

	function save()
	{
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
        	$this->session->unset_userdata('nama_bro');
        	$this->session->unset_userdata('materi');

			$nama = $this->security->xss_clean(strip_tags($this->input->post('nama')));
			$materi = $this->security->xss_clean(strip_tags($this->input->post('materi')));

	        $this->session->set_userdata('nama_bro',$nama);
	        $this->session->set_userdata('materi',$materi);
		}
	}

	function kirim_email($recipient)
	{
		$nama_murid = $this->session->userdata('nama_bro');
		$materi 	= $this->session->userdata('materi');

		$from 		= 'info@babastudio.com';
		$subject 	= 'Gimana Kabar (ini...'.$nama_murid.')';
		$message 	= '
			Hi gimana kabarnya?<br>
			<br>
			Ini '.$nama_murid.',<br>
			<br>
			Semoga sehat dan sukses selalu.<br>
			<br>
			Mau info aja, kalo butuh dibuatkan '.$materi.'<br>
			Bisa menghubungi '.$nama_murid.', karena sekarang<br>
			Saya lagi kursus '.$materi.'  di www.babastudio.com.<br>
			<br>
			Babastudio itu, Tempat Kursus<br>
			<ul>
				<li>Website</li>
				<li>Animasi</li>
				<li>Mobile App</li>
				<li>Game</li>
				<li>Internet Marketing & Bisnis Online</li> 
			</ul>
			<br>
			Terima kasih yah udh mau baca.<br>
			 '.$nama_murid.'<br>
			<br>
			NB 
			<br>
			Tempat kursus nya (www.babastudio.com) punya alumni lebih dari 15 ribu orang dan Tempatnya nyaman.

		';

		$data['email'] = $recipient;

		if(send_email($from,$recipient,$subject,$message)) {
			$data['send_mail']	= 'yes';
		}
		else {
			$data['send_mail']	= 'no';
		}

		$this->model_utama->insert_data('gmail_send_email',$data);

	}
}