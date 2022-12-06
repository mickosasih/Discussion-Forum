<?php
function validate_image($file){
	if(!empty($file)){
        $ex = explode("?",$file);
        $file = $ex[0];
        $ts = isset($ex[1]) ? "?".$ex[1] : '';
		if(is_file(str_replace('\\','/',__DIR__).'/'.$file)){
			return "http://localhost/project/".$file.$ts;
        }
    }
}