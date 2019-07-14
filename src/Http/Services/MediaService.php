<?php
/*
 * @author Sanjay Khadka <khadka.sk7@gmail.com>.
 *
 */

namespace Khadka7\MediaLibrary\Http\Services;

use Illuminate\Http\UploadedFile;
use \Intervention\Image\Facades\Image;
use Khadka7\MediaLibrary\BasicCrudRepo;
use Khadka7\MediaLibrary\Http\Repositories\MediaRepository;
use Khadka7\MediaLibrary\Media;

class MediaService
{
    use BasicCrudRepo;

    /**
     * @var MediaRepository
     */
    private $repository;
    /**
     * @var Media
     */
    private $model;


    public function __construct(MediaRepository $repository, Media $model)
    {
        $this->repository = $repository;
        $this->model = $model;
    }

    /**
     * @param array $filters
     * @return \Illuminate\Support\Collection|mixed
     */
    public function listAll($filters = [])
    {
        $items = $this->repository->get_all_items($filters);
        return $items;
    }

    /**
     * @param $limit
     * @param $order
     * @param $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginatedList($limit = 15, $order = 'ASC', $filters = [])
    {
        $items = $this->repository->get_paginated_items($limit, $order, $filters);
        return $items;
    }

    /**
     * @param $files
     * @return mixed
     */
    public function imageUpload($file, $uuid)
    {
        $fileCount = count($file);
        $data = [];
        for ($i = 0; $i < $fileCount; $i++) {
            if ($file[$i] instanceof UploadedFile) {
                $publicDir = 'public/media/file/';
                $storageDir = '/storage/media/file/';
                $thumbnailDir = 'public/media/thumbnail/';
                $storageThumbnailDir = '/storage/media/thumbnail/';
                $fileOrginalName = $file[$i]->getClientOriginalName();
                $fileName = pathinfo($fileOrginalName, PATHINFO_FILENAME);
                $fileType = $file[$i]->getClientMimeType();
                $filesize = $file[$i]->getSize();
                if (strpos($file[$i]->getClientMimeType(), 'image') !== false) {
                    $dimension = getimagesize($file[$i]);
                    $dimension = "{$dimension[0]} x {$dimension[1]}";
                } else {
                    $dimension = '';
                }
                $file[$i]->storeAs($publicDir, $fileOrginalName);
                $thumbName = 'thumb-' . $fileOrginalName;
                $file[$i]->storeAs($thumbnailDir, $thumbName);
                $thumbnailpath = public_path($storageThumbnailDir . $thumbName);
                Image::make($thumbnailpath)->resize(100, 100)->save($thumbnailpath);
                $data[$i] = [
                    'filename' => $fileName,
                    'uuid' => $uuid[$i],
                    'filetype'=>$fileType,
                    'filesize'=>$filesize,
                    'original_name'=>$fileOrginalName,
                    'dimension'=>$dimension,
                    'url'=>$storageDir . $fileOrginalName,
                    'thumbnail_url'=>$storageThumbnailDir . $thumbName
                ];

            }
        }
        return $data;
    }


    public function getByFieldName($field, $value)
    {
        $item = $this->repository->get_item_by_field_name($field, $value);
        return $item;
    }
}
