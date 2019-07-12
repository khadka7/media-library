<?php
/*
 * @author Sanjay Khadka <khadka.sk7@gmail.com>.
 *
 */

namespace Khadka7\MediaLibrary\Http\Interfaces;


interface MediaInterface
{
    /**
    * @param array $filters
    * @return mixed
    */
    public function get_items_query($filters=[]);

    /**
     * @return mixed
     * @param array $filters
     */
    public function get_all_items($filters=[]);

    /**
     * @param $limit
     * @param $order
     * @return mixed
     */
    public function get_paginated_items($limit,$order,$filters=[]);

    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    public function get_item_by_field_name($field,$value);
}
