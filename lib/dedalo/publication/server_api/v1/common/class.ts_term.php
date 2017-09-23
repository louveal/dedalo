<?php
/**
* TS_TERM
* Object like tesaurus term
*
*/
class ts_term {



	# Version. Important!
	#static $version = "1.0.1"; // 05-06-2017
	static $version = "1.0.2"; // 06-06-2017



	public $term_id; 	// string like ts52
	public $term; 		// string
	public $indexation; // string json encoded array of locators
	public $time; 		// string comma separated timestamp dates
	public $space; 		// string json_encoded object of coordinates like: {"lat":"39.462571","lon":"-0.376295","zoom":12,"alt":16}
	public $lang;		// string like lg-spa
	public $options; 	// object
	public $highlight; 	// bool



	/**
	* GET_INSTANCE
	* Singleton pattern
	* @returns array array of component objects by key
	*/
	public static function get_ts_term_instance($term_id, $lang=WEB_CURRENT_LANG_CODE, $request_options=null) {

		static $ar_ts_term_instances;

		# KEY : Store in memory key for re-use
		$key = $term_id .'_'. $lang;

		# OVERLOAD : If ar_ts_term_instances > 99 , not add current element to cache to avoid overload
		if ( isset($ar_ts_term_instances) && count($ar_ts_term_instances)>1000) {    		
			$ar_ts_term_instances = array_slice($ar_ts_term_instances,300,null,true); // 300   		
		}

		# FIND CURRENT INSTANCE IN CACHE    	
		if ( !isset($ar_ts_term_instances) || !array_key_exists($key, $ar_ts_term_instances) ) {	
			$ar_ts_term_instances[$key] = new ts_term($term_id, $lang, $request_options);    		   		
		}

		return $ar_ts_term_instances[$key];
	}//end get_ts_term_instance



	/**
	* __CONSTRUCT
	* Private. Call using static ts_term::get_ts_term_instance($term_id, $lang, $request_options)
	*/
	private function __construct( $term_id, $lang, $request_options ) {

		$this->term_id 	= $term_id;
		$this->lang 	= $lang;
		$this->options 	= new stdClass();	//$request_options;

		if (!empty($request_options)) {
			foreach ($request_options as $key => $value) {
				$this->$key = $value;
			}
		}

		# Fallback to default table if not defined
		if (!isset($this->table)) {
			$this->table = TABLE_THESAURUS;
		}

	}//end __construct



	/**
	* LOAD_DATA
	* @return string $term | null
	*/
	public function load_data() {
	
		if (!isset($this->term) || !isset($this->indexation)) {

			$options = new stdClass();
				$options->table 		= (string)$this->table;
				$options->ar_fields 	= array(FIELD_TERM,'indexation','time','space');
				#$options->ar_fields 	= array('*');
				$options->lang 			= $this->lang;
				$options->sql_filter 	= "term_id = '".$this->term_id."'" . PUBLICACION_FILTER_SQL;		
				$options->order 		= null;
				#$options->limit 		= 1;
					#dump($options, ' options');

				$rows_data = (object)web_data::get_rows_data( $options );
					#dump($rows_data, ' rows_data');
				#$cms_data 	= (object)end($rows_data->result);
					#dump($cms_data, ' cms_data'); #die();

			if (isset($rows_data->result[0])) {
				#dump(reset($rows_data->result)[FIELD_TERM], ' var ++ '.to_string());
				#dump($rows_data->result[0]['descriptor'], '$rows_data->result[0][descriptor] ++ '.to_string());
					#dump($rows_data->result[0], '$rows_data->result[0] A ++ '.to_string());
				#$rows_data->result[0] = (array)web_data::no_descriptor_to_descriptor( (object)$rows_data->result[0] );
					#dump($rows_data->result[0], '$rows_data->result[0] B ++ '.to_string());

				# Store some resolved vars for reuse
				$this->indexation 	= (string)$rows_data->result[0]['indexation'];
				$this->term 		= (string)$rows_data->result[0][FIELD_TERM];

				$this->time 		= (string)$rows_data->result[0]['time'];
				$this->space 		= (string)$rows_data->result[0]['space'];
			}
		}
		
		if (!isset($this->ar_childrens)) {
			$this->ar_childrens = ts_term::get_ar_children($this->term_id, $this->table);
		}


		return true;
	}//end load_data



	/**
	* GET_AR_CHILDREN
	* @param string $term_id
	* @return array $ar_children
	*/
	public static function get_ar_children( $term_id, $table=TABLE_THESAURUS) {
		$ar_children=array();

		$options = new stdClass();
			$options->table 		= (string)$table;
			$options->ar_fields 	= array('term_id',FIELD_NORDER,'descriptor');
			$options->lang 			= WEB_CURRENT_LANG_CODE;
			$options->sql_filter 	= "parent = '$term_id'" . PUBLICACION_FILTER_SQL;
			$options->order 		= '`'.FIELD_NORDER.'` ASC';		

			$rows_data	= (object)web_data::get_rows_data( $options );
				#dump($rows_data, ' rows_data ' .to_string($options) );
			
		if (!empty($rows_data->result)) {

			$ar_restricted_terms = json_decode(AR_RESTRICTED_TERMS);

			foreach ($rows_data->result as $key => $value) {

				$current_term_id 	= $value['term_id'];
				$current_descriptor = $value['descriptor'];

				// Skip no descriptors
				if ($current_descriptor==='no') {
					continue;
				}

				# Skip optional restricted terms (defined in config)
				if (in_array($current_term_id, $ar_restricted_terms)) {
					continue;
				}

				#$have_childrens 	= self::have_childrens($current_term_id);

				#$ts_term 		 = ts_term::get_ts_term_instance($term_id);
				#$public_ar_index = $ts_term->get_ar_index();

				// Filter childrens without childrens or indexations to simplify tree
				#if ($have_childrens==true || !empty($public_ar_index)) {	// || !empty($public_index)
					$ar_children[] = $current_term_id;
				#}

			}//end foreach ($rows_data->result as $key => $value) {
		}


		return (array)$ar_children;
	}//end get_ar_children



	/**
	* PUBLIC_INDEX
	* Return an array with verified public indexations from a raw indexations array
	* @param array $ar_index
	* @return array $ar_public_index
	*//*
	public static function public_index_DES($ar_index) {

		$ar_public_index=array();

		foreach ($ar_index as $key => $locator) {

			$current_section_id = $locator->section_id;
			
			$options = new stdClass();
				$options->table 		= (string)TABLE_AUDIOVISUAL;
				$options->ar_fields 	= array('id');			
				$options->lang 			= WEB_CURRENT_LANG_CODE;
				$options->sql_filter 	= "section_id = '$current_section_id'" . PUBLICACION_FILTER_SQL;
				$options->limit 		= 1;

			$rows_data	= (object)web_data::get_rows_data( $options );

			if (!empty($rows_data->result)) {
				$ar_public_index[] = $locator;
			}

		}//end foreach ($ar_index as $key => $value) {

		return $ar_public_index;		
	}#end public_index
	*/

	

	/**
	* HAVE_CHILDRENS
	* Método rápido para saber si un término tinene o no hijos
	* @param string $term_id
	* @return bool $have_childrens
	*/
	public static function have_childrens($term_id, $table=TABLE_THESAURUS) {
		
		$options = new stdClass();
			$options->table 		= (string)$table;
			$options->ar_fields 	= array('id');			
			$options->lang 			= WEB_CURRENT_LANG_CODE;
			$options->sql_filter 	= "parent = '$term_id'" . PUBLICACION_FILTER_SQL;
			$options->limit 		= 1;

		$rows_data	= (object)web_data::get_rows_data( $options );
				#dump($rows_data, ' rows_data');
		if (!empty($rows_data->result)) {
			$have_childrens = true;
		}else{
			$have_childrens = false;
		}

		return (bool)$have_childrens;
	}//end have_childrens



	/**
	* GET_AR_INDEX
	* @return array $ar_index_valid (json decode of $this->index thas is a locators array as text encoded json)
	*/
	public function get_ar_indexation() {
		
		$ar_indexation_valid = $ar_indexation = array();
		
		if ($this->term_id==='ts176') {
			#dump($this->indexation, ' $this->indexation ++ '.to_string());
		}		

		if ($ar_indexation = json_decode($this->indexation)) {
			#dump($ar_indexation, ' ar_indexation ++ '.to_string());	

			if ($this->term_id==='ts176') {
				#dump($ar_indexation, ' $ar_indexation ++ '.to_string());
			}		
			
			#
			# VERIFY RESOURCE IS AHORIZED FOR DIFFUSION (diffusion='yes')		
			foreach ($ar_indexation as $current_locator) {			
				
				$publication = self::get_publication_from_locator($current_locator);			
				if ($publication=='yes') {
					$ar_indexation_valid[] = $current_locator;
				}else{
					#dump($current_locator, 'EXCLUDED current_locator ++ '.to_string());
				}
				
			}//end foreach ($ar_indexation as $current_locator) {
		}
		#dump($ar_indexation, ' ar_indexation ++ '.to_string());
		#dump($ar_indexation_valid, ' $ar_indexation_valid ++ '.to_string($term_id));

		return $ar_indexation_valid;
	}//end get_ar_indexation



	/**
	* GET_PUBLICATION_FROM_LOCATOR
	* Get publication value n database for current resource (audiovisual)
	* @return string $publication;
	*/
	public static function get_publication_from_locator( $locator, $lang=WEB_CURRENT_LANG_CODE ) {

		$publication = 'no';	// Default. Options: 'yes'|'no'
		
		$current_section_id = (int)$locator->section_id;


			#
			# MODO USANDO EL FILTRO ('PUBLICACION_FILTER_SQL')
				$options = new stdClass();
					$options->table 		= TABLE_AUDIOVISUAL;
					$options->ar_fields 	= array('section_id');
					$options->sql_filter 	= "section_id = $current_section_id " . PUBLICACION_FILTER_SQL;
					$options->limit 		= 1;		
					
				$rows_data = (object)web_data::get_rows_data( $options );
				if (!empty($rows_data->result)) {
					$publication = 'yes';
					#dump($rows_data->result, ' rows_data ++ '.to_string());
				}else{
					#dump($current_section_id, ' $current_section_id ++ '.to_string());
				}
				

				# Si la cinta es publicable, verificamos además el estado de la entrevista
				if ($publication!='no') {
					
					$options = new stdClass();
						$options->table 		= TABLE_INTERVIEW;
						$options->ar_fields 	= array('id');
						$options->sql_filter 	= "audiovisual LIKE '%\"{$current_section_id}\"%' " . PUBLICACION_FILTER_SQL;
						$options->limit 		= 1;
						
					$rows_data_interview = (object)web_data::get_rows_data( $options );
						#dump(reset($rows_data_interview->result), ' rows_data ++ '.to_string($options)); #die();

					if (!empty($rows_data_interview->result)) {
						$publication = 'yes';
					}
				}

				return $publication;

		#
		# MODO LEYENDO DIRECTAMENTE EL VALOR DE DB
		/*
			$options = new stdClass();
				$options->table 		= TABLE_AUDIOVISUAL;
				$options->ar_fields 	= array('publication');
				$options->sql_filter 	= "section_id = $current_section_id AND lang = '$lang'";
				$options->limit 		= 1;		
				
				$rows_data = (object)web_data::get_rows_data( $options );
					#dump(reset($rows_data->result)['publication'], ' rows_data ++ '.to_string($options));die();

				if (isset($rows_data->result[0]['publication'])) {
					$publication = $rows_data->result[0]['publication'];
				}

			# Si la cinta es publicable, verificamos además el estado de la entrevista
			if ($publication!='no') {
				
				$options = new stdClass();
					$options->table 		= TABLE_INTERVIEW;
					$options->ar_fields 	= array('publication');
					$options->sql_filter 	= "audiovisual LIKE '%\"{$current_section_id}\"%' AND lang = '$lang'";
					$options->limit 		= 1;
					
				$rows_data_interview = (object)web_data::get_rows_data( $options );
					#dump(reset($rows_data_interview->result)['publication'], ' rows_data ++ '.to_string($options));die();

				if (isset($rows_data_interview->result[0]['publication'])) {
					$publication = $rows_data_interview->result[0]['publication'];
				}
			}

			return $publication;
		*/
	}//end get_publication_from_locator

	

	/**
	* GET_AR_PARENT
	* @return array $ar_parent
	*/
	public static function get_ar_parent( $parent_inicial, $tld, $include_hierarchy=false ) {
		$ar_parent=array();

		#$parent_zero 	= $tld . (int)$top_parent;	// normally 0
		
		# First parent add
		$parent = $parent_inicial;		
		
		do {
			if ($include_hierarchy===true) {
				$ar_parent[] = $parent;		
			}else if(strpos($parent, 'hierarchy')===false) {
				$ar_parent[] = $parent;	
			}		
			
			$parent = self::get_parent( $parent );
				#dump($parent, ' parent ++ parent_inicial '.to_string( $parent_inicial ));

		} while ( !empty($parent) && $parent!==$parent_inicial );

		krsort($ar_parent);
		
		# recreate index of array
		$ar_parent = array_values($ar_parent);


		return $ar_parent;
	}//end get_ar_parent



	/**
	* GET_PARENT
	* @return string $parent
	*/
	public static function get_parent( $term_id ) {
		global $table_thesaurus_map;

		# Table optimized version contains only possible table instead all tables (reduce union query time)
		$thesaurus_table = TABLE_THESAURUS;
		foreach ($table_thesaurus_map as $tkey => $tvalue) {
			if (strpos($term_id, $tkey)===0) {
				$thesaurus_table = $tvalue; break;
			}
		}
		#dump($thesaurus_table, ' thesaurus_table ++ '.to_string($term_id));
		
		$options = new stdClass();
			$options->table 		= (string)$thesaurus_table;
			$options->ar_fields 	= array('parent');
			$options->lang 			= WEB_CURRENT_LANG_CODE;
			$options->sql_filter 	= "term_id = '$term_id'" . PUBLICACION_FILTER_SQL;
			$options->limit 		= 1;
		
		$rows_data	= (object)web_data::get_rows_data( $options );
		$row 		= reset($rows_data->result);
		$parent 	= isset($row['parent']) ? $row['parent'] : false;
			#dump($parent, ' parent ++ '.to_string($term_id));

		return $parent;
	}//end get_parent



	/**
	* GET_PREFIX_FROM_TERM_ID
	* @return string Like 'dd' or 'murapa'
	*/
	public static function get_prefix_from_term_id($term_id) {
		preg_match("/\D+/", $term_id, $output_array);
		if (empty($output_array[0])) {
			if(SHOW_DEBUG) {
				#throw new Exception("Error Processing Request from term_id:'$term_id' ", 1);	
				#dump($term_id,"term_id received ");	
				dump(debug_backtrace()[0]," debug_backtrace Invalid term_id received ". json_encode($term_id));	
			}
			error_log(__METHOD__." Error: Invalid term_id received. Impossible get_prefix_from_term_id this term_id : ". json_encode($term_id)." " );
			return false;
		}
		return (string)$output_array[0];
	}//end get_prefix_from_term_id



	/**
	* GET_TERMS_FROM_TAG
	* Calculate all terms connected to current tag
	* @return array $ar_terms
	*//*
	public static function get_terms_from_tag( $locator ) {
		
		$options = new stdClass();
			$options->table 		= (string)TABLE_THESAURUS;
			$options->ar_fields 	= array('id');			
			$options->lang 			= WEB_CURRENT_LANG_CODE;
			$options->sql_filter 	= "indexation LIKE '%$term_id%'" . PUBLICACION_FILTER_SQL;
			$options->limit 		= 1;

		$rows_data	= (object)web_data::get_rows_data( $options );


	}//end get_terms_from_tag
	*/


}//end class ts_term
?>