<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*=========================================================================
	@author	M.Fadli Prathama (09081003031)
 	email : m.fadliprathama@gmail.com
	
	DOCUMENTATION 
	=================================
	1.	Documentation
		=>	developer_documentation.php
		=>	2.	CUSTOM SEARCH  				LIBRARY 


=========================================================================*/

/*======================================================
	1.	VARIABLES
	2.	CONSTRUCT
	3.	CREATE INDEX
	4.	SEARCH PROCESS
	6.	DETECT IF KEYWORD EXIST ON OTHER SENTENCES
======================================================*/
class Custom_search_library{
    

    /*======================================================
		1.	VARIABLES
	======================================================*/
	private $tables  = array(
							'product'	=> array(
													'product_name',	
													'description',
													),
							'blog'	=> array(
													'blog_title',	
													'blog_description'
													)
						);
    private $CI;
    /*======================================================
		2.	CONSTRUCT
	======================================================*/
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
	}

	/*======================================================
		3.	CREATE INDEX
	======================================================*/
	public function create_index()
	{	
		foreach( $this->tables as $table => $columns ){
			$column_string = implode(',', $columns);
			$sql = 	"ALTER TABLE ".$table." 
					ADD FULLTEXT(".$column_string.")
					";
			$this->CI->db->query($sql);
		}		
	}
	
	/*======================================================
		4.	SEARCH PROCESS
			1.	SEARCH DATABASE
			2.	RESULT
	======================================================*/
	public function search($keyword = '')
	//public function search()
	{	


		if( $keyword == '' ){
			echo "Silakan masukkan Kata Pencarian";
			die();
		}


		//$keyword = 'Lorem ipsum dolor sit amet';
		//$keyword = 'consectetur Duis enim cillum anim';
		$keyword 	= $this->CI->security->xss_clean( $keyword );	
		$keyword 	= str_replace(' ', ',', $keyword);
		$all_result = array();

		/*======================================================
			1.	SEARCH DATABASE
		======================================================*/
		foreach( $this->tables as $table => $columns ){
			

			//$column_link 	= $table."_link,";
			//$column_display = $column_link . implode(',', $columns);
			$column_display = implode(',', $columns);
			$column_search 	= implode(',', $columns);

			if( $table == 'blog' ){
				$sql =	"
						SELECT 
							b.blog_title,
							b.blog_description,
							b.blog_slug,
							c.category_slug
						FROM blog AS b 
						INNER JOIN category AS c 
						ON b.category_id = c.category_id
						WHERE MATCH (".$column_search.") 
						AGAINST ('".$keyword."')
						";
			}elseif( $table == 'product' ){
				/*$sql =	"
						SELECT 
							p.product_name,
							p.description,
							p.slug
						FROM product AS p 
						WHERE MATCH (".$column_search.") 
						AGAINST ('".$keyword."')
						";*/

				$sql =	"
						SELECT 
							p.product_name,
							p.description,
							p.slug
						FROM product AS p 
						WHERE p.product_name LIKE '%".$keyword."%'
						OR p.description LIKE '%".$keyword."%'
						";


			}else{
				$sql =	"
						SELECT ".$column_display."
						FROM ".$table."
						WHERE MATCH (".$column_search.") 
						AGAINST ('".$keyword."')
						";
			}
			$result = $this->CI->db->query($sql)->result_array();

			if( count($all_result) <= 0 ){
				$all_result = $result;
				
			}else{
				$all_result = array_merge($all_result,$result);
			}
		}


		/*======================================================
			2.	RESULT
				1.	FIND RELATED SENTENCES
				2.	BOLD MATCHING WORDS
		======================================================*/
		$post = '';
		if( count($all_result) <= 0 ){
			echo "Data Tidak Ada, Silahkan lakukan pencarian lagi dengan kata lain"; 
			die();
		}
		foreach( $all_result as $row ){
			$link 			= '';
			$title 			= '';
			$description 	= '';	
			if( array_key_exists('post_link', $row) ){
				$title 			= $row['post_title'];
				$link 			= $row['post_link'];
				$description 	= $row['post_description'];
			}else if( array_key_exists('page_link', $row) ){
				$title 			= $row['page_title'];
				$link 			= $row['page_link'];
				$description 	= $row['page_description'];
			}else if( array_key_exists('blog_title', $row) ){
				$title 			= $row['blog_title'];
				$link 			= base_url().strtolower($row['category_slug']).'/'.$row['blog_slug'];
				$description 	= $row['blog_description'];
			}else if( array_key_exists('product_name', $row) ){
				$title 			= $row['product_name'];
				$link 			= base_url().'product/'.$row['slug'];
				$description 	= $row['description'];
			}



			/*===============================================================================
				1.	FIND RELATED SENTENCES
					1.	DETECT IF KEYWORDS IS ALREADY EXIST ON PREVIOUS SENTENCES
					2.	LEFT WORDS
					3.	RIGHT WORDS
			===============================================================================*/
			$description 				= strip_tags($description);
			$description 				= preg_replace("/\s+/", " ",$description);
			$description 				= preg_replace("/[.,]/", "",$description);
			$paragraph_words 			= explode(' ', $description);
			$sentences 					= array();
			$keyword_array				= explode(",", $keyword);
			$paragraph_beginning_found 	= FALSE;
			$paragraph_last_found 		= FALSE;

			if( strlen($description)  >= 50 ){
				foreach( $paragraph_words as $key => $paragraph_word ){
					foreach($keyword_array as $kyword ){
						
						$paragraph_word = str_replace(' ','',$paragraph_word);

						if( $paragraph_word == $kyword ){

							/*echo $kyword;
							echo "<br/>";*/

							/*===================================================================================
								1.	DETECT IF KEYWORDS IS ALREADY EXIST ON PREVIOUS SENTENCES
							===================================================================================*/
							$keyword_is_found_on_other_sentences = $this->detect_if_keyword_is_found_on_sentences($sentences,$kyword);
							if( $keyword_is_found_on_other_sentences ){
								continue;
							}

							/*===================================================================================
								2.	LEFT WORDS
									1.	DETECT IF LEFT WORDS IS ALREADY EXIST ON PREVIOUS SENTENCES
							===================================================================================*/
							$left_words = '';
							for( $times = 1; $times <= 3; $times++){
								if( ($key - $times) >= 0 ){

									/*======================================================================
										1.	DETECT IF KEYWORD IS ALREADY EXIST ON PREVIOUS SENTENCES
									======================================================================*/
									$keyword_is_found_on_other_sentences = $this->detect_if_keyword_is_found_on_sentences($sentences,$paragraph_words[$key - $times]);
									
									if( !$keyword_is_found_on_other_sentences ){
										$left_words = $paragraph_words[$key - $times] ." ". $left_words;
									}
									
								}else{
									//$left_words .= '' . $left_words;
									$paragraph_beginning_found = TRUE;
								}
							}

							/*=====================================================================================
								3.	RIGHT WORDS
									1.	DETECT IF RIGHT WORDS IS ALREADY EXIST ON PREVIOUS SENTENCES
							=====================================================================================*/	
							$right_words = '';
							for( $times = 1; $times <= 3; $times++){
								
								if( array_key_exists($key + $times, $paragraph_words) ){
									
									/*======================================================================
										1.	DETECT IF RIGHT WORDS IS ALREADY EXIST ON PREVIOUS SENTENCES
									======================================================================*/
									$keyword_is_found_on_other_sentences = $this->detect_if_keyword_is_found_on_sentences($sentences,$paragraph_words[$key + $times]);
									if( !$keyword_is_found_on_other_sentences ){
										$right_words = $right_words ." ". $paragraph_words[$key + $times];
									}
								}else{
									//$right_words .= $right_words .'';
								}
							}
							if( !$paragraph_beginning_found ){
								$left_words = '...'.$left_words; 
								$paragraph_beginning_found = FALSE;
							}
							if( !$paragraph_last_found ){
								$right_words = $right_words.'...'; 
							}

							$sentences[] = $left_words.$kyword.$right_words;
						}
					}		
				}
				if( count($sentences) <= 0 ){
					$sentences = $description;
				}
			}else{
				$sentences = $description;
			}

			/*======================================================
				2.	BOLD MATCHING WORDS
			======================================================*/
			$keyword_array 	= explode(',',$keyword);
			if( is_array($sentences) ){
				$sentences 		= implode(" ", $sentences);
			}
			foreach($keyword_array as $word){
				$replace 		= '<b style="font-size:20px;">'.$word.'</b>';
				$title 			= str_replace($word,$replace,$title);
				$sentences 		= str_replace($word,$replace,$sentences);
			}

			$post .= 
				'<div class="post">
					<div class="entry">
						<div class="desc">
							<a href="'.$link .'" class="search_header">'.ucwords($title).'</a>
							<div class="description-inside">
							'.word_limiter($sentences,50).'
							</div>
						</div>	
					</div>
				</div>
				<br/>
				';
		}
		echo $post;
		die();
		
	}

	/*======================================================
		6.	DETECT IF KEYWORD EXIST ON OTHER SENTENCES
	======================================================*/
	public function detect_if_keyword_is_found_on_sentences(	$sentences,
																$keyword
	){	
		$keyword_is_found_on_other_sentences = FALSE;
		if( count($sentences) > 0 ){
			foreach( $sentences as $sentence ){
				if( strripos($sentence,$keyword) > 0 ){
					$keyword_is_found_on_other_sentences = true;
					break;	
				}		
			}
		}
		return $keyword_is_found_on_other_sentences;
	}

}