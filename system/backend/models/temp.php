<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_content".
 *
 * @property integer $id
 * @property integer $site_id
 * @property integer $content_group_id
 * @property string $content_gather_ids
 * @property string $title
 * @property string $title_sub
 * @property string $tag
 * @property string $content
 * @property string $url
 * @property integer $ext_model_id
 * @property string $j_imgs
 * @property string $j_other
 */
class temp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'title'], 'required'],
            [['site_id', 'content_group_id', 'ext_model_id'], 'integer'],
            [['content', 'j_imgs', 'j_other'], 'string'],
            [['content_gather_ids', 'title', 'title_sub'], 'string', 'max' => 255],
            [['tag'], 'string', 'max' => 500],
            [['url'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '内容ID',
            'site_id' => '站点ID',
            'content_group_id' => '分组ID 默认0不加入任何分组',
            'content_gather_ids' => '哪些合集用到了该分组',
            'title' => '内容主标题',
            'title_sub' => '文章副标题',
            'tag' => '标签标识 逗号分割',
            'content' => '编辑器编辑内容',
            'url' => '内容详情 url',
            'ext_model_id' => '扩展模型ID 主要记录json两字段的格式',
            'j_imgs' => '内容图片扩展 JSON',
            'j_other' => '内容其他扩展 JSON',
        ];
    }
}
