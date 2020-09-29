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

        $result = $this->transformTree($res);

        return response()->json($result[0]->children, 200);
    }

    private function transformTree($treeArray, $parentId = 1)
    {
        $output = [];

        // Read through all nodes of the tree
        foreach ($treeArray as $node) {
            // If the node parent is same as parent passed in argument
            if ($node->id_parent == $parentId) {

                // Get all the children for that node, using recursive method
                $children = $this->transformTree($treeArray, $node->id_category);

                // If children are found, add it to the node children array
                if ($children) {
                    $node->children = $children;
                }

                // Add the main node with/without children to the main output
                $output[] = $node;

                // Remove the node from main array to avoid duplicate reading, speed up the process
                unset($node);
            }
        }

        return $output;
    }

    private function getCategory() {

        $res = \DB::connection('shop')->select(\DB::raw('
            SELECT
            pts_category.id_category,
            pts_category.id_parent,
            pts_category_lang.name AS cat
            FROM pts_category
            INNER JOIN pts_category_lang ON pts_category_lang.id_category = pts_category.id_category
            WHERE
            pts_category.level_depth > 0
            ORDER BY pts_category.id_parent, pts_category.id_category
            '));

        return $res;
    }
}
