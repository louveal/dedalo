<?php
/*
* CLASS TOOL_EXPORT
	
	Export selected records in differents formats using section_list as base fields reference 
	
*/
require_once( dirname(dirname(dirname(__FILE__))) .'/config/config4.php');



class tool_export extends tool_common {
	
	public $section_tipo;
	public $section_obj;	# received section
	public $ar_records;		# Array of records to export (section_id) or null
	public $data_format;  	# string 'standar', 'dedalo'

	public static $delimiter = ';';


	/**
	* __CONSTRUCT
	*/
	public function __construct( $section_tipo, $modo, $data_format='standar' ) {

		# Verify type section object
		#if ( get_class($section_obj) !== 'section' ) {
		#	throw new Exception("Error Processing Request. Only sections are accepted in this tool", 1);
		#}

		# NOTA: POR UNIFICAR EL CONSTRUCTOR DE LOS TOOLS QUE USAN SECTION !!!!

		if (is_object($section_tipo)) {
			$section_tipo = $section_tipo->get_tipo();
		}

		$this->section_tipo = $section_tipo;
		
		# Fix current component/section
		#$this->section_obj = $section_obj;		

		# Fix modo
		$this->modo = $modo;

		# Fix data_format
		$this->data_format = $data_format;

		# Fix records
		$this->ar_records = null;

		return true;
	}//end __construct



	/**
	* SET_UP
	*/
	static function set_up() {
		
		$var_requested = common::get_request_var('button_tipo');		
		if (!empty($var_requested)) {
			$button_obj  = new button_import($var_requested, null, $this->section_tipo);
			$propiedades = json_handler::decode($button_obj->RecordObj_dd->get_propiedades());

			// in process..		
		}

		return true;	
	}//end set_up



	/**
	* GET_RECORDS
	* @return array|null
	*/
	public function get_records( $layout_map ) {
	
		if (!empty($this->ar_records)) {
			return $this->ar_records;
		}
		
		#
		# SEARCH_OPTIONS
		$section_tipo 		  = $this->section_tipo;
		$search_options_id 	  = $section_tipo; // section tipo like oh1
		$saved_search_options = section_records::get_search_options( $search_options_id );

		if ($saved_search_options===false) {
			trigger_error("Sorry, search_options [$search_options_id] not exits in section_records::get_search_options");
			return null;
		}		
		
		# SEARCH_QUERY_OBJECT . Add search_query_object to options
		$search_query_object = $saved_search_options->search_query_object;	


		# SELECT. layout map is used to set columns select in sesearch_query_object
		$ar_component_tipo = reset($layout_map);
		$search_query_object->select = []; // reset
		foreach ($ar_component_tipo as $key => $component_tipo) {
			
			$path = search_development2::get_query_path($component_tipo, $section_tipo, false);

			$path_element = new stdClass();
				$path_element->path = $path;

			# Parse current path with component and add
			$search_query_object->select[] = search_development2::component_parser_select($path_element);			
		}

		# Reset search limit and offset
		$search_query_object->limit  = 0;
		$search_query_object->offset = 0;
		
		# SEARCH
		$search_develoment2  = new search_development2($search_query_object);
		$rows_data 		 	 = $search_develoment2->search();

		$this->ar_records = $rows_data->ar_records;

		return $this->ar_records;
	}//end get_records




	/**
	* EXPORT_TO
	* @return string $export_str_data
	*/
	public function export_to( $format, $ar_records=null, $encoding='UTF-8' ) {

		if (is_null($ar_records)) {
			// Calculate records when not are already received
			$ar_records = $this->get_records();
		}

		$ar_records_deep_resolved=array();
		foreach ((array)$ar_records as $key => $row) {			
			$section_id = $row->section_id;
			$ar_records_deep_resolved[$section_id] = $this->deep_resolve_row($row);
		}
		#dump($ar_records_deep_resolved, ' $ar_records_deep_resolved ++ '.to_string());		
		
				
		switch ($format) {
			// CSV
			case 'csv':
				$export_str_data= '';
				$com 		= '"';
				$delimiter  = tool_export::$delimiter;	// ";";
				$delimiter_length = strlen($delimiter);
				$header_added = false;
				$i=0;foreach ($ar_records_deep_resolved as $key => $ar_value) {
					
					# Header
					if ($header_added===false) {						
						foreach ($ar_value as $current_tipo => $cvalue) {

							if ($current_tipo!=='id' && $current_tipo!=='section_id' && $current_tipo!=='section_tipo') {
								# Resolve name
								if($this->data_format==='dedalo') {
									$current_tipo = trim($current_tipo);
								}else{
									$current_tipo = RecordObj_dd::get_termino_by_tipo($current_tipo, DEDALO_DATA_LANG, true, true);
								}								
							}
							$export_str_data .= $com.$current_tipo.$com;							
							$export_str_data .= $delimiter;
						}
						$export_str_data = substr($export_str_data, 0,-$delimiter_length);
						#$export_str_data = str_replace('U+003B', ';', $export_str_data);
						$export_str_data .= PHP_EOL;
						$header_added = true;
					}
					# Rows
					$export_str_data .= implode($delimiter, $ar_value) .PHP_EOL;
				$i++;}
				break;
			
			default:
				trigger_error("Sorry. Format not implemented yet");
				break;
		}
		# dump($export_str_data, ' export_str_data ++ '.to_string());

		/*
		if ($encoding!=='UTF-8') {
			$export_str_data = $this->change_encoding_from_uft8($export_str_data, $encoding);
			debug_log(__METHOD__." Encoding result as $encoding ".to_string(), logger::WARNING);
		}
		*/
		return (string)$export_str_data;
	}#end export_to



	/**
	* CHANGE_ENCODING_FROM_UFT8
	* @return string $ISO_result_string
	*/
	public function change_encoding_from_uft8($result_string, $encoding='ISO-8859-1') {
		$ISO_result_string= mb_convert_encoding($result_string, $encoding, 'UTF-8'); // ISO-8859-1 default 
		
		return $ISO_result_string;
	}#end change_encoding_from_uft8



	/**
	* DEEP_RESOLVE_ROW
	* @param array $record
	* @param string $lang
	* @return array $row_deep_resolved
	*/
	public function deep_resolve_row( $record, $lang=DEDALO_DATA_LANG ) {		
		#dump($record, ' record ++ '.to_string());

		$quotes ='"';
		#$quotes ='';

		$row_deep_resolved=array();
		foreach ($record as $key => $value) {			
			
			if ($key==='id') continue;
			if ($key==='section_id') {
				if($this->data_format==='dedalo') {
					$row_deep_resolved[$key] = $quotes.$value.$quotes;
				}				
				continue;
			}
			if ($key==='section_tipo') {
				#$row_deep_resolved[$key] = $quotes.$value.$quotes;
				continue;	// Skip resolve non field elements
			}			
			
			$modelo_name 	 = RecordObj_dd::get_modelo_name_by_tipo($key,true);
			$tipo 			 = $key;
			$parent 		 = $record->section_id;
			$section_tipo 	 = $record->section_tipo;
			$component 	     = component_common::get_instance($modelo_name,
															  $tipo,
															  $parent,
															  'list',
															  $lang,
															  $section_tipo,
															  false);
			if($this->data_format==='dedalo') {
				
				# Full source untouched dato				
				$valor_export 	 = $this->get_valor_dedalo($component);

				# escape delimiter for avoid breaks
				$valor_export 	 = str_replace(';','U+003B',$valor_export);	
				
			}else{

				$valor_export 	 = $component->get_valor_export( $value, $lang, $quotes, $add_id=false );
				#$valor_export 	 = str_replace(PHP_EOL, '; ', $valor_export);
				$valor_export 	 = addslashes($valor_export);
				$valor_export 	 = $quotes.trim($valor_export).$quotes;
			}	
			
			$row_deep_resolved[$key] = $valor_export;

		}//end foreach ($record as $tipo => $value) {
		#dump($row_deep_resolved, ' row_deep_resolved ++ '.to_string());

		return (array)$row_deep_resolved;
	}#end deep_resolve_row



	/**
	* GET_VALOR_DEDALO
	* @return string $valor_dedalo
	*/
	public function get_valor_dedalo( $component ) {

		$tipo 			= $component->get_tipo();
		$lang 			= $component->get_lang();
		$section_id 	= $component->get_parent();
		$section_tipo 	= $component->get_section_tipo();

		$section  = section::get_instance($section_id, $section_tipo);

		$RecordObj_dd = new RecordObj_dd($tipo);
		$traducible   = $RecordObj_dd->get_traducible();	//==='si' ? DEDALO_DATA_LANG : DEDALO_DATA_NOLAN;


		$valor_dedalo = '';

	
		if (get_parent_class($component)==='component_relation_common' || strpos($component, 'filter')!==false) {
			
			# Relations
			$ar_valor = $component->get_dato();

		}else{

			#if ($traducible==='no') {
			/*
				$dato = $component->get_dato();
				#$dato = $section->get_component_dato($tipo, $lang, $lang_fallback=false);
				if (!empty($dato)) {
					$valor_dedalo = json_encode($dato, JSON_UNESCAPED_UNICODE) ." +++++++++++++";
				}
			*/
			#}else{
				
				$ar_valor = [];
				
				$ar_langs = common::get_ar_all_langs();
				# Add nolan as lang
				$ar_langs[] = DEDALO_DATA_NOLAN;
				foreach ($ar_langs as $current_lang) {
					
					$dato = $section->get_component_dato($tipo, $current_lang, $lang_fallback=false);
					if (!empty($dato)) {
						$ar_valor[$current_lang] = $dato;
					}
				}
				#dump($ar_valor, ' $ar_valor ++ '.to_string());				
				#dump($valor_dedalo, ' $valor_dedalo ++ '.to_string());
			#}
		}

		if (!empty($ar_valor)) {
			$valor_dedalo = json_encode($ar_valor, JSON_UNESCAPED_UNICODE);
		}		
		

		return (string)$valor_dedalo;
	}//end get_valor_dedalo



	/**
	* GET_AR_COLUMNS
	* @return array $ar_columns
	* Get all section fields
	*/
	public function get_ar_columns() {
		
		$section_tipo 			 = $this->section_tipo;
		$ar_modelo_name_required = array('component');

		$ar_elements = section::get_ar_children_tipo_by_modelo_name_in_section($section_tipo, $ar_modelo_name_required, $from_cache=true, $resolve_virtual=true);
			#dump($ar_elements, ' $ar_elements ++ '.to_string($section_tipo));

		$ar_columns=array();
		foreach ($ar_elements as $key => $tipo) {

			#$modelo_name = RecordObj_dd::get_modelo_name_by_tipo($tipo,true);
			#if($modelo_name=='component_section_id') continue; # Skip component_section_id (is fixed data in export)
			
			$name = RecordObj_dd::get_termino_by_tipo($tipo, DEDALO_DATA_LANG, true, true); // $terminoID, $lang=NULL, $from_cache=false, $fallback=true
			$ar_columns[$tipo] = $name;
		}

		return $ar_columns;
	}#end get_ar_columns



	/**
	* COLUMNS_TO_LAYOUT_MAP
	* @return array $layout_map
	*/
	public static function columns_to_layout_map( $columns, $section_tipo ) {

		if (is_string($columns)) {
			$columns = json_decode($columns);
		}
		
		$layout_map=array();
		foreach ($columns as $tipo => $value) {
			$layout_map[$section_tipo][] = $tipo;
				#dump($tipo, ' tipo ++ '.to_string($value));
		}

		return $layout_map;
	}#end columns_to_layout_map



