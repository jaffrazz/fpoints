<?php
namespace backend\helpers;

use yii\web\UploadedFile;
use yii\helpers\Url;

class File {
    /**
     * Helper to Simplify upload file
     * and handler error
     * example: Upload($modelAlbum, 'photo', 'file_name', 'album_photo_')
     * 
     * @param $model
     * @param $new  name of temp variable
     * @param $old  field to store path
     * @param $suffix   suffix file uploaded
     */
    public function Upload($model, $new, $old, $suffix)
    {
        $model[$new] = UploadedFile::getInstance($model, $new);
        
        $ret = [];

        /**
         * Check input
         * with validator
         */
        if (!$model->validate()) {
            $ret['failed'] = 'Failed to validate input.';
        }

        /**
         * If file not
         * found
         */
        if( $model[$new] == null){
            return $ret;
        }

        /**
         * Check Old Image exist
         * or not
         */
        if ($model[$old] != '') {
            $oldFile = Url::to('@webroot/uploaded/profile/' . $model[$old]);
            $ret['oldPath'] = $oldFile;
        }
        /**
         * Generate new file name
         */
        $model[$old] = $suffix;
        $model[$old] .= '_' . time() . '.';
        $model[$old] .= $model[$new]->extension;
        $path = Url::to('@webroot/uploaded/profile/' . $model[$old]);

        /**
         * store path & old path
         * to ret
         */
        $ret['path'] = $path;

        /**
         * Failed save model to
         * database
         */
        if ( !$model->save() ) {
            array_push($ret['failed'], 'Failed to Update pegawai.');
        }
        /**
         * Failed store file
         * localStorage
         */
        if ( isset( $ret['failed'] ) || !$model[$new]->saveAs($path)) {
            if (file_exists($path)) {
                unlink($path);
            }
            array_push($ret['failed'], 'Failed to Update pegawai.');
        }

        /**
         * Destory old file
         * action not failed and
         * old file exist
         */
        if ( !isset( $ret['failed'] ) && isset( $oldFile ) ) {
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        // var_dump($ret);
        // die();


        return $ret;
    }
}