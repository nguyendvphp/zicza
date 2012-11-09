<?php

/**
 * This is the model class for table "{{images}}".
 *
 * The followings are the available columns in table '{{images}}':
 * @property integer $id
 * @property string $image_title
 * @property string $image_ext
 * @property string $image_path
 * @property string $image_mime_type
 * @property integer $image_width
 * @property integer $image_height
 * @property integer $image_size
 *
 * The followings are the available model relations:
 * @property ContentProvider[] $contentProviders
 * @property News[] $news
 */
class AImages extends Images
{
    public static function getImageById($id){
        $connection = Yii::app()->db;
        $sql = "SELECT image_path, image_title, image_ext
                FROM {{images}}
                WHERE id = ".$id;
        $command = $connection->createCommand($sql);
        $rs = $command->queryRow();
        if($rs){
            return "<img src='".Yii::app()->params->upload_path.$rs['image_path'].$rs['image_title']."_110.".$rs['image_ext']."'/>";
        }else{
           return false;
        }
    }
}