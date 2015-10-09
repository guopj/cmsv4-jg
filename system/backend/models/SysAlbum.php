<?php
namespace backend\models;
use Yii;
use yii\data\ActiveDataProvider;

use backend\models\SysAlbumDir;			//使用 内容组类
use backend\models\SysAlbumPhoto;	
/**
 * This is the model class for table "sys_album".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $code
 */
class SysAlbum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'code'], 'required'],
            [['site_id'], 'integer'],
            [['code'], 'string', 'max' => 50]
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
            'code' => '代号',
        ];
    }
	
	    /**
     * 站点分页列表
     */
    public function search($params)
    {
        $query = $this->find();
        $query->orderBy('id desc');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pagesize'=>'30']
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }
        return $dataProvider;
    }
	
	/*
	 * 得到相册组组合数据 带 相关数量 -> 相册数量 照片数量等
	 * Added ZhuCj 2015-07-22
	 */
	public function getAlbumNum($site_id)
	{
		$res = $this->find()->where(['site_id' => $site_id])->all();
		$num = [];
		if(!empty($res)){
			foreach($res as $key=>$val){
				$where = [
							'p_id'     => 0,
							'album_id' => $val->id,
						 ];
				$resDir = SysAlbumDir::find()->where($where)->all(); 
				$albumNum = 0;
				$photoNum = 0;
				if(!empty($resDir)){
					foreach($resDir as $valb){
						$albumNum ++ ;
						$where = [
							'album_dir_id' => $valb->id,
						];
						$resPhoto = SysAlbumPhoto::find()->where($where)->all(); 
						$photoNum = $photoNum + count($resPhoto);
					}
				}
				$num[$val->id]['album_num'] = $albumNum;
				$num[$val->id]['photo_num'] = $photoNum;
				//$res[$key]->album_num = $albumNum;
				//$res[$key]->photo_num = $photoNum;
			}
		}
		
		$retArr =   [
						'res' => $res,
						'num' => $num,
					];
		return $retArr;
		//debug($retArr);die;
	}

}
