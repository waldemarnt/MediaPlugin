<?php 

App::uses('Folder','Utility');
App::uses('File','Utility');
App::import('Vendor',array('file'=>'autoload'));

require_once APP.'Plugin'.DS.'Media'.DS.'vendor'.DS.'autoload.php';
use WideImage\WideImage;

class FileManager
{
	private $fileDir;
	private $imgDir;
	private $model;
	private $modelId;
	private $modelSettings;


	/**
	 * @param String $model         Model alias
	 * @param int $id            Model id
	 * @param Array $modelSettings thumb_size
	 */
	public function __construct($model,$id,$modelSettings)
	{
		$this->model = $model;
		$this->modelId = $id;
		$this->modelSettings = $modelSettings;

		$this->createFileDir();

		return $this;
	}

	/**
	 * set the file and image dir name
	 */
	private function createFileDir()
	{
		$this->fileDir = IMAGES.'uploads'.DS.$this->model.DS.$this->modelId;
		$this->imgDir  = 'uploads/'.$this->model.'/'.$this->modelId;
	}

	/**
	 * create a folder for this file, if not exists
	 */
	public function makeFolder()
	{
		$dir =  new Folder($this->fileDir);
		if($dir->pwd() == null){
			return new Folder($this->fileDir,true,0755);
		}
	}

	/**
	 * move the file for selected folder
	 */
	public function moveFileToFolder($data)
	{
		$tmpFile = new File($data['tmp_name']);
		$fileName = md5($tmpFile->name());
		$fileExt  = explode(".", $data['name']);

		$tmpFile->copy($this->fileDir.DS.$fileName.'.'.$fileExt[1],true);

		return $fileName.'.'.$fileExt[1];
	}

	/**
	 * if the model have thumb_size option, we will create it
	 */
	public function createThumb($fileName)
	{
		if(isset($this->modelSettings['thumb_size'])) {
			return $this->resizeProportional($fileName);
		}
	}
	
	/**
	 * use WideImage lib to resize proportional
	 */
	protected function resizeProportional($fileName)
	{
		$file = WideImage::load($this->fileDir.DS.$fileName);
		$file->saveToFile($this->fileDir.DS.'thumb_'.$fileName);

		return $this->cropInside($this->fileDir.DS.'thumb_'.$fileName,$this->modelSettings['thumb_size']['width'],$this->modelSettings['thumb_size']['height']);
	}

	protected function cropInside($filePath,$width,$height)
	{
		$toCrop = WideImage::load($filePath)->resize($width,$height,'outside');
		$toCrop = $toCrop->crop('center','center',$width,$height);

		return $toCrop->saveToFile($filePath);
	}	

	public function getImgDir()
	{
		return $this->imgDir;
	}


}