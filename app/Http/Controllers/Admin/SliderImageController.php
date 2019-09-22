<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Slider\Queries\GetSliderByIdQuery;
use App\Domain\SliderImage\Commands\CreateSliderImageCommand;
use App\Domain\SliderImage\Commands\DeleteSliderImageCommand;
use App\Domain\SliderImage\Commands\UpdatePositionsSliderImageCommand;
use App\Domain\SliderImage\Commands\UpdateSliderImageCommand;
use App\Domain\SliderImage\Queries\GetSliderImageByIdQuery;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\SliderImage\Requests\CreateSliderImageRequest;
use Domain\SliderImage\Requests\UpdateSliderImageRequest;
use Illuminate\Http\Request;

/**
 * Class SliderImageController
 * @package App\Http\Controllers\Admin
 */
class SliderImageController extends Controller
{
    /**
     * @var UploadImagesService
     */
    private $uploadSliderImagesService;

    /**
     * SliderImageController constructor.
     * @param UploadImagesService $uploadSliderImagesService
     */
    public function __construct(UploadImagesService $uploadSliderImagesService)
    {
        $this->uploadSliderImagesService = $uploadSliderImagesService;
    }

    /**
     * @param int $gallery
     * @return array
     * @throws \Throwable
     */
    public function index(int $gallery)
    {
        $slider = $this->dispatch(new GetSliderByIdQuery($gallery));

        return [
            'images' => view('admin.sliders._images_box', [
                'slider' => $slider
            ])->render()
        ];
    }

    /**
     * @param CreateSliderImageRequest $request
     * @param $slider
     * @return array
     */
    public function store(CreateSliderImageRequest $request, $slider)
    {
        $image = $this->uploadSliderImagesService->setWidthThumb(250)->upload($request, 'slider', $slider);
        $this->dispatch(new CreateSliderImageCommand($image));

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
        $image = $this->dispatch(new GetSliderImageByIdQuery($id));

        return view('admin.sliders._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param $id
     * @param UpdateSliderImageRequest $request
     * @return array
     * @throws \Throwable
     */
    public function update($id, UpdateSliderImageRequest $request)
    {
        $this->dispatch(new UpdateSliderImageCommand($id, $request));

        $image = $this->dispatch(new GetSliderImageByIdQuery($id));
        $slider = $this->dispatch(new GetSliderByIdQuery($image->slider_id));

        return [
            'images' => view('admin.sliders._images_box', [
                'slider' => $slider
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
        $this->dispatch(new DeleteSliderImageCommand($id));

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
        $this->dispatch(new UpdatePositionsSliderImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
