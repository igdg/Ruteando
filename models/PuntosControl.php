<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%puntos_control}}".
 *
 * @property int $id
 * @property string $latitud
 * @property string $longitud
 * @property int $id_ruta
 * @property int $orden
 *
 * @property Rutas $ruta
 */
class PuntosControl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%puntos_control}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latitud', 'longitud', 'id_ruta', 'orden'], 'required'],
            [['id_ruta', 'orden'], 'integer'],
            [['latitud', 'longitud'], 'string', 'max' => 200],
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
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
            'id_ruta' => 'Id Ruta',
            'orden' => 'Orden',
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
