About
---------------
This is a multiupload plugin to cakephp.


Install
---------------

install via composer:
reference: waldemarnt/media

install manual:

copy to app/Plugin folder
and run composer update comand to download WideImage

create table

CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


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

