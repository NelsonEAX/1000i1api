<?php

namespace App\Http\Controllers;

use App\Models\Products\Product;
use App\Models\Products\ProductCategory;
use App\Models\Products\ProductPrice;
use App\Models\Products\ProductStock;
use App\Models\Products\Category;
use App\Models\Products\Manufacturer;
use App\Models\Products\Vendor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Product::all();
        return Product::all('id')->toArray();
        //return \App\Models\Products\Product::all(); //2
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    /**
     * Get all categories with descriptions and image.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function categories_full()
    {
        $categories = \DB::select('
            SELECT
            c.`id`,
            c.`name`,
            c.`description`,
            CONCAT(
                \'[\',
                GROUP_CONCAT(
                    CONCAT(\'{"name":"\', /*s.`path`, \'/\',*/ s.`uuid`, \'", "dir":"categories/", "ext":"\', s.`extension`, \'"}\') 
                    ORDER BY s.`uuid` ASC 
                    SEPARATOR \',\'
                ),
                \']\' 
            ) as `imgs`
            FROM `categories` c
            LEFT JOIN `storages` s ON s.`category_id` = c.`id`
            WHERE c.`enable` = true
            GROUP BY c.`id`,
            c.`name`,
            c.`description`
            ORDER BY c.`orderby`
        ');

        foreach($categories as $category)
        {
            $category->imgs = json_decode($category->imgs);
        }
        return response()->json($categories);
    }

    /**
     * Get all categories.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $categories = \DB::select('
            SELECT c.`id` , c.`name` 
            FROM  `categories` c
            LEFT JOIN  `storages` s ON s.`category_id` = c.`id`
            WHERE c.`enable` = TRUE 
            GROUP BY c.`id` , c.`name` 
            ORDER BY c.`orderby`
        ');

        return response()->json($categories);
    }

    /**
     * Get all products.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
       // $products = Product::storage::find(6);
        /*$products = \DB::table('products')
            ->leftJoin('storage_products', 'products.id', '=', 'storage_products.product')
            ->leftJoin('storages', 'storages.id', '=', 'storage_products.storage')
            ->select(
                'products.name',
                'products.description',
                'products.model',
                'storages.path',
                'storages.uuid',
                'storages.extension'
            )
            ->get();*/
        
        $products = \DB::select('
            SELECT
            p.`id`,
            p.`name`,
            p.`description`,
            p.`model`,
            p.`category_id`,
            pp.`purchase`,
            pp.`wholesale`,
            pp.`dealer`,
            pp.`retail`,
            pp.`negotiable`,
            CONCAT(
                \'[\',
                GROUP_CONCAT(
                    CONCAT(\'{"name":"\', /*s.`path`, \'/\',*/ s.`uuid`, \'", "dir":"products/", "ext":"\', s.`extension`, \'"}\') 
                    ORDER BY s.`uuid` ASC 
                    SEPARATOR \',\'
                ),
                \']\' 
            ) as `imgs`
            FROM  `products` p
            LEFT JOIN `storages` s ON s.`product_id` = p.`id` 
            LEFT JOIN `product_prices` pp ON pp.`product_id` = p.`id` and pp.`id` = (SELECT max(id) FROM `product_prices` WHERE `product_id` = p.`id`)
            WHERE p.`enable` = true
            GROUP BY p.`id`,
            p.`name`,
            p.`description`,
            p.`model`,
            p.`category_id`,
            pp.`purchase`,
            pp.`wholesale`,
            pp.`dealer`,
            pp.`retail`,
            pp.`negotiable`
            ORDER BY p.`orderby`
        ');

        foreach($products as $product)
        {
            $product->imgs = json_decode($product->imgs);
        }
        return response()->json($products);
    }
}
