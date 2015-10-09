<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "sys_site".
 *
 * @property integer $id
 * @property string $name
 * @property string $pc_pub_path
 * @property string $pc_temp_path
 * @property string $pc_domain
 * @property string $pc_url
 * @property string $pc_static
 * @property string $m_pub_path
 * @property string $m_domain
 * @property string $m_temp_path
 * @property string $m_url
 * @property integer $sitemap
 * @property string $m_static
 * @property integer $is_test
 */
class SysSite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
//        return [
//            [['name', 'pc_domain', 'pc_url', 'pc_static'], 'required'],
//            [['is_test', 'sitemap'], 'integer'],
//            [['pc_pub_path', 'm_pub_path'], 'unique'],
//            [['name', 'pc_domain', 'm_domain'], 'string', 'max' => 50],
//            [['pc_pub_path', 'pc_temp_path', 'm_pub_path', 'm_temp_path'], 'string', 'max' => 255],
//            [['pc_url', 'pc_static', 'm_url', 'm_static'], 'string', 'max' => 100]
//        ];
        return [
            [['name', 'pc_domain', 'pc_static'], 'required'],
            [['is_test', 'sitemap'], 'integer'],
            [['dir'], 'unique'],
            [['name', 'pc_domain', 'm_domain'], 'string', 'max' => 50],
            [['pc_static', 'm_static'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sever' => '所属服务器',
            'name' => '站点名称',
            'root' => '站点根URL',
            'dir' => '站点目录',
            'pc_domain' => 'PC域名',
            'pc_static' => 'pc静态资源URL',

            'm_domain' => 'M站域名',
            'm_static' => 'M站静态资源URL',

            'is_test' => '发布环境',
            'is_publish' => '是否发布',
            'sitemap' => '网站地图',
        ];
    }

    /**
     * 站点分页列表
     */
    public function search($params)
    {
        $query = SysSite::find();

        $query->orderBy('id desc');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pagesize'=>'30']
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        if(!empty($this->name)){
            $query->andWhere(['like', 'name', $this->name]);
        }

        if(!empty($this->pc_domain)){
            $query->andWhere(['like', 'pc_domain', $this->pc_domain]);
        }

        if(!empty($this->m_domain)){
            $query->andWhere(['like', 'm_domain', $this->m_domain]);
        }

        return $dataProvider;
    }


}
