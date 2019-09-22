<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 * Class UploadCkeditorImageService
 * @package App\Services
 */
class UploadCkeditorImageService
{
    /**
     * @param Request $request
     * @return array|string
     */
    public function upload(Request $request)
    {
        try {
            $path = $request->file('upload')->store('public/ckeditor');
            $message = 'Загрузка прошла успешно';
            $callback = $_REQUEST['CKEditorFuncNum'];

            $url = \Storage::url($path);
                
            return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$url.'", "'.$message.'" );</script>';

        } catch (\Exception $e) {
            return ['message' => $e->getMessage()];
        }
    }
}
