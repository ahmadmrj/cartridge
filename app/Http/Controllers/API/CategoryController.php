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
        $res = \DB::connection('shop')->select(\DB::raw('
            SELECT
            pts_category.id_category,
            pts_category_lang.name AS cat,
            catgroup.id_category AS group_id,
            catgroup_lang.name AS group_name
            FROM pts_category
            INNER JOIN pts_category_lang ON pts_category_lang.id_category = pts_category.id_category
            INNER JOIN pts_category catgroup ON catgroup.id_parent = pts_category.id_category
            INNER JOIN pts_category_lang catgroup_lang ON catgroup_lang.id_category = catgroup.id_category
            WHERE
            pts_category.level_depth = 2
            AND pts_category.id_category < 200
        '));

        $result = [];

        foreach ($res as $item) {
            if(!isset($result[$item->id_category])) {
                $result[$item->id_category] = new \stdClass();
                $result[$item->id_category]->name = $item->cat;
                $result[$item->id_category]->id = $item->id_category;
                $result[$item->id_category]->children = [];
            }

            array_push($result[$item->id_category]->children, [
                'group_name' => $item->group_name,
                'group_id' => $item->group_id
            ]);
        }

        $finalRes = [];

        foreach ($result as $value) {
            $finalRes[] = $value;
        }

        return response()->json($finalRes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
