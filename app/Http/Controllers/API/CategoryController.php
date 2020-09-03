<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShopCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = $this->getCategory();

        foreach ($res as $item) {
            $groups = $this->getCategory($item->id_category);

            $item->children = $groups;

            foreach ($item->children as $child) {
                $subGroup = $this->getCategory($child->id_category);

                if ($subGroup) {
                    $child->children = $subGroup;
                }
            }
        }

        return response()->json($res, 200);
    }

    private function getCategory($subGroup = 0) {
        $condition = 'pts_category.level_depth = 2 AND pts_category.id_category < 200';

        if($subGroup) {
            $condition = "pts_category.id_parent=".$subGroup;
        }

        $res = \DB::connection('shop')->select(\DB::raw('
            SELECT
            pts_category.id_category,
            pts_category_lang.name AS cat
            FROM pts_category
            INNER JOIN pts_category_lang ON pts_category_lang.id_category = pts_category.id_category
            WHERE '.$condition));

        return $res;
    }
}
