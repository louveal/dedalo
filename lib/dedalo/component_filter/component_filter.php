<?php
	#echo "<div>XXX</div>";	return false;
	# CONTROLLER
	
	$tipo 					= $this->get_tipo();
	$parent 				= $this->get_parent();
	$section_tipo			= $this->get_section_tipo();
	$modo					= $this->get_modo();
	$dato 					= $this->get_dato();
	$label 					= $this->get_label();
	$required				= $this->get_required();
	$debugger				= $this->get_debugger();
	$permissions			= common::get_permissions($section_tipo,$tipo);
	$ejemplo				= NULL;
	$html_title				= "Info about $tipo";
	$lang					= $this->get_lang();
	$identificador_unico	= $this->get_identificador_unico();
	$component_name			= get_class($this);
	$file_name 				= $modo;

	if($permissions===0) return null;
	

	switch($modo) {
		
		case 'search' :
				# Showed only when permissions are >1
				if ($permissions<1) return null;
				
				# Nothing to do
				#return print "$component_name. working here..";
				$ar_comparison_operators 	= $this->build_search_comparison_operators();
				$ar_logical_operators 		= $this->build_search_logical_operators();
				$dato 						= isset($_REQUEST[$tipo]) ? json_decode($_REQUEST[$tipo]) : null;

				# Search input name
				$search_input_name = $section_tipo.'_'.$tipo;
				#break;
		case 'ajax' :
		case 'edit' :	
				# Verify component content record is inside section record filter
				#if ($this->get_filter_authorized_record()===false) return NULL ;

		

				# Cuando se muestra en portales, fijar como no visible en estructura
				$visible = $this->RecordObj_dd->get_visible();
				if($visible=='no') {
					if (SHOW_DEBUG) {
						$permissions = 1;
						$valor = $this->get_valor();
					}else{
						return null;
					}
				}			
				
				$ar_proyectos_section = $this->get_ar_projects_for_current_section(); 	#dump($ar_proyectos_section,"ar_proyectos_section");
				$id_wrapper 		  = 'wrapper_'.$identificador_unico; 
				$input_name 		  = "{$tipo}_{$parent}";
				$component_info		  = $this->get_component_info('json');				
				$dato 				  = $this->get_dato();				
				$dato_json 			  = json_encode($dato);
				break;

		case 'tool_time_machine' :				
				$ar_proyectos_section = $this->get_ar_projects_for_current_section();
				$id_wrapper = 'wrapper_'.$identificador_unico.'_tm';
				$input_name = "{$tipo}_{$parent}_tm";
				# Force file_name
				$file_name 	= 'edit';
				break;
						
		case 'list_tm' :
				$file_name = 'list';

		case 'list' :				
				#$valor = $this->get_valor();
				$ar_proyectos_section = (array)$this->get_ar_projects_for_current_section();
				if(SHOW_DEBUG) {
					#dump($ar_proyectos_section, " ar_proyectos_section ".to_string());
				}
				break;

		case 'relation' :
				# Force file_name to 'list'
				$file_name 	= 'list';				
				break;				
							
		case 'lang'	:
				break;
		case 'print' :
				$valor = $this->get_valor('html_concat');
				break;
	}
		
	$page_html	= DEDALO_LIB_BASE_PATH .'/'. get_class($this) . '/html/' . get_class($this) . '_' . $file_name . '.phtml';
	if( !include($page_html) ) {
		#echo "<div class=\"error\">Invalid mode $this->modo</div>";
	}
?>