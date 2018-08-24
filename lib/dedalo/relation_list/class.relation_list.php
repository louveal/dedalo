<?php
/*
* CLASS RELATION_LIST
* Manage the relations of the sections
* build the list of the relations between sections
*/
class relation_list extends common {

	protected $tipo;
	protected $section_id;
	protected $section_tipo;
	protected $modo;
	protected $value_resolved;
	protected $limit;
	protected $offset;
	protected $count;

	/**
	* CONSTRUCT
	* 
	*/
	public function __construct($tipo, $section_id, $section_tipo, $modo='edit') {

		$this->tipo 		= $tipo;
		$this->section_id 	= $section_id;
		$this->section_tipo = $section_tipo;
		$this->modo 		= $modo;

	}//end __construct


	/**
	* GET_INVERSE_REFERENCES
	* Get calculated inverse locators for all matrix tables
	* @see search_development2::calculate_inverse_locator
	* @return array $inverse_locators
	*/
	public function get_inverse_references($limit=1, $offset=0, $count=false) {

		if (empty($this->section_id)) {
			# Section not exists yet. Return empty array
			return array();
		}

		# Create a minimal locator based on current section
		$reference_locator = new locator();
			$reference_locator->set_section_tipo($this->section_tipo);
			$reference_locator->set_section_id($this->section_id);
		
		# Get calculated inverse locators for all matrix tables
		$inverse_locators = search_development2::calculate_inverse_locators( $reference_locator, $limit, $offset, $count);


		return (array)$inverse_locators;	
	}//end get_inverse_references



	/**
	* GET_REALTION_LIST_OBJ
	*
	*/
	public function get_realtion_list_obj($ar_inverse_references, $value_resolved = false){
		
		$json 			= new stdClass;
		$ar_context 	= [];
		$ar_data		= [];

		$sections_related 		= [];
		$ar_relation_components	= [];
		# loop the locators that call to the section
		foreach ((array)$ar_inverse_references as $current_locator) {
			
			$current_section_tipo = $current_locator->from_section_tipo;

			# 1 get the @context
			if (!in_array($current_section_tipo, $sections_related )){

				$sections_related[] =$current_section_tipo;

				//get the id
				$current_id = new stdClass;
					$current_id->section_tipo 		= $current_section_tipo;
					$current_id->section_label 		= RecordObj_dd::get_termino_by_tipo($current_section_tipo,DEDALO_APPLICATION_LANG, true);
					$current_id->component_tipo		= 'id';
					$current_id->component_label	= 'id';
				$ar_context[] = $current_id;

				//get the columns of the @context
				$ar_modelo_name_required = array('relation_list');
				$resolve_virtual 		 = false;

				// Locate relation_list element in current section (virtual ot not)
				$ar_children = section::get_ar_children_tipo_by_modelo_name_in_section($current_section_tipo, $ar_modelo_name_required, $from_cache=true, $resolve_virtual, $recursive=false, $search_exact=true);

				// If not found children, try resolving real section
				if (empty($ar_children)) {
					$resolve_virtual = true;
					$ar_children = section::get_ar_children_tipo_by_modelo_name_in_section($current_section_tipo, $ar_modelo_name_required, $from_cache=true, $resolve_virtual, $recursive=false, $search_exact=true);
				}// end if (empty($ar_children))


				if( isset($ar_children[0]) ) {
					$current_children 		= reset($ar_children);
					$recordObjdd 			= new RecordObj_dd($current_children);
					$ar_relation_components[$current_section_tipo] = $recordObjdd->get_relaciones();
					if(isset($ar_relation_components[$current_section_tipo])){
						foreach ($ar_relation_components[$current_section_tipo] as $current_relation_component) {
							foreach ($current_relation_component as $modelo => $tipo) {

								$current_relation_list = new stdClass;
									$current_relation_list->section_tipo 	= $current_section_tipo;
									$current_relation_list->section_label 	= RecordObj_dd::get_termino_by_tipo($current_section_tipo,DEDALO_APPLICATION_LANG, true);
									$current_relation_list->component_tipo	= $tipo;
									$current_relation_list->component_label	= RecordObj_dd::get_termino_by_tipo($tipo, DEDALO_APPLICATION_LANG, true);

									$ar_context[] = $current_relation_list;
							}
						}
					}
				}
				
			}// end if (!in_array($current_section_tipo, $sections_related )

			# 2 get ar_data
			$ar_data_result = $this->get_ar_data($current_locator, $ar_relation_components[$current_section_tipo], $value_resolved);
			$ar_data 	= array_merge($ar_data, $ar_data_result);
		}// end foreach

		$context = 'context';
		$json->$context = $ar_context;
		$json->data 	= $ar_data;

		return $json;

	}//get_realtion_list_obj



	/**
	* GET_DATA
	* 
	*/
	public function get_ar_data($locator, $ar_components, $value_resolved=false){

		$data = [];

		$section_tipo 	= $locator->from_section_tipo;
		$section_id 	= $locator->from_section_id;

		$current_id = new stdClass;
					$current_id->section_tipo 		= $section_tipo;
					$current_id->section_id 		= $section_id;
					$current_id->component_tipo		= 'id';

		$data[] = $current_id;
		
		if($value_resolved===true && isset($ar_components)){
			foreach ($ar_components as $current_relation_component) {
				foreach ($current_relation_component as $modelo => $tipo) {
					$modelo_name		= RecordObj_dd::get_modelo_name_by_tipo($modelo, true);
					$current_component	= component_common::get_instance(
																		$modelo_name, 
																		$tipo, 
																		$section_id,
																		'list', 
																		DEDALO_DATA_LANG, 
																		$section_tipo
																		);
					$value = $current_component->get_valor();

					$component_object = new stdClass;
						$component_object->section_tipo		= $section_tipo;
						$component_object->section_id 		= $section_id;
						$component_object->component_tipo	= $tipo;
						$component_object->value 			= $value;

					$data[] = $component_object;
				}
			}
		}
	
		return $data;

	}//end get_data



	/**
	* GET_JSON
	* 
	*/
	public function get_json(){

		if(SHOW_DEBUG===true) $start_time = start_time();		
		
			# Class name is called class (ex. component_input_text), not this class (common)	
			include ( DEDALO_LIB_BASE_PATH .'/'. get_called_class() .'/'. get_called_class() .'_json.php' );

		if(SHOW_DEBUG===true) {
			#$GLOBALS['log_messages'][] = exec_time($start_time, __METHOD__. ' ', "html");
			global$TIMER;$TIMER[__METHOD__.'_'.get_called_class().'_'.$this->tipo.'_'.$this->modo.'_'.microtime(1)]=microtime(1);
		}
		
		return $json;
	}//end get_json

/*
	public function set_value_resolved($value_resolved){
		$this->value_resolved = $value_resolved;
	}

	public function set_limit($limit){
		$this->limit = $limit;
	}

	public function set_offset($offset){
		$this->offset = $offset;
	}

	public function set_count($count){
		$this->count = $count;
	}
	*/




}//relation_list

?>