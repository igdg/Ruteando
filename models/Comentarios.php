<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property int $id_ruta
 * @property int $id_usuario
 * @property string $fecha_hora
 * @property string $comentario
 *
 * @property Rutas $ruta
 * @property Usuarios $usuario
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comentarios}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['fecha_hora', 'default', 'value' => date('Y-m-d H:i:s')],
            [['id_ruta', 'id_usuario', 'fecha_hora', 'comentario'], 'required'],
            [['id_ruta', 'id_usuario'], 'integer'],
            [['fecha_hora'], 'safe'],
            [['comentario'], 'string', 'max' => 150],
            [['id_ruta'], 'exist', 'skipOnError' => true, 'targetClass' => Rutas::className(), 'targetAttribute' => ['id_ruta' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
            'id_usuario' => 'Id Usuario',
            'fecha_hora' => 'Fecha Hora',
            'comentario' => 'Comentario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuta()
    {
        return $this->hasOne(Rutas::className(), ['id' => 'id_ruta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_usuario']);
    }
}
