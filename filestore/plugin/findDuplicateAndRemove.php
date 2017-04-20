<?php
//* directory that needs to be scanned for removing the duplicate images
//C:\xampp\htdocs\resourcespace\filestore\plugin

$fileStoringDir = "../";
global $listOfFiles;
global $finalSetOfFiles;
global $imgCount;
global $extensionCheck;
global $allowedExtensions;

$allowedExtensions = array('png', 'jpg');

//scan the directory and save each file details
$listOfFiles = scandir($fileStoringDir);

//removing the first 2 position by default
unset($listOfFiles[0]);
unset($listOfFiles[1]);

//function for recursive check on folders in deep for sub folders
function directoryRecursive($subDirectory){
	
	global $imgCount;
	global $allowedExtensions;
	global $finalSetOfFiles;
	
	$subDirFiles = scandir($subDirectory);
	
	//removing the first 2 position by default
	unset($subDirFiles[0]);
	unset($subDirFiles[1]);

	foreach($subDirFiles as $SubFolders){
		
		//creating the folder path with the looped item
		$subDir = $subDirectory.'/'.$SubFolders;
		
		//checking whether the object is a folder or a file
		if(is_dir($subDir)){
			directoryRecursive($subDir);
		}
		else{
			
			$findResourceId = explode("_",$SubFolders);			//finding the id on splitting the object with underscore
			$findResourceExtension = explode(".",$SubFolders);	//finding the extension on splitting the object with dot
			
			//allowing only png, jpg objects to be validated and primary image. The object that doesn't have word '_alt_' is 
			if(in_array($findResourceExtension[1],$allowedExtensions) AND stripos($SubFolders, "_alt_") == false){
				
				$finalSetOfFiles[$imgCount]['filePath'] = $subDirectory;
				$finalSetOfFiles[$imgCount]['fileName'] = $SubFolders;
				$finalSetOfFiles[$imgCount]['fileID'] = $findResourceId[0];
				$finalSetOfFiles[$imgCount]['fileContent'] = md5(file_get_contents($subDirectory.'/'.$SubFolders));
				$finalSetOfFiles[$imgCount]['fileStringLength'] = strlen(md5(file_get_contents($subDirectory.'/'.$SubFolders)));
				
				$imgCount++;
			}
		}
	}
}

$imgCount = 0;

foreach($listOfFiles as $folders){
	$subDir = "../".$folders;
	
	if(is_dir($subDir)){
		directoryRecursive($subDir);
	}
}
echo '<br><br><br>';
print_r($finalSetOfFiles);
?>