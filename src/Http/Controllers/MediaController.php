<?php

namespace Khadka7\MediaLibrary\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Khadka7\MediaLibrary\Http\Services\MediaService;

class MediaController extends Controller
{
    /**
     * @var MediaService
     */
    private $service;

    public function __construct(MediaService $service)
    {

        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $filters = $request->query->all();
        $data['mode'] = isset($filters['mode']) ? $filters['mode'] : 'list';
        $data['medias'] =
            $data['mode'] == 'list' ?
                $this->service->paginatedList(20,'ASC', $filters)
                :
                $this->service->listAll($filters);
        if ($request->ajax()) {
            $data['template'] = view('media-library::media.partial.mode', $data)->render();
            return response([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return view('media-library::media.main.index', $data);
        }
    }


    public function info(Request $request, $uuid)
    {
        $data['media'] = $this->service->getByFieldName('uuid', $uuid);
        if ($request->ajax()) {
            return response([
                'success' => true,
                'data' => $data['media'],
            ]);
        } else {
            //return blade
        }
    }

    public function update(Request $request,$uuid){
        $data = $request->all();
        $media = $this->service->getByFieldName('uuid',$uuid);
        try{
            $this->service->update($data,$media->id);
            return response([
                'message'=>'Media Updated'
            ]);
        }catch (\Exception $exception){
            return response([
               'message'=>$exception->getMessage()
            ]);
        }
    }
    public function detail(Request $request, $uuid)
    {
        $data['media'] = $this->service->getByFieldName('uuid', $uuid);
        $data['template'] = view('media-library::media.detail',$data)->render();
        if ($request->ajax()) {
            return response([
                'success' => true,
                'media' => $data['media'],
                'template'=>$data['template']
            ]);
        } else {
            //return blade
        }
    }





    public function media()
    {
        $data['medias'] = $this->service->listAll();
        $data['template'] = view('media-library::media.partial.image', $data)->render();
        return response([
            'success' => true,
            'data' => $data
        ]);
    }


    public function gridView()
    {
        $data['mode'] = 'grid';
        $data['medias'] = $this->service->all();
        $data['template'] = view('media-library::media.modal.grid', $data)->render();
        return response([
            'success' => true,
            'data' => $data
        ]);
    }

    public function openModal()
    {
        $data['mode'] = 'grid';
        $data['medias'] = $this->service->listAll();
        $data['template'] = view('media-library::media.modal.template', $data)->render();
        return response([
            'success' => true,
            'template' => $data['template']
        ]);
    }


    public function searchMedia(Request $request)
    {
        $query = $request->query->all();
        $data['medias'] = $this->service->listAll($query);
        $data['template'] = view('media-library::media.partial.image', $data)->render();
        return response([
            'success' => true,
            'data' => $data
        ]);
    }

    public function add()
    {
        return view('media-library::media.main.add');
    }

    public function demo()
    {
        return view('media-library::demo');
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $uuid = $request['uuid'];
        $files = $request->file('file');
        $data['uuid'] = $uuid;
        $images = $this->service->imageUpload($files, $data['uuid']);
        try {
            foreach ($images as $image) {
                $this->service->create($image);
            }
            return response([
                'status' => true,
                'message' => 'Image Uploaded SuccessFully'
            ]);
        } catch (\Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }


    /**
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Request $request, $uuid)
    {
        $media = $this->service->getByFieldName('uuid', $uuid);
        try {
            $unlinkOriginalPath = $media->url;
            $unlinkConvertedPath = $media->thumbnail_url;
            $this->unlinkFile($unlinkOriginalPath);
            $this->unlinkFile($unlinkConvertedPath);

            $this->service->delete($media->id);
            return response([
                'status' => true,
                'message' => 'Image Deleted'
            ]);
        } catch (\Exception $exception) {
            return response([
                'status' => true,
                'message' => $exception->getMessage()
            ]);
        }

    }

    protected function unlinkFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * @param $image
     * @param $data
     * @return mixed
     */
    public function imageData($image, $data)
    {
        $data['filename'] = $image['filename'];
        $data['original_name'] = $image['original_name'];
        $data['filetype'] = $image['filetype'];
        $data['filesize'] = $image['filesize'];
        $data['dimension'] = $image['dimension'];
        $data['url'] = $image['url'];
        $data['thumbnail_url'] = $image['thumbnail_url'];
        return $data;
    }
}
