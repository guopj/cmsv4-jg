<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_album_photo".
 *
 * @property integer $id
 * @property integer $site_id
 * @property integer $album_dir_id
 * @property string $title
 * @property string $subtitle
 * @property string $img_pre
 * @property string $img
 * @property string $c_date
 */
class SysAlbumPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_album_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'album_dir_id', 'c_date'], 'required'],
            [['site_id', 'album_dir_id'], 'integer'],
            [['c_date'], 'safe'],
            [['title', 'subtitle', 'img_pre', 'img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增唯一ID',
            'site_id' => '站点ID',
            'album_dir_id' => '照片属于某个目录',
            'title' => '相册标题',
            'subtitle' => '相册描述',
            'img_pre' => '预览图路径',
            'img' => '正图路径',
            'c_date' => '创建时间',
        ];
    }
}
