<?php

App::uses('Helper','View');



class MediaHelper extends Helper 
{

	public function file(){
		$fileInput = 
		'<script type="text/javascript">
		 $(document).ready(function(){
			$("#newMediaInput").on("click",function(e){
				e.preventDefault();
				$("#primaryMediaInput").clone().appendTo("#mediaInput");
			});
			$("#removeMediaInput").on("click",function(e){
				e.preventDefault();
				if($("#mediaInput .media-input").length > 1){
					$("#mediaInput .media-input").last().remove();
				}
			});
			$(".delete-media").on("click",function(){
				var modelId = $(this).data("modelid");
				var url = $("#hiddenMediaUrl").val();
				$(this).parent().hide();
				$.get(url+"/delete/"+modelId,function(data,status){

				});
			});
		});
		</script>
		<div id="mediaInput" class="control-group">
			<div id="primaryMediaInput" class="media-input">
				<label>File Upload</label>
				<input type="file" id="mediaFile" class="file" name="data[Media][file][]">
			</div>
		</div>
		<input type = "hidden" value="'.$this->params->base.'/media/media" id="hiddenMediaUrl" />
		<div>
			<button id="newMediaInput" class="btn btn-success" style="margin-right:10px">New Image</button>
			<button id="removeMediaInput" class="btn btn-danger"> Remove Input</button>
		</div>';

	return $fileInput;
	}

}