<?php

namespace App\Http\Sections;

use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;

class DbFeedbackSettings extends Section implements Initializable
{
	protected $model = '\App\Models\land_1000i1potolok\DbFeedback';
	public function initialize()
	{
		// Добавление пункта меню и счетчика кол-ва записей в разделе
		/*$this->addToNavigation($priority = 500, function() {
		 return \App\Models\DbLanding::count();
			});*/
	
		/*$this->creating(function($config, \Illuminate\Database\Eloquent\Model $model) {
		 //...
			});*/
	}
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = "1000i1potolok | Обратная связь";

    /**
     * @var string
     */
    protected $alias = 'potolok/feedback';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
    	return AdminDisplay::datatables()/*->with('users')*/
    	->setHtmlAttribute('class', 'table-primary')
    	->setColumns(
    			AdminColumn::text('fb_id', '#')->setWidth('30px'),
    			AdminColumn::text('fb_phone', 'Поддомен')->setWidth('100px'),
    			AdminColumn::text('fb_name', 'Адрес')->setWidth('50px'),
    			AdminColumn::text('fb_datetime', 'Адрес')->setWidth('50px')
    			//AdminColumn::text('description', 'Описание')
    			)->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        // todo: remove if unused
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
