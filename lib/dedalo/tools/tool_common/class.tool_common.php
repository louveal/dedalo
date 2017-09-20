<?php
# COMPONENT TOOLS (ABSTRACT CLASS)
# MÉTODOS COMPARTIDOS POR TODOS LOS COMPONENTES

abstract class tool_common extends common {

	public $modo;

	/**
	* __CONSTRUCT 
	* @param object $element_obj (can be 'component' or 'section')
	* @param string $modo (default is 'page' when is called from main page)
	*/
	abstract function __construct($element_obj, $modo);



	/**
	* HTML
	* @return string $html (final html code)
	*/
	public function get_html() {

		if(SHOW_DEBUG===true) {
			#global$TIMER;$TIMER[get_called_class().'_'.$this->tipo.'_'.$this->modo.'_'.microtime(1)]=microtime(1);
		}

		ob_start();
		include ( DEDALO_LIB_BASE_PATH .'/tools/'.get_called_class().'/'.get_called_class().'.php' );
		$html = ob_get_clean();		
		

		if(SHOW_DEBUG===true) {
			#global$TIMER;$TIMER[__METHOD__.'_'.get_called_class().'_'.$this->modo.'_'.microtime(1)]=microtime(1);
		}

		return $html;
	}//end get_html



	/**
	* READ_CSV_FILE_AS_ARRAY
	* @param string $file
	* @return string $html
	*/
	public static function read_csv_file_as_array( $file, $skip_header=false, $csv_delimiter=';', $enclosure='"' ) {

		if(!file_exists($file)) {
			echo "File not found: $file";
			return false;
		}
			
		ini_set('auto_detect_line_endings',TRUE);

		$f = fopen($file, "r");
		
		$csv_array=array(); // , $enclosure
		$i=0; while (($line = fgetcsv($f, 500000, $csv_delimiter)) !== false) { //, $enclosure

			if ($skip_header && $i===0) {
				$i++;
				continue;
			}
			#if ($i>0) break;
			
			foreach ($line as $cell) {
				
				#$cell=nl2br($cell);
				#$cell=htmlspecialchars($cell); // htmlspecialchars_decode($cell);				
				#$cell = str_replace("\t", " <blockquote> </blockquote> ", $cell);			

				$csv_array[$i][] = trim($cell);
			}	
			$i++;
		}
		fclose($f);
		ini_set('auto_detect_line_endings',FALSE);
		
		return $csv_array;
	}//end read_csv_file_as_array



	/**
	* READ_FILES
	* Read files from directory and return all files array filtered by extension
	* @return 
	*/
	public static function read_files($dir, $valid_extensions=array('csv')) {
		
		$ar_data = array();
		try {
			/*
			if (!file_exists($dir)) {
				$create_dir 	= mkdir($dir, 0777,true);
				if(!$create_dir) throw new Exception(" Error on create directory. Permission denied \"$dir\" (1)");
			}
			*/
			$root 	 = scandir($dir);
		} catch (Exception $e) {
			//return($e);
		}
		if (!$root) {
			return array();
		}
		
		natsort($root);
		foreach($root as $value) {

			# Skip non valid extensions
			$file_parts = pathinfo($value);
			if(!isset($file_parts['extension']) || !in_array(strtolower($file_parts['extension']), $valid_extensions)) {
				debug_log(__METHOD__." Skipped file: $value", logger::DEBUG);
				continue;
			}

			# Case file
			if(is_file("$dir/$value")) {
				$ar_data[] = $value;
			}
			/*
			# Case dir ($recursive==true)
			if($recursive) foreach(self::find_all_files("$dir/$value", $recursive) as $value) {
				$ar_data[] = $value;
			}
			*/
		}

		# SORT ARRAY (By custom core function build_sorter)
		#usort($ar_data, build_sorter('numero_recurso'));
		#dump($ar_data,'$ar_data');
		
		return (array)$ar_data;
	}//end read_files



	/**
	* PROPAGATE_TEMP_SECTION_DATA
	* @param object $temp_section_data
	* @param object $current_section
	*/
	public function propagate_temp_section_data($temp_section_data, $section_tipo, $section_id) {

		$ar_current_component = reset($temp_section_data);
		foreach ($ar_current_component as $current_tipo => $current_component) {

			$RecordObj_dd 	= new RecordObj_dd($current_tipo);
			$traducible  	= $RecordObj_dd->get_traducible();
			$current_lang   = $traducible!=='si' ? DEDALO_DATA_NOLAN : DEDALO_DATA_LANG;
			
			$component_dato_current_lang = $current_component->dato->$current_lang;

			if (!isset($component_dato_current_lang)) {
				if(SHOW_DEBUG) {
					dump($current_component, ' $current_component ++ '.to_string());
					trigger_error("Error: element $current_tipo without dato");
				}
				continue;
			}			
			
			$modelo_name = RecordObj_dd::get_modelo_name_by_tipo($current_tipo,true);
			$component 	 = component_common::get_instance($modelo_name, $current_tipo, $section_id, 'edit', $current_lang, $section_tipo);
			$component->set_dato( $component_dato_current_lang );
			$component->Save();
			
		}//end foreach ($temp_section_data as $key => $value) {

		return true;
	}#end propagate_temp_section_data



	/**
	* GET_AR_INVERSE
	* Format, filter and sort inverse_locators values for use in selector
	* @return array $ar_inverse
	*/
	public function get_ar_inverse( $inverse_locators ) {
		$ar_inverse=array();

		$section_name = RecordObj_dd::get_termino_by_tipo( TOP_TIPO );
		foreach ((array)$inverse_locators as $current_locator) {
			if ($current_locator->section_tipo!=TOP_TIPO) {
				continue;
			}			
			$ar_inverse[$current_locator->section_id] = $section_name ." | ". $current_locator->section_id ;

			# inverse_code
			$inverse_code = tool_common::get_inverse_element('code', $current_locator->section_id, TOP_TIPO);
			if (is_object($inverse_code)) {
				$ar_inverse[$current_locator->section_id] .= " | ". $inverse_code->value;
			}
		}
		natsort($ar_inverse);
		
		return $ar_inverse;
	}#end get_ar_inverse



	/**
	* GET_INVERSE_ELEMENT
	* Get section_map from section class and calculate value of desired component type like 'code'
	* @return mixed object|null
	*/
	public static function get_inverse_element($type, $section_id, $section_tipo) {			

		# section_map is in properties of structure element 'section_map', inside current section structure
		$section_map = section::get_section_map( $section_tipo );
			#dump($section_map, ' section_map ++ '.to_string());
		
		if (is_object($section_map) && property_exists($section_map, "default") && property_exists($section_map->default, $type)) {
			$element_tipo 	= $section_map->default->$type;
			$modelo_name 	= RecordObj_dd::get_modelo_name_by_tipo($element_tipo,true);
			$component 		= component_common::get_instance($modelo_name,
															 $element_tipo,
															 $section_id,
															 'list',
															 DEDALO_DATA_LANG,
															 $section_tipo);			
			$response = new stdClass();
				$response->label = $component->get_label();
				$response->value = $component->get_valor();			
		}else{
			$response = null;
		}
		#dump($response, ' response ++ '.to_string());

		return $response;
	}//end get_inverse_element



}//end class
?>