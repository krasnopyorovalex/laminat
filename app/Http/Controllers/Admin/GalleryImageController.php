<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Gallery\Queries\GetGalleryByIdQuery;
use App\Domain\GalleryImage\Commands\DeleteGalleryImageCommand;
use App\Domain\GalleryImage\Commands\UpdateGalleryImageCommand;
use App\Domain\GalleryImage\Commands\UpdatePositionsGalleryImageCommand;
use App\Domain\GalleryImage\Queries\GetGalleryImageByIdQuery;
use App\Domain\GalleryImage\Commands\CreateGalleryImageCommand;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\GalleryImage\Requests\CreateGalleryImageRequest;
use Domain\GalleryImage\Requests\UpdateGalleryImageRequest;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    /**
     * @var UploadImagesService
     */
    private $uploadGalleryImagesService;

    /**
     * GalleryImageController constructor.
     * @param UploadImagesService $uploadGalleryImagesService
     */
    public function __construct(UploadImagesService $uploadGalleryImagesService)
    {
        $this->uploadGalleryImagesService = $uploadGalleryImagesService;
    }

    /**
     * @param int $gallery
     * @return array
     * @throws \Throwable
     */
    public function index(int $gallery)
    {
        $gallery = $this->dispatch(new GetGalleryByIdQuery($gallery));

        return [
            'images' => view('admin.galleries._images_box', [
                'gallery' => $gallery
            ])->render()
        ];
    }

    /**
     * @param CreateGalleryImageRequest $request
     * @param $gallery
     * @return array
     */
    public function store(CreateGalleryImageRequest $request, $gallery)
    {
        $image = $this->uploadGalleryImagesService->setWidthThumb(384)->setHeightThumb(286)->upload($request, 'gallery', $gallery);
        $this->dispatch(new CreateGalleryImageCommand($image));

        return [
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $image = $this->dispatch(new GetGalleryImageByIdQuery($id));

        return view('admin.galleries._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param $id
     * @param UpdateGalleryImageRequest $request
     * @return array
     * @throws \Throwable
     */
    public function update($id, UpdateGalleryImageRequest $request)
    {
        $this->dispatch(new UpdateGalleryImageCommand($id, $request));

        $image = $this->dispatch(new GetGalleryImageByIdQuery($id));
        $gallery = $this->dispatch(new GetGalleryByIdQuery($image->gallery_id));

        return [
            'images' => view('admin.galleries._images_box', [
                'gallery' => $gallery
            ])->render(),
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteGalleryImageCommand($id));

        return [
            'message' => 'Изображение удалено успешно'
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function updatePositions(Request $request)
    {
        $this->dispatch(new UpdatePositionsGalleryImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
