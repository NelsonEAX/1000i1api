<?php

namespace App\Http\Sections\Storages;

use Event;
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
        Event::fire(new DeleteFromStorageEvent(\App\Models\Storages\Storage::find($id)));
    }

    /**
     * @return void
     */
    /*public function onRestore($id)
    {
        // todo: remove if unused
    }*/
}
