<?php
	/*
	Function call:
		get_image([ImageType], [ID]);

	Example:
		<img src="<?php get_image("z",1001);?>">
    */
function get_image($type, $id){
	$image_path = "/images/" . $type . "_" . $id . ".png";
	if(file_exists($image_path)){
		echo $image_path;
	} else {
		echo "/images/noimage.svg";
	}
}
?>
