<?php

namespace App\Http\Sections\Products;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;

/**
 * Class ProductPrice
 *
 * @property \App\Models\Products\ProductPrice $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class ProductPrice extends Section
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
    protected $title = 'Цены';

    /**
     * @var string
     */
    protected $alias = 'products/price';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        // todo: remove if unused
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        if(Input::has('product_id')) {
            $price = AdminForm::panel();

            $price->addBody([
                AdminFormElement::columns()->addColumn([
                    AdminFormElement::text('product_id', 'Закуп'),
                    AdminFormElement::text('purchase', 'Закуп')
                        ->required()
                        ->addValidationRule('regex:/^[0-9]*[.]?[0-9]{1,2}$/', 'Пример: 1234.56'),
                    AdminFormElement::text('wholesale', 'Оптовая')
                        ->required()
                        ->addValidationRule('regex:/^[0-9]*[.]?[0-9]{1,2}$/', 'Пример: 1234.56'),
                    AdminFormElement::text('dealer', 'Дилерская')
                        ->required()
                        ->addValidationRule('regex:/^[0-9]*[.]?[0-9]{1,2}$/', 'Пример: 1234.56'),
                    AdminFormElement::text('retail', 'Розничная')
                        ->required()
                        ->addValidationRule('regex:/^[0-9]*[.]?[0-9]{1,2}$/', 'Пример: 1234.56'),
                    AdminFormElement::text('negotiable', 'Договорная')
                        ->required()
                        ->addValidationRule('regex:/^[0-9]*[.]?[0-9]{1,2}$/', 'Пример: 1234.56')
                ], 4)
            ]);

            return $price;
        }else{
            return Redirect::back();
        }

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
    public function onRestore($id)
    {
        // todo: remove if unused
    }
}
