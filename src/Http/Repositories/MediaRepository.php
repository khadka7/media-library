<?php
/*
 * @author Sanjay Khadka <khadka.sk7@gmail.com>.
 *
 */
namespace Khadka7\MediaLibrary\Http\Repositories;

use Khadka7\MediaLibrary\Http\Interfaces\MediaInterface;
use Khadka7\MediaLibrary\Media;

class MediaRepository implements MediaInterface
{

    /**
     * @var Media
     */
    private $model;

    /**
     * MediaRepository constructor.
     * @param Media $model
     */
    public function __construct(Media $model){
        $this->model = $model;
    }

    /**
     * @param array $filters
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function get_items_query($filters=[])
    {
       $query = $this->model::where('deleted_at','=',null);
       $this->filterContent($filters, $query);
       return $query;
    }

    /**
     * @param array $filters
     * @return \Illuminate\Support\Collection|mixed
     */
    public function get_all_items($filters=[]){
        $items = $this->get_items_query($filters)->get();
        return $items;
    }

    /**
     * @param int $limit
     * @param string $order
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function get_paginated_items($limit, $order,$filters=[]){
        $items = $this->get_items_query($filters)
            ->orderBy('id',$order)
            ->paginate($limit);
        return $items;
    }


    /**
     * @param $filters
     * @param $data
     */
    public function filterContent($filters, $data): void
    {
        if (array_key_exists('filename', $filters)) {
            $data->where('filename', 'LIKE', '%' . $filters['filename'] . '%');
        }

    }

    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    public function get_item_by_field_name($field, $value)
    {
       $item = $this->model::where($field,'=',$value)->first();
       return $item;
    }
}