	/**
	* WRITE_RESULT
	* @param string $result
	* @return object $response
	*/
	public function write_result( $result_string, $variant=null ) {

		$response = new stdClass();
			$response->result 	= false;
			$response->msg 		= '';
		
		$section_tipo	= $this->section_tipo;
		$label 			= RecordObj_dd::get_termino_by_tipo($section_tipo, DEDALO_DATA_LANG, true, true);
		$label 			= self::normalize_name($label);
		$filename 		= 'exported_'.$variant.''.$label.'_'.navigator::get_user_id().'-'.$section_tipo.'.csv';

		#$result_string  = str_replace('U+003B', ';', $result_string);	
		
		$target_dir 	= DEDALO_TOOL_EXPORT_FOLDER_PATH;
		if( !is_dir($target_dir) ) {
			if(!mkdir($target_dir, 0777,true)) throw new Exception("Error on read or create directory. Permission denied \"$target_dir\" (1)");						
		}
		file_put_contents( $target_dir.'/'.$filename, $result_string);

		$response->result 	= true;
		$response->msg 		= 'Exported successfully';
		$response->path 	= $target_dir.'/'.$filename;
		$response->url 		= DEDALO_TOOL_EXPORT_FOLDER_URL .'/'. $filename;

		return $response;
	}#end write_result



	/**
	* NORMALIZE_NAME
	* Sanitize section name for use in file name
	* @return string $str
	*/
	public static function normalize_name( $str ) {

		$str = strip_tags($str); 
	    $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
	    $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
	    $str = strtolower($str);
	    $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
	    $str = htmlentities($str, ENT_QUOTES, "utf-8");
	    $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
	    $str = str_replace(' ', '-', $str);
	    $str = rawurlencode($str);
	    $str = str_replace('%', '-', $str);

	    return $str;
	}//end normalize_name



	/**
	* READ_CSV_FILE_AS_TABLE
	* @param string $file
	* @return string $html
	*/
	public static function read_csv_file_as_table( $file, $header=false, $delimiter=null, $standalone=false ) {

		if (empty($delimiter)) {
			$delimiter = tool_export::$delimiter;
		}	

		$html='';

		#
		# TABLE HTML
		$table_html ='';
		$table_html .= "<table class=\"table_csv\">\n\n";		
		ini_set('auto_detect_line_endings',TRUE);
		$f = fopen($file, "r");
		$table_html .= "<caption>TABLE FROM:  $file</caption>";
		$i=0; while (($line = fgetcsv($f, 300000, $delimiter)) !== false) {
			
				$table_html .= "<tr>";
				foreach ($line as $cell) {
					$table_html .= ($header && $i==0) ? "<th>" : "<td>";
					$cell=nl2br($cell);					
					#$cell=htmlspecialchars($cell); // htmlspecialchars_decode($cell);					
					#$cell = str_replace("\t", " <blockquote> </blockquote> ", $cell);
					
					# IMAGES . Replace images url to html img tags
					$regex = '/https?\:\/\/[^\\" ]+.jpg/i';
					$cell  = preg_replace($regex, "<img src=\"$0\" style=\"width:auto;height:57px\"/>", $cell);

					# unescape separator ;
					$cell  = str_replace('U+003B', ';', $cell);
					
					$table_html .= $cell;
					$table_html .= ($header && $i==0) ? "</th>" : "</td>";
				}
				$table_html .= "</tr>\n";
				$i++;
		}
		fclose($f);
		ini_set('auto_detect_line_endings',FALSE);
		$table_html .= "\n</table>";

		if ($standalone) {
			$css_file = DEDALO_LIB_BASE_URL . '/tools/tool_export/css/tool_export.css';

			$html .= "<html><head>";
			$html .= "<link rel=\"stylesheet\" href=\"$css_file\" type=\"text/css\" />";
			$html .= "</head><body>";
			$html .= $table_html;
			$html .= "</body></html>";
		}else{
			$html .= $table_html;
		}

		return $html;
	}#end read_csv_file_as_table


	
}#end class
?>