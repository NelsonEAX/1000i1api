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
     * Get all categories.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $products = \DB::select('
            SELECT
            c.`id`,
            c.`name`,
            c.`description`,
            s.`path`,
            s.`uuid`,
            s.`extension`
            FROM `categories` c
            LEFT JOIN `storage_categories` sc ON sc.`category` = c.`id`
            LEFT JOIN `storages` s ON s.`id` = sc.`storage` 
        ');

        return response()->json($products);
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
            pc.`category`,
            pp.`purchase`,
            pp.`wholesale`,
            pp.`dealer`,
            pp.`retail`,
            pp.`negotiable`,
            pp.`percen_wholesale`,
            pp.`percen_dealer`,
            pp.`percen_retail`,
            s.`path`,
            s.`uuid`,
            s.`extension`
            FROM  `products` p
            LEFT JOIN `product_categories` pc ON pc.`product` = p.`id` 
            LEFT JOIN `storage_products` sp ON sp.`product` = p.`id` 
            LEFT JOIN `storages` s ON s.`id` = sp.`storage` 
            LEFT JOIN `product_prices` pp ON pp.`product` = p.`id` and pp.`id` = (SELECT max(id) FROM `product_prices` WHERE `product` = p.`id`)
        ');

        return response()->json($products);
    }
}
