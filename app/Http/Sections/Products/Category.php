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

/**
 * Class Category
 *
 * @property \App\Models\Products\Category $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Category extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Категории';

    /**
     * @var string
     */
    protected $alias = 'products/category';

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
                AdminColumn::text('order', 'Порядок')->setWidth('10px'),
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
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Название')
                ->required()
                ->addValidationRule('unique:categories,name,'.$id, 'Это Название уже занято, пробуй еще!'),
            AdminFormElement::textarea('description', 'Описание'),
            AdminFormElement::number('order', 'Порядок')
                ->required()
                ->setDefaultValue(100)
                ->setMin(0)
                ->setMax(999),
            AdminFormElement::checkbox('enable', 'Активность')
                ->required()
                ->setDefaultValue(true),
        ]);
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
