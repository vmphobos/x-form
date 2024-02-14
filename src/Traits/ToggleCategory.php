<?php
namespace XForm\Traits;

trait ToggleCategory
{
    /**
     * @param $list - An array group listing keyed by category name
     * @param $category - The key name of the category we want to get ids
     * @param $array - The array that we will store the ids of the clicked category
     * @return void
     */
    public function toggleAll($list, $category, $array)
    {
        $category = collect($list)->get($category) ?? [];
        $ids = [];

        foreach ($category as $cat) {
            $ids[] = $cat['id'];
        }

        if (empty(array_diff($ids, $this->$array))) {
            $this->$array = array_values(array_diff($this->$array, $ids));
        }
        else {
            $this->$array = array_values(array_unique(array_merge($this->$array, $ids)));
        }
    }
}

