<?php


class MediaController extends Controller
{

	public function delete($id)
	{
		$this->autoRender = false;
		if($this->request->is('ajax')){
			$this->Media->delete($id);
		}
	}
}