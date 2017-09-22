<?php

namespace app\Lib;

use app\Lib\Registry;

class ImgUploader
{

    public function validateAndUpload(array $imgFile)
    {
        $allowedTypes = array(
                'image/gif',
                'image/png',
                'image/jpeg'
                );

        $dir = Registry::getParameter('upload_dir');

        if(!in_array($imgFile['type'], $allowedTypes)) {
            throw new \RuntimeException('File should be an image with jpg, gif or png type');
        }

        list($width, $height) = $this->getSizeAndType($imgFile);

        if ($width > 320 || $height > 240){
            $this->normilizeSize($imgFile);
        }


        $uploadImg = $dir .DIRECTORY_SEPARATOR. basename($imgFile['name']);

        if (move_uploaded_file($imgFile['tmp_name'], $uploadImg)) {
            return basename($uploadImg);
        } else {
            throw new \RuntimeException('Img uploading failed');
        }
    }


    /**
     * @param $tmp_name
     * save resized image
     */
    private function normilizeSize($imgFile)
    {
        //get max img height and width
        $maxWidth = Registry::getParameter('max_img_width');
        $maxHeight = Registry::getParameter('max_img_height');

        // get current img size
        list($currWidth, $currHeight, $type) = $this->getSizeAndType($imgFile);

        //calculate the ratio between current width and height
        $ratio = $currWidth/$currHeight;

        //calculate new size
        if ($maxWidth/$maxHeight > $ratio) {
            $maxWidth = $maxHeight*$ratio;
        } else {
            $maxHeight = $maxWidth/$ratio;
        }

        $newImage = imagecreatetruecolor($maxWidth, $maxHeight);

        switch ($type){
            case 'image/gif':
                $image = imagecreatefromgif($imgFile['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($imgFile['tmp_name']);
                break;
            case 'image/jpeg':
                $image = imagecreatefromjpeg($imgFile['tmp_name']);
                break;
        }

        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $maxWidth, $maxHeight, $currWidth, $currHeight);

        //save resized image
        if (!imagejpeg($newImage, $imgFile['tmp_name'], 100)){
            throw new \RuntimeException('Cannot resize the image');
        }

        //clearing
        imagedestroy($newImage);
        imagedestroy($image);
    }


    /**
     * @param $fileName
     * @return array|bool
     */
    private function getSizeAndType($imgFile)
    {

        list ($width, $height) = getimagesize($imgFile['tmp_name']);
        $type = $imgFile['type'];

        if (!$width || !$type)
            throw new \RuntimeException('Cannot get size and type of img');

        $sizeAndType = array($width, $height, $type);
        return $sizeAndType;
    }

}