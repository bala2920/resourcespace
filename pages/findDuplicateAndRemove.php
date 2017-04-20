<?php
//* directory that needs to be scanned for removing the duplicate images
//* if it is ubuntu/linux server, need to provide real path

global $storagedir;
$storagedir = "../filestore";

include_once "../include/db.php";
include_once "../include/general.php";
include_once "../include/authenticate.php";
include_once "../include/resource_functions.php";
/*
global $listOfResources;
global $listOfDuplicateResources;
global $listOfUniqueResources;
global $imgCount;

$imgCount = 0;

$getAllResources = sql_query("SELECT * FROM resource WHERE ref <> '-1' ORDER BY ref DESC");

foreach($getAllResources AS $resourcesList)
{
	$ref = $resourcesList['ref'];
	$fileLocatedAt = get_resource_path($ref, true, "", true, $resourcesList['file_extension'], -1, 1, false, "");
	if(file_exists($fileLocatedAt))
	$fileMD5Content = md5(file_get_contents($fileLocatedAt));
	else
	$fileMD5Content = "";

	$listOfResources[$imgCount]['filePath'] = $fileLocatedAt;
	$listOfResources[$imgCount]['fileID'] = $ref;
	$listOfResources[$imgCount]['fileMD5Content'] = $fileMD5Content;
	//$listOfResources[$imgCount]['fileStringLength'] = strlen(md5(file_get_contents($fileLocatedAt)));
	
	$listOfUniqueResources[] = $fileMD5Content;
	
	$imgCount++;	
}

$listOfUniqueResources = array_unique($listOfUniqueResources);

foreach($listOfUniqueResources AS $arrKey=>$ResourceList){
	
	$tempImageMd5Var = $ResourceList;
	$tempArray = $listOfResources;
	
	$itr = 0;
	
	foreach($tempArray AS $key=>$compareResource){
		
		if($itr == 0){
			$primaryKey = $compareResource['fileID'];
			unset($listOfResources[$key]);
		}
		else{
			if($tempImageMd5Var == $compareResource['fileMD5Content']){
				$listOfDuplicateResources[$primaryKey][] = $compareResource['fileID'];
				unset($listOfResources[$key]);
				
			}
		}
		$itr++;
	}
}
print_r($listOfDuplicateResources);*/

//print_r( get_resource_type_fields("","ref", "asc", "ca"));

$pairs = "fname=fname,mname=mname,lname=lname";
$query = "INSERT INTO sample SET $pairs ON DUPLICATE KEY UPDATE $pairs";
echo $query;
?>