// JavaScript Document

/*******************************
* OTRAS FUNCIONES GENERALES
*******************************/

/*
* GETVALUE : Recoge el valor GET dado al pasarle el nombre de la variable.
* Si no hay variable, devuelve 'null'
*/
function getValue(name) {
	var resultado ;
	try{
		name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
		var regexS = "[\\?&]"+name+"=([^&#]*)";
		var regex = new RegExp( regexS );
		var results = regex.exec( window.location.href );
		if( results == null )
			resultado = null ;
		else
			resultado = results[1];
	}catch(e){	 
		alert(e)
	}
	
	return resultado ;
}


/**
* ISARRAY
*/
function isArray(obj) {
	return obj.constructor == Array;
}


/*
* Abrir listado de tesauro para hacer relaciones
*/
if (typeof relwindow==='undefined') {
	var relwindow ;
}
function dd_abrirTSlist(modo,type) {

	// Already open
	if (relwindow) {
		relwindow.focus()
		return false;
	}
	
	const theUrl = DEDALO_LIB_BASE_URL + '/dd/dd_list.php?modo=' + modo +'&type=' + type ;
	relwindow = window.open(theUrl ,'listwindow','status=yes,scrollbars=yes,resizable=yes,width=900,height=650');//resizable
	if (relwindow) relwindow.moveTo(-10,1);
	if (window.focus) { relwindow.focus() }
	//return false;
}

