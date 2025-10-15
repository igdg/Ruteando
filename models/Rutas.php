<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%rutas}}".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $tipo
 * @property string $fecha
 * @property string $dificultad
 * @property int $puntuacion
 * @property int $id_usuario
 * @property int $status
 *
 * @property Comentarios[] $comentarios
 * @property FotosRutas[] $fotosRutas
 * @property PuntosControl[] $puntosControls
 * @property Usuarios $usuario
 */
class Rutas extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_IN = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rutas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            ['puntuacion', 'default', 'value' => self::STATUS_IN],
            ['fecha', 'default', 'value' => date('Y-m-d')],
            ['id_usuario', 'default', 'value' => Yii::$app->user->id],
            [['nombre', 'descripcion', 'tipo', 'fecha', 'dificultad', 'puntuacion', 'id_usuario', 'status'], 'required'],
            [['tipo', 'dificultad'], 'string'],
            [['fecha'], 'safe'],
            [['puntuacion', 'id_usuario', 'status'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 500, 'min' => 100],
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
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'tipo' => 'Tipo',
            'fecha' => 'Fecha',
            'dificultad' => 'Dificultad',
            'puntuacion' => 'Puntuacion',
            'id_usuario' => 'Id Usuario',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['id_ruta' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFotosRutas()
    {
        return $this->hasMany(FotosRutas::className(), ['id_ruta' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntosControls()
    {
        return $this->hasMany(PuntosControl::className(), ['id_ruta' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_usuario']);
    }

    public function getUsuarioRuta()
    {
        $usuario = $this->getUsuario();
        return $usuario;
    }

    public static function formatoFecha($fecha)
    {
        $aFecha = explode('-', $fecha);
        return $aFecha[2].'-'.$aFecha[1].'-'.$aFecha[0];
    }

    public static function formatoFechaHora($fecha){
        $aFecha = explode(' ',$fecha);  //Separo la fecha de la hora
        $ff = explode('-', $aFecha[0]); //Separo el día, el mes y el año
        $fBien = $ff[2].'-'.$ff[1].'-'.$ff[0].' '.$aFecha[1];   //Ordeno la fecha y añado al final la hora
        return $fBien;
    }
}
