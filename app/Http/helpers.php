<?php

function getImageHeight($imgUrl){
	$size = getimagesize($imgUrl);
	return (string)$size[1];
}

function getImageWidth($imgUrl){
	$size = getimagesize($imgUrl);
	return (string)$size[0];
}