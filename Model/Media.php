<?php 

App::uses('FileManager','Media.Lib');

class Media extends MediaAppModel
{


/**
 * Receives a request from behavior
 * @param  Array $data          
 * @param  String $model        
 * @param  Int $id            
 * @param  Array $modelSettings
 * @return Array               
 */
public function prepareFileToPersist($data,$model,$id,$modelSettings)
{
	$fm = new FileManager($model,$id,$modelSettings);
	$fm->makeFolder();
	$fileName = $fm->moveFileToFolder($data);
	$fm->createThumb($fileName,$modelSettings);
	$fileDir = $fm->getImgDir();

	return $this->prepareData($data,$fileName,$fileDir);
}

/**
 * create the correct data to persist in Media table
 */
private function prepareData($data,$fileName,$fileDir)
{
	$mediaData = [];

	if($fileName) {
		$mediaData['path'] = $fileDir;
		$mediaData['name'] = $fileName;
		$mediaData['size'] = $data['size'];
	}

	return $mediaData;
}


}