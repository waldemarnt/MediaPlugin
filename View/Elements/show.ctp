<div style="width:100%">
	<?php
		foreach ($this->data['Media'] as $key => $file) {
		?>
		<div style="width:150px;">
		<?php 
			echo $this->Html->image($file['path'].'/thumb_'.$file['name']);
			echo $this->Html->link(
				'Remove',
				'javascript:void(0)',
				array('class'=>'btn delete-media','data-modelId'=>$file['id'])
				);
			?>
		</div>
		<?php
			}
		?>
</div>