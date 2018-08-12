<?php
/*
	REST 
	Simple REST interface to access dedalo data
	Implemented for work with 1 record at time (not list)
*/
$TOP_TIPO=false;
require_once( dirname(dirname(dirname(dirname(__FILE__)))).'/config/config4.php');
require_once( dirname(__FILE__) .'/class.filemaker_connector.php');


# Login check
	#if(login::is_logged()!==true || navigator::get_user_id()!=DEDALO_SUPERUSER) die("<span class='error'> Auth error: please login </span>");


# set vars
	$vars = array('mode','data'); // ?mode=update_filemaker&data={"database":"personas","table":"personas","layout":"Vista","id":"7","auth_code":"364rkls9kAf97qP"}
		foreach($vars as $name) $$name = common::setVar($name);

# mode
	if(empty($mode)) exit("<span class='error'>Error. Sorry wrong mode</span>");
	if(empty($data)) exit("<span class='error'>Error. Sorry empty data</span>");


# data (is string) convert to php object (decoding json)
	$data 		 = json_decode($data); # is string json encoded object
	if (!$data) {
		exit("<span class='error'>Error. Sorry bad data format</span>");
	}
	#dump( $data , ' data');die();
	


if (function_exists($mode)) {
	return $mode( (object)$data );
}else{
	die("Sorry. Error on call. Wrong trigger method");
}

	

/**
* UPDATE_DEDALO
* @param object $data
* 	@param int $data->id
* @return ??
*/
function update_dedalo( $data ) {

	# VERIFY VARS
	$vars = ['database','table','layout','id'];
	foreach ($vars as $name) {
		if (!property_exists($data, $name) || empty($data->$name)) {
			exit("Sorry. $name is mandatory");			
		}
	}


	#$filemaker_connector = new filemaker_connector();
	$fm = filemaker_connector::_getConnection_fm( $data->database );

	    # Create the 'find all' command and specify the layout
        $findCommand =& $fm->newFindAllCommand( $data->layout );
        	#dump($findCommand, ' findCommand');
        
        # Perform the find and store the result
        $result = $findCommand->execute();

        # Check for an error
        if (FileMaker::isError($result)) {
            echo "FM Error: " . $result->getMessage() . "";
            exit;
        }
        
        #Store the matching records
        $records = $result->getRecords();
        	#dump($records, ' records');

        #Retrieve and store the questionnaire_id of the active questionnaire
        $record = $records[0];
			dump($record, ' record');

        # Field
        #$persona =  $record->getField('Persona');  
			#dump($persona, 'persona');

	print_r($data);

}#end update_dedalo





/**
* UPDATE_FILEMAKER
* @param object $data
* 	@param int $data->id
* @return ??
*/
function update_filemaker( $data ) {

	# VERIFY VARS
	$vars = ['id'];
	foreach ($vars as $name) {
		if (!property_exists($data, $name) || empty($data->$name)) {
			exit("Sorry. $name is mandatory");			
		}
	}
	
	



	$id = $data->id;

	echo '999';

}#end update_filemaker






















/**
* GET
* Get complete section data as JSON
* Accept json calls like ?mode=get&data={"id":"47","tipo":"oh1","auth_code":"364rkls9kAf97qP"}
* OLD Call params like ?mode=get&id=47&tipo=oh1&auth_code=364rkls9kAf97qP
* @param object $obj_request
*	@param int $obj_request->id (id matrix like 1874)
*	@param string $obj_request->tipo (section tipo like 'oh1')
* @return string $json_data object encoded as json
*/
function get( $obj_request ) {

	# REST : Important always create first rest object for test security
	$rest = new rest($obj_request);	

	# VERIFY VARS
	$vars = ['id','tipo'];
	foreach ($vars as $name) {
		if (!property_exists($rest->data, $name) || empty($rest->data->$name)) {
			exit("Sorry. $name is mandatory");			
		}
	}

	$response = new stdClass();
	
	# SECTION
	$section = section::get_instance( $rest->data->id, $rest->data->tipo, 'edit' );
	$dato 	 = $section->get_dato(); 
		#dump($dato, ' dato');

	# DATO Formated
	$response 	= (object)$rest->format_section_obj($dato,'simple');	
		#dump($dato, ' dato');

	#
	# RESPONSE ok
	$response->result 		= 'ok';
	$response->result_text 	= 'ok. Section data '.$rest->data->tipo.' ['.$rest->data->id.'] is returned successfully';

	# Add rest info
	$rest->add_rest_info( $response );
	# JSON encode final response
	$json_data = (string)json_handler::encode($response);

	echo rest::add_headers( $json_data );
	return true;

}//end get





