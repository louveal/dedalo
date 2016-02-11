<?php

/************************************************************************
	
    Dédalo : Cultural Heritage & Oral History Management Platform
	
	Copyright (C) 1998 - 2015  Authors: Juan Francisco Onielfa, Alejandro Peña

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
	
	http://www.fmomo.org
	dedalo@fmomo.org
	
************************************************************************/

require_once(dirname(__FILE__).'/lib/dedalo/config/config4.php');

# LOGIN VERIFICATION
if (strpos(DEDALO_HOST,'8888')===FALSE) {
	if(login::is_logged()!==true) die("<span class='error'> Auth error: please login </span>");
}

#print "Session.save_handler: <b>".ini_get('session.save_handler')."</b><br>";

#
# DATABASE
$info_database = pg_version(DBi::_getConnection());
print "Database: <b>".$info_database['IntervalStyle']."</b>";
echo "<pre>";
print_r($info_database);
echo "</pre>";

#
# PHP USER
$processUser = posix_getpwuid(posix_geteuid());
print "PHP user: <b>".$processUser['name']."</b>";
echo "<pre>";
print_r($processUser);
echo "</pre>";

#
# FFMPEG
$ffmpeg = shell_exec(DEDALO_AV_FFMPEG_PATH." -version ");
print "FFMPEG: <b>".DEDALO_AV_FFMPEG_PATH."</b>";
echo "<pre>";
print_r($ffmpeg);
echo "</pre>";

#
# FFPROBE
$ffmpeg = shell_exec(DEDALO_AV_FFPROBE_PATH." -version ");
print "PROBE: <b>".DEDALO_AV_FFPROBE_PATH."</b>";
echo "<pre>";
print_r($ffmpeg);
echo "</pre>";

#
# IMAGE MAGICK
$result = shell_exec(MAGICK_PATH."convert -version ");
print "IMAGE MAGICK: <b>".MAGICK_PATH."</b>";
echo "<pre>";
print_r($result);
echo "</pre>";


?>
<?php 
#
# PHP INFO
echo phpinfo();

#
# DB DATA CHECK
require(DEDALO_LIB_BASE_PATH.'/db/class.data_check.php');
$data_check = new data_check();
$response 	= $data_check->check_sequences();
if ($response->result!=true) {
	debug_log(__METHOD__." $response->msg ".to_string(), logger::WARNING);
	if(SHOW_DEBUG) {
		die("Error on ".$response->msg);
	}
}
echo "<hr><div>".$response->msg."</div>";
?>