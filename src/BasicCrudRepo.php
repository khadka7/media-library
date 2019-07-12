<?php
/**
 * Created by PhpStorm.
 * User: khadka
 * Date: 6/10/18
 * Time: 1:45 PM
 */

namespace Khadka7\MediaLibrary;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Trait BasicCrudRepo
 * @package App\Helpers
 */
trait BasicCrudRepo
{

    /**
     * Return One
     *
     * @param $id
     * @return mixed
     */
    function getById($id){
        $entity = $this->model->findOrFail($id);
        return $entity;
    }

    function getBySlug($slug){
        $entity = $this->model::where([
            'slug'=>$slug,
            'deleted_at'=>null
        ])->first();
        return $entity;
    }


    function getByIdStatus($id,$status){
        $entity = $this->model::where([
            'id'=>$id,
            'status'=>$status
        ])->first();
        return $entity;
    }
    /**
     * Create One
     *
     * @param $data
     * @return mixed
     */
    function create($data){
        $e = $this->model->create($data);
        return $e;
    }

    /**
     * Update One
     *
     * @param $data
     * @param $id
     * @return mixed
     */

    function update($data, $id){

        $entity = $this->model->findOrFail($id);

        if(!array_key_exists('id', $data)) $data['id'] = $id;

        $entity->update($data);

        return $entity;
    }

    /**
     * @param $data
     * @param $slug
     * @return mixed
     */
    function updateBySlug($data, $slug){
        $entity = $this->getBySlug($slug);

        if(!array_key_exists('slug', $data)) $data['slug'] = $slug;

        $entity->update($data);

        return $entity;
    }


    /**
     * Delete One
     *
     * @param $request
     * @param $id
     * @return bool
     */
    function delete($id){
        $entity = $this->model->findOrFail($id);
        $entity->delete();

        if($entity->delete()){ return [null]; }
        return false;
    }

    /**
     * @param $slug
     * @return array|bool
     */
    function deleteBySlug($slug){
        $entity = $this->getBySlug($slug);
        $entity->delete();

        return false;
    }

    /**
     * @return mixed
     */
    function all(){
        return $this->model
                ->where('deleted_at',null)
                ->orderBy('id', 'DESC')->get();
    }

    /**
     * @return mixed
     */
    function paginatedItems($limit=15,$order='DESC'){
        return $this->model
            ->where('deleted_at',null)
            ->orderBy( 'id', $order)
            ->paginate($limit);
    }

    function count(){
        return count($this->all());
    }
}