<?php

namespace App\Http\Sections\Storages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage as LaravelStorage;
use App\Events\DeleteFromStorageEvent;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;

/**
 * Class Product
 *
 * @property \App\Models\Storages\Storage $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Storage extends Section
{
    protected $model = \App\Models\Storages\Storage::class;
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Изображения';

    /**
     * @var string
     */
    protected $alias = 'storages/storage';
    protected $request;
    public function __construct(Illuminate\Foundation\Application $act, Request $request)
    {
        $this->request = $request;
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatables()/*->with('users')*/
        ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::link('name', 'Назавние'),
                AdminColumn::image('url', 'Изображение')
                    ->setHtmlAttribute('class', 'text-center')
                    ->setWidth('200px'),
                // todo:сделать редактирование по месту
                AdminColumn::text('enable', 'Активность')->setWidth('10px')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        /*return AdminForm::panel()->addBody([
            AdminFormElement::images('string $key', 'string $label = null')
                ->setUploadPath(function(\Illuminate\Http\UploadedFile $file) {
                    //dd($file);
                    return 'storage/test'; // public/files
                })
                ->setUploadSettings([
                    'orientate' => [],
                    'resize' => [1280, null, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    }],
                    'fit' => [200, 300, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    }]
                ])
    	]);*/
        
       /* if( Input::has('user_id') || Input::has('order_id') || Input::has('product_id') || Input::has('category_id') ){
            echo 'Нихуя все норм';
        } else {
            echo 'Нихуя нет';
        }*/
        
        dd($this->request->url());
        if(Input::has('user_id')){
            $storage_path = LaravelStorage::disk('storage')->url('users');
            $this->storage_path = 'storage/users';
        }else if(Input::has('order_id')){
            $storage_path = LaravelStorage::disk('storage')->url('orders');
            $this->storage_path = 'storage/orders';
        }else if(Input::has('product_id')){
            $storage_path = LaravelStorage::disk('storage')->url('products');
            $this::$storage_path = 'storage/products';
        }else if(Input::has('category_id')){
            $storage_path = LaravelStorage::disk('storage')->url('categories');
            $this->storage_path = 'storage/categories';
        }

        /*}else{
            $storage_path = 'storage/test';
        }*/

        //dd($storage_path);
        //echo $storage_path;
        
        return AdminForm::panel()->addBody([
            AdminFormElement::images('images', 'Images')
                ->setUploadPath(function(\Illuminate\Http\UploadedFile $file){
                    if(Input::has('user_id')){
                        $storage_path = LaravelStorage::disk('storage')->url('users');
                    }else if(Input::has('order_id')){
                        $storage_path = LaravelStorage::disk('storage')->url('orders');
                    }else if(Input::has('product_id')){
                        $storage_path = LaravelStorage::disk('storage')->url('products');
                    }else if(Input::has('category_id')){
                        $storage_path = LaravelStorage::disk('storage')->url('categories');
                    }
                    return $storage_path;
                })
        ]);//->setAction('///googlr.ru');
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);

    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }

    /**
     * @return void
     */
    /*public function onRestore($id)
    {
        // todo: remove if unused
    }*/
}
