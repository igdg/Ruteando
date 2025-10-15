<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%fotos_rutas}}".
 *
 * @property int $id
 * @property string $imagen
 * @property int $id_ruta
 *
 * @property Rutas $ruta
 */
class FotosRutas extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    //public $imageFiles;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fotos_rutas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ruta'], 'required'],
            [['id_ruta'], 'integer'],
            [['id_ruta'], 'exist', 'skipOnError' => true, 'targetClass' => Rutas::className(), 'targetAttribute' => ['id_ruta' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ruta' => 'Id Ruta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuta()
    {
        return $this->hasOne(Rutas::className(), ['id' => 'id_ruta']);
    }
}
