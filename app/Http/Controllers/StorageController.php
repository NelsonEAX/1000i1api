<?php

namespace App\Http\Controllers;

use App\Models\Storages\Storage;
use App\Models\Storages\StorageCategory;
use App\Models\Storages\StorageOrder;
use App\Models\Storages\StorageProduct;
use App\Models\Storages\StorageUser;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Return image from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getImageFromParam($filename, $params)
    {
        $width = $this->getWidth($params);
        $height = $this->getHeight($params);
        $extension = $this->getExtension($params);
        $thumbnail = '';
        $size = '';

        if( $width && $height ){
            $thumbnail = 'thumbnails/';
            $size = '_'.$width.'x'.$height;
        }

        $storage_file = public_path('storage/'.$thumbnail.$filename.$size.$extension);
        $origin_file = public_path('storage/'.$filename.$extension);
        /**return response()->json([
            'storage' => [
                'name' => $filename,
                'params' => $params,
                'width' => $width ,
                'height' => $height,
                'extension' => $extension,
                'thumbnail' => $thumbnail,
                'size' => $size,
                'filename' => $storage_file,
                'origin_file' => $origin_file
            ]
        ]);*/
        if( \File::exists( $storage_file ) ){
            return \Image::make( $storage_file )
                ->response();
        } else {
            return \Image::make( $origin_file )
                ->resize( $width, $height )
                ->save( $storage_file )
                ->response();
        }
    }

    /**
     * Return $extension from $params.
     *
     * @param  string  $params
     * @return $extension
     */
    protected function getExtension($params){
        $pos = strrpos( $params, '.' );
        if ( $pos >= 0 ) {
            return substr( $params, $pos );
        } else {
            return '';
        }
    }

    /**
     * Return $width from $params.
     *
     * @param  string  $params
     * @return $width
     */
    protected function getWidth($params){
        $pos_th = strrpos( $params, 'th' );
        $pos_x = strrpos( $params, 'x' );
        if ( $pos_th >= 0 && $pos_x >= 0 && $pos_x > $pos_th ) {
            return substr( $params, $pos_th + 2, $pos_x - $pos_th - 2 );
        } else {
            return null;
        }
    }

    /**
     * Return $height from $params.
     *
     * @param  string  $params
     * @return $height
     */
    protected function getHeight($params){
        $pos_x = strrpos( $params, 'x' );
        $pos_p = strrpos( $params, '.' );
        if ( $pos_p > 0 && $pos_x >= 0 && $pos_p > $pos_x ) {
            return substr( $params, $pos_x + 1, $pos_p - $pos_x - 1 );
        } else {
            return null;
        }
    }
}