/**
* EDIT
* Edit / create one section with request components data
* Accept json calls like ?mode=edit&data={"id":"47","tipo":"oh1","auth_code":"364rkls9kAf97qP","components":{"oh14":{"dato":{"lg-nolan":"ENT-1"}}}}
* @param object $obj_request
*	@param int $obj_request->id (id matrix like 1874)
*	@param string $obj_request->tipo (section tipo like 'oh1')
* @return string $json_data object encoded as json
*/
function edit( $obj_request) {

	# REST : Important always create first rest object for test security
	$rest = new rest($obj_request);

	# VERIFY VARS
	$vars = ['tipo','components'];
	foreach ($vars as $name) {
		if (!property_exists($rest->data, $name) || empty($rest->data->$name)) {
			exit("Sorry. $name is mandatory");
		}
	}

	$response = new stdClass();

	#
	# ERROR
	# If not user id matrix is set, return error
	$user_id = navigator::get_user_id();
	if (empty( $user_id )) {
		
		$response->result 	= 'error. user_id not defined';

		# Add rest info
		$rest->add_rest_info( $response );
		$json_data = (string)json_handler::encode($response);
		echo rest::add_headers( $json_data );
		return false;
	}

	#
	# SECTION
	# If empty id, create new section (matrix record)
	if (!property_exists($rest->data, 'id') || empty($rest->data->id)) {
		$rest->data->id = NULL;
	}
	
	$section 	= section::get_instance($rest->data->id, $rest->data->tipo);
	$section_id = $section->get_id();
	if(empty($section_id)) {
		$section_id = (int)$section->Save();
	}
	#dump($section_id, 'section_id');
	$section_dato = (object)$section->get_dato();
		#dump($section_dato, ' section');

	# SECTION TIPO CHECK
	# To avoid conflicts when section db dato->section_tipo and requested section_tipo are differents
	if ( !property_exists($section_dato, 'section_tipo') || $section_dato->section_tipo != $rest->data->tipo ) {
		if(SHOW_DEBUG) {
			dump($section_dato->section_tipo, "section_dato->section_tipo/rest->data->tipo: ".$section_dato->section_tipo."/".$rest->data->tipo);
		}
		throw new Exception("Error Processing Request. Section tipo inconsistency detected!", 1);					
	}

	# COMPONENTS
	foreach ((array)$rest->data->components as $component_tipo => $component_value) {
		#dump($component_value, " $component_tipo ");

		if ( key(reset($component_value)) === NULL ) {
			$response->components_ignored[]	= $component_tipo;
			if(SHOW_DEBUG) {
				error_log("Ignored component without lang: $component_tipo");
			}
			continue; # ignore dato without lang
		}
		$lang 		 = key(reset($component_value));
		$modelo_name = RecordObj_dd::get_modelo_name_by_tipo($component_tipo,true);
		$component 	 = component_common::get_instance($modelo_name,$component_tipo,$section_id,'edit',$lang);

		$new_dato 	 = $component_value->dato->$lang;		
			#dump($new_dato, ' new_dato');

		$component->set_dato( $new_dato );
		$component->Save();

		$response->components_modified[]	= $component_tipo;
	}

	#
	# RESPONSE ok
	$response->result 		= 'ok';
	$response->result_text 	= 'ok. Section '.$rest->data->tipo.' ['.$rest->data->id.'] is edited successfully by the user '.$user_id ;
	$response->id 			= $section_id;

	# Add rest info
	$rest->add_rest_info( $response );
	# JSON encode final response
	$json_data = (string)json_handler::encode($response);

	echo rest::add_headers( $json_data );
	return true;

}//end edit






/**
* DELETE
* Delete section with request id
* Accept json calls like ?mode=delete&data={"id":"133","tipo":"oh1","auth_code":"364rkls9kAf97qP"}
* @param object $obj_request
*	@param int $obj_request->id (id matrix like 1874)
*	@param string $obj_request->tipo (section tipo like 'oh1')
* @return string $json_data object encoded as json
*/
function delete( $obj_request) {

	# REST : Important always create first rest object for test security
	$rest = new rest($obj_request);

	# VERIFY VARS
	$vars = ['id','tipo'];
	foreach ($vars as $name) {
		if (!property_exists($rest->data, $name) || empty($rest->data->$name)) {
			exit("Sorry. $name is mandatory");
		}
	}


	$response = new stdClass();

	#
	# ERROR
	# If not user id matrix is set, return error
	$user_id = navigator::get_user_id();
	if (empty( $user_id )) {
		
		$response->result 	= 'error. user_id not defined';

		# Add rest info
		$rest->add_rest_info( $response );
		$json_data = (string)json_handler::encode($response);
		echo rest::add_headers( $json_data );
		return false;
	}

	#
	# SECTION	
	$section 	  	= section::get_instance($rest->data->id, $rest->data->tipo);
	$section_dato 	= $section->get_dato();
	$section_name	= RecordObj_dd::get_termino_by_tipo($rest->data->tipo);
	
	if(empty($section_dato) || empty($section_dato->section_id)) {		
		
		$response->result 		= 'error';		
		$response->result_text	= 'error. section not exists ['.$section_name.' : '.$rest->data->id.']. Nothing is deleted';

		# Add rest info
		$rest->add_rest_info( $response );
		$json_data = (string)json_handler::encode($response);
		echo rest::add_headers( $json_data );
		return false;
	}	

	
	# SECTION TIPO CHECK
	# To avoid conflicts when section db dato->section_tipo and requested section_tipo are differents
	if ( !property_exists($section_dato, 'section_tipo') || $section_dato->section_tipo != $rest->data->tipo ) {
		if(SHOW_DEBUG) {
			dump($section_dato->section_tipo, "section_dato->section_tipo/rest->data->tipo: ".$section_dato->section_tipo."/".$rest->data->tipo);
		}
		throw new Exception("Error Processing Request. Section tipo inconsistency detected!", 1);					
	}	

	#
	# DELETE 
	$section->Delete('delete_record');

	#
	# RESPONSE ok
	$response->result 		= 'ok';
	$response->result_text 	= 'ok. Section '.$rest->data->tipo.' ['.$section_name.' : '.$rest->data->id.'] is deleted successfully by the user '.$user_id ;

	# Add rest info
	$rest->add_rest_info( $response );
	# JSON encode final response
	$json_data = (string)json_handler::encode($response);

	echo rest::add_headers( $json_data );
	return true;

}//end delete





?>