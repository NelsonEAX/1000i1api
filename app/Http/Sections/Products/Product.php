<?php

namespace App\Http\Sections\Products;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;

//use \App\Models\Products\Category;
/**
 * Class Product
 *
 * @property \App\Models\Products\Product $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Product extends Section
{
    protected $model = \App\Models\Products\Product::class;
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Продукция';

    /**
     * @var string
     */
    protected $alias = 'products/product';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatables()/*->with('users')*/
        ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('10px'),
                AdminColumn::text('name', 'Название'),
                // todo:сделать редактирование по месту
                AdminColumn::text('orderby', 'Порядок')->setWidth('10px'),
                AdminColumn::text('enable', 'Активность')->setWidth('10px'),
                AdminColumn::text('price.purchase', 'Закуп'),
                AdminColumn::text('price.wholesale', 'Оптовая'),
                AdminColumn::text('price.dealer', 'Дилерская'),
                AdminColumn::text('price.retail', 'Розничная'),
                AdminColumn::text('price.negotiable', 'Договорная')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $display = AdminDisplay::tabbed();
        $display->setTabs(function() use ($id) {
            $tabs = [];
            $main = AdminForm::panel();
            $price = AdminForm::panel();
            $photo = AdminForm::panel();
            $main->addBody([
                AdminFormElement::columns()->addColumn([
                    AdminFormElement::text('name', 'Название')
                        ->required()
                        ->addValidationRule('unique:products,name,'.$id, 'Это Название уже занято, пробуй еще!'),
                    AdminFormElement::number('orderby', 'Порядок')
                        ->required()
                        ->setDefaultValue(100)
                        ->setMin(0)
                        ->setMax(999),
                    AdminFormElement::checkbox('enable', 'Активность')
                        ->required()
                        ->setDefaultValue(true),
                    AdminFormElement::select('category_id', 'Категория', \App\Models\Products\Category::class)
                        ->required()
                        ->setDisplay('name')
                ], 4)
            ]);

            if (!is_null($id)) {
                $pprice = \App\Models\Products\ProductPrice::where('product_id', $id)
                    ->where('deleted_at', null)
                    ->orderBy('id', 'desc')
                    ->first();

                $price->addBody([
                    AdminFormElement::columns()->addColumn([
                        AdminFormElement::hidden('product_id')
                            ->required()
                            ->setHtmlAttribute('value', $id),
                        AdminFormElement::text('purchase', 'Закуп')
                            ->required()
                            ->setHtmlAttribute('value', $pprice ? $pprice->purchase : 0 ),
                        AdminFormElement::text('wholesale', 'Оптовая')
                            ->required()
                            ->setHtmlAttribute('value', $pprice ? $pprice->wholesale : 0 ),
                        AdminFormElement::text('dealer', 'Дилерская')
                            ->required()
                            ->setHtmlAttribute('value', $pprice ? $pprice->dealer : 0 ),
                        AdminFormElement::text('retail', 'Розничная')
                            ->required()
                            ->setHtmlAttribute('value', $pprice ? $pprice->retail : 0 ),
                        AdminFormElement::text('negotiable', 'Договорная')
                            ->required()
                            ->setHtmlAttribute('value', $pprice ? $pprice->negotiable : 0 )
                    ], 4)
                ]);
            }

            $product_price = new ProductPrice($this->app, $this->class);
            $price->setAction($product_price->getCreateUrl());

            if (!is_null($id)) { // Если продукция создана и у нее есть ID 
                $photo = AdminDisplay::table()
                    ->setModelClass(\App\Models\Storages\Storage::class) // Обязательно необходимо указать класс модели
                    ->setApply(function($query) use($id) {
                        $query->where('product_id', $id); // Фильтруем список фотографий по ID продукции
                    })
                    ->setParameter('product_id', $id) // При нажатии на кнопку "добавить" - подставлять ид продукции
                    ->setColumns(
                        AdminColumn::link('name', 'Назавние'),
                        AdminColumn::image('url', 'Изображение')
                            ->setHtmlAttribute('class', 'text-center')
                            ->setWidth('200px')
                    );
            }

            array_push($tabs, AdminDisplay::tab($main)->setLabel('Характеристики')
                ->setActive(true)
                ->setIcon('<i class="fa fa-id-card-o"></i>'));
            array_push($tabs, AdminDisplay::tab($price)->setLabel('Цены')
                ->setActive(false)
                ->setIcon('<i class="fa fa-rub"></i>'));
            array_push($tabs, AdminDisplay::tab($photo)->setLabel('Изображения')
                ->setActive(false)
                ->setIcon('<i class="fa fa-picture-o"></i>'));
            return $tabs;
        });
        return $display;
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
    /*public function onDelete($id)
    {
        // todo: remove if unused
    }*/

    /**
     * @return void
     */
    /*public function onRestore($id)
    {
        // todo: remove if unused
    }*/
}
