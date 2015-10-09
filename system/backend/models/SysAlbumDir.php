<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_album_dir".
 *
 * @property integer $id
 * @property integer $p_id
 * @property integer $site_id
 * @property integer $album_id
 * @property string $title
 * @property string $subtitle
 * @property string $cover
 * @property string $link
 */
class SysAlbumDir extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_album_dir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_id', 'site_id', 'album_id'], 'integer'],
            [['site_id', 'album_id'], 'required'],
            [['title', 'subtitle', 'cover', 'link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增唯一ID',
            'p_id' => '父目录节点',
            'site_id' => '站点ID',
            'album_id' => '相册ID',
            'title' => '相册标题',
            'subtitle' => '相册描述',
            'cover' => '封面',
            'link' => '链接',
        ];
    }
}
