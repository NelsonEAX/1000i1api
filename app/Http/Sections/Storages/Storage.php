<?php

namespace App\Http\Sections\Storages;


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


        $elements = [];

        if(Input::has('user_id')){
            $storage_path = substr( LaravelStorage::disk('storage')->url('users'), 1);
            array_push( $elements,
                AdminFormElement::hidden('user_id')->setHtmlAttribute('value',Input::get('user_id')) );
        }else if(Input::has('order_id')){
            $storage_path = substr( LaravelStorage::disk('storage')->url('orders'), 1);
            array_push( $elements,
                AdminFormElement::hidden('order_id')->setHtmlAttribute('value',Input::get('order_id')) );
        }else if(Input::has('product_id')){
            $storage_path = substr( LaravelStorage::disk('storage')->url('products'), 1);
            array_push( $elements,
                AdminFormElement::hidden('product_id')->setHtmlAttribute('value',Input::get('product_id')) );
        }else if(Input::has('category_id')){
            $storage_path = substr( LaravelStorage::disk('storage')->url('categories'), 1);
            array_push( $elements,
                AdminFormElement::hidden('category_id')->setHtmlAttribute('value',Input::get('category_id')) );
        }else{
            $storage_path = 'storage/uploads';
        }


        $panel = AdminForm::panel();
        array_push( $elements,
            AdminFormElement::hidden('sleeping_owl')->setHtmlAttribute('value',true) );
        array_push( $elements, AdminFormElement::images('images', 'Images')
            ->setUploadPath(function(\Illuminate\Http\UploadedFile $file) use ($storage_path){
                return $storage_path;
            })
            ->setUploadFileName(function(\Illuminate\Http\UploadedFile $file) {
                $faker = \Faker\Factory::create();
                return $faker->uuid.'.'.$file->getClientOriginalExtension();
            })
            ->setUploadSettings([
                'orientate' => [],
                'resize' => [1920, 1080, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                }],
                /* TODO: Конвертировать в png
                 * 'encode' => ['png']
                 */
                /* TODO: Обрезать загружаемые изображения для продукции
                 * 'fit' => [200, 300, function ($constraint) {
                 * $constraint->upsize();
                 * $constraint->aspectRatio();
                 * }]
                 */
            ])
        );

        $panel->addBody($elements);
        return $panel;
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
