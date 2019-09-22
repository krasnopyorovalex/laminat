<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UpdateImageCommand;
use App\Domain\Image\Queries\GetImageByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Image\Requests\UpdateImageRequest;

/**
 * Class ImageController
 * @package App\Http\Controllers\Admin
 */
class ImageController extends Controller
{
    /**
     * @param $id
     * @param UpdateImageRequest $request
     * @return array
     */
    public function update($id, UpdateImageRequest $request)
    {
        $this->dispatch(new UpdateImageCommand($id, $request));

        return [
            'message' => 'Атрибуты изображения сохранены успешно'
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $image = $this->dispatch(new GetImageByIdQuery($id));

        $this->dispatch(new DeleteImageCommand($image));

        return [
            'message' => 'Изображение удалено'
        ];
    }
}
