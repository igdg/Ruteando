<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg', 'maxFiles' => 4],
        ];
    }

    public function upload($idRuta)
    {
        if ($this->validate()) {
            $path = 'imgRutas/'. $idRuta;
            FileHelper::createDirectory($path);
            foreach ($this->imageFiles as $file) {
                $fotosRutas = new FotosRutas();
                $fotosRutas->id_ruta=$idRuta;
                if($fotosRutas->save()){
                    $file->saveAs($path .'/'. $fotosRutas->id . '.' . $file->extension);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function attributeLabels()
    {
        return [
            'imageFiles' => 'Imágenes',
        ];
    }
}
?>