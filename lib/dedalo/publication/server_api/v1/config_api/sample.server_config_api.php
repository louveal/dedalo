<?php
include dirname(dirname(dirname(dirname(dirname(__FILE__))))) .'/config/config4.php';


################################################################
# CONSTANTS

	// API_WEB_USER_CODE . Verification user code (must be identical in config of client and server)
	if(!defined('API_WEB_USER_CODE'))
	define('API_WEB_USER_CODE' 			, $API_WEB_USER_CODE);
			if (empty($code)) {
				echo json_encode("Sorry. Empty user code");
				die();
			}
			if ($code!==API_WEB_USER_CODE) {
				echo json_encode("Sorry. Invalid user code");
				die();
			}
	
	// WEB_CURRENT_LANG_CODE . Current lang default. If request get 'lang' overwrite value
	define('WEB_CURRENT_LANG_CODE' 		, !empty($_REQUEST['lang']) ? $_REQUEST['lang'] : 'lg-eng');	
		
	// __CONTENT_BASE_URL__ . Web base url where are served the contents
	define('__CONTENT_BASE_URL__' 		, 'http://www.mydomain.com');

	// WEB_VIDEO_PATH
	define('WEB_VIDEO_BASE_URL' 		, DEDALO_MEDIA_BASE_URL .'/'. DEDALO_AV_FOLDER .'/'. DEDALO_AV_QUALITY_DEFAULT );



################################################################
# REQUIRED FILES

	// web_data
	include dirname(dirname(__FILE__)) .'/common/class.web_data.php';
	// json manager
	include dirname(dirname(__FILE__))  .'/common/class.manager.php';



################################################################
# GENERAL CONSTANTS	
	// Publication filter optional like "AND publicacion = 'si'"
	define('PUBLICACION_FILTER_SQL' , " ");	

	# Table names
		define('TABLE_INTERVIEW'		 , 'interview');
		define('TABLE_AUDIOVISUAL'		 , 'audiovisual');
		define('TABLE_IMAGE'			 , 'image');
		define('TABLE_INFORMANT'		 , 'informant');	
		define('TABLE_THESAURUS'		 , 'themes');
		define('TRANSCRIPTION_TIPO'		 , 'rsc36');
		define('AV_TIPO'				 , 'rsc35');
		define('AUDIOVISUAL_SECTION_TIPO', 'rsc167');

	# Fields
		define('FIELD_TRANSCRIPTION'	, TRANSCRIPTION_TIPO);
		define('FIELD_TERM'				, 'term');
		define('FIELD_TERM_ID'			, 'terminoID');
		define('FIELD_SUMMARY'			, 'abstract');
		define('FIELD_INTERVIEW_DATE'	, 'date');	
		define('FIELD_INFORMANT'		, 'informant');
		define('FIELD_IMAGE'			, 'image');
		define('FIELD_NAME'				, 'name');
		define('FIELD_SURNAME'			, 'surname');
		define('FIELD_BIRTHDATE'		, 'birthdate');
		define('FIELD_BIRTHPLACE'		, 'birthplace');
		define('FIELD_VIDEO'			, 'video');
		define('FIELD_CODE'				, 'code');	
		define('FIELD_NORDER'			, 'norder');



################################################################
# RESTRICTED TERMS
	$ar_restricted_terms = array();



################################################################
# Access-Control-Allow-Origin
# Specifies a URI that may access the resource. You may specify one or more origins, separated by commas.
# Use * for requests without credentials,
	#define('ACCESS_CONTROL_ALLOW_ORIGIN', '*');


