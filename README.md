About
---------------
This is a multiupload plugin to cakephp.


Install
---------------

install via composer:

install manual:
copy to app/Plugin folder
and run composer update comand to download WideImage

Using
--------------

First you need load into your bootstrap.php file;

CakePlugin::load('Media');

Now you need add this parameter into your Model;

	public $actsAs = array(
		'Media.Media'=>array(
			'thumb_size'=>array(
				'width'=>100,
				'height'=>100
				)
			)
		);

You need add public $helpers = array("Media.Media"); to your controller or app controller, to use Media plugin file upload helper.


Now in your view you need this field 

<?php echo $this->Media->file(); ?>


To show uplaoded files you need in your view

<?php echo $this->Element('Media.show'); ?>

Now it's works fine :D

