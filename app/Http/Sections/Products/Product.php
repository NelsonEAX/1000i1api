<?php

namespace App\Http\Sections\Products;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
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
        $display = AdminDisplay::tabbed();
        $display->setTabs(function() use ($id) {
            $tabs = [];
            $main = AdminForm::panel();
            $price = AdminForm::panel();
            $photo = AdminForm::panel();
            $main->addHeader(AdminFormElement::columns()
                ->addColumn([
                        AdminFormElement::text('name', 'Название')
                            ->required()
                            ->addValidationRule('unique:products,name,'.$id, 'Это Название уже занято, пробуй еще!')
                    ], 8)
                ->addColumn([
                        AdminFormElement::number('orderby', 'Порядок')
                            ->required()
                            ->setDefaultValue(100)
                            ->setMin(0)
                            ->setMax(999)
                    ], 2)
                ->addColumn([
                        AdminFormElement::checkbox('enable', 'Активность')
                            ->required()
                            ->setDefaultValue(true)
                    ], 2)
            );
            $main->addBody([
                AdminFormElement::columns()->addColumn([
                    AdminFormElement::select('category_id', 'Категория', \App\Models\Products\Category::class)
                        ->required()
                        ->setDisplay('name')
                ], 4)

            ]);
            $main->addFooter([

            ]);

            $price->addHeader(AdminFormElement::columns()
                
            );
            $price->addBody([
                
            ]);

            if (!is_null($id)) { // Если галерея создана и у нее есть ID
                $photo = AdminDisplay::table()
                    ->setModelClass(\App\Models\Storages\Storage::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
                    ->setApply(function($query) use($id) {
                        $query->where('product_id', $id); // Фильтруем список фотографий по ID галереи
                    })
                    ->setParameter('product_id', $id) // При нажатии на кнопку "добавить" - подставлять идентификатор галереи
                    ->setColumns(
                        AdminColumn::link('name', 'Назавние'),
                        AdminColumn::image('uuid', 'Изображение')
                            ->setHtmlAttribute('class', 'text-center')
                            ->setWidth('200px')
                    );
            }

        /*$form->addBody($photos);*/
    //}


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
