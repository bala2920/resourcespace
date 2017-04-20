<?php
/*
include_once "../../include/db.php";
include_once "../../include/general.php";
include "../../include/authenticate.php";

$query = "SELECT * FROM resource";

$rca_users = sql_query($query);

//print_r($rca_users);

//*below code will be used to remove the images once the method of saving images is known
$destinationDir = "img/";

$fileList = scandir($destinationDir);

//* removing first 2 objects which is actually the router
unset($fileList[0]);
unset($fileList[1]);

//* re ordering the array with default positions which starts from 0
$fileList = array_values($fileList);

/*
include_once '../../include/definitions.php';
include_once '../../include/language_functions.php';
include_once '../../include/message_functions.php';
include_once '../../include/node_functions.php';
$ref = "17";
global $scramble_key;
global $storagedir,$originals_separate_storage,$fstemplate_alt_threshold,$fstemplate_alt_storagedir,$fstemplate_alt_storageurl,$fstemplate_alt_scramblekey;
$skey=$scramble_key;
if ($fstemplate_alt_threshold>0 && $ref<$fstemplate_alt_threshold)
            {
            $skey=$fstemplate_alt_scramblekey;
            }


echo substr(md5("17_" . $skey),0,15);
echo $storagedir;
print_r($GLOBALS);*/

//* directory that needs to be scanned for removing the duplicate images
$destinationDir = "../";

$fileList = scandir($destinationDir);

unset($fileList[0]);
unset($fileList[1]);

function directoryRecursive(){
	
}

foreach($fileList as $folders){
	$subDir = "../".$folders;
	if(is_dir($subDir)){
		echo '<br>'.$folders;		
		$subfileList = scandir($subDir);
		print_r($subfileList);
	}
	else
		echo '<br>'.$folders;
}

?>