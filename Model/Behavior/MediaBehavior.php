<?php



class MediaBehavior extends ModelBehavior
{

	public function setup(Model $Model,$settings = array())
	{
		if(!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = $Model->actsAs['Media.Media'];
		}

		$this->settings[$Model->alias]= array_merge(
			$this->settings[$Model->alias] ,(array) $settings
		);

	return $this->bindAssociations($Model);
	}	

	/**
	 * we will add assoations for this model
	 */
	private function bindAssociations(Model $Model)
	{
		$Model->bindModel(
			array('hasMany'=>array(
				'Media'=>array(
					'className'=>'Media.Media',
					'foreignKey'=>'model_id',
					'conditions'=>array(
						'Media.model_name'=>''.$Model->alias.''
						)
					)
				)
			),
		false
		);

		$Model->Media->bindModel(
			array('belongsTo'=>array(
				''.$Model->alias.''=>array(
					'foreignKey'=>'model_id',
					'conditions'=>array(
						'Media.model_name'=>$Model->alias
						)
					)
				)
			)
		);

		return $Model;
	}

	public function afterSave(Model $Model,$created,$options = array())
	{
		foreach ($Model->data['Media']['file'] as $key => $file) {
			if($this->validateInput($file)){
				$Model->data['Media'][$key] = $Model->Media->prepareFileToPersist($file,$Model->alias,$Model->data[$Model->alias]['id'],$this->settings[$Model->alias]);
				$Model->data['Media'][$key]['model_name'] = $Model->alias;
				$Model->data['Media'][$key]['model_id']   = $Model->data[$Model->alias]['id'];
 			}
		}

		unset($Model->data['Media']['file']);
		$Model->Media->saveMany($Model->data['Media']);

	}

	protected function validateInput($file)
	{
		if(!empty($file['name'])){
			return true;
		}

		return false;
	}

	
}