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

class DbLandingSettings extends Section implements Initializable
{
	
	protected $model = '\App\Models\DbLanding';
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
    protected $title = '1000i1potolock | Лендинги';

    /**
     * @var string
     */
    protected $alias = 'potolok/land';
    
    
    

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
    	return AdminDisplay::table()/*->with('users')*/
    	->setHtmlAttribute('class', 'table-primary')
    	->setColumns(
    			AdminColumn::text('land_id', '#')->setWidth('30px'),
    			AdminColumn::text('land_pref', 'Поддомен')->setWidth('200px'),
    			AdminColumn::text('land_adres', 'Адрес')
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
    	return AdminForm::panel()->addBody([
			AdminFormElement::text('land_pref', 'Поддомен')->required(),
			AdminFormElement::text('land_adres', 'Адрес')->required(),
			AdminFormElement::text('land_ya_verif', 'Yandex верификация')->required(),
			AdminFormElement::text('land_go_verif', 'Google верификация')->required(),
			AdminFormElement::text('land_post', 'Индекс'),
			AdminFormElement::text('land_geo', 'Координаты'),
			AdminFormElement::textarea('land_desc_satin', 'satin'),
			AdminFormElement::textarea('land_desc_glossy', 'glossy'),
			AdminFormElement::textarea('land_desc_matt', 'matt'),
			AdminFormElement::textarea('land_desc_multi', 'multi'),
			AdminFormElement::textarea('land_desc_photo', 'photo'),
			AdminFormElement::textarea('land_desc_carved', 'carved'),
			AdminFormElement::textarea('land_desc_tissue', 'tissue')
    	]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
    	return AdminForm::panel()->addBody([
			AdminFormElement::text('land_pref', 'Поддомен')->required(),
			AdminFormElement::text('land_adres', 'Адрес')->required(),
			AdminFormElement::text('land_ya_verif', 'Yandex верификация'),
			AdminFormElement::text('land_go_verif', 'Google верификация'),
			AdminFormElement::text('land_post', 'Индекс'),
			AdminFormElement::text('land_geo', 'Координаты'),
			AdminFormElement::textarea('land_desc_satin', 'satin'),
			AdminFormElement::textarea('land_desc_glossy', 'glossy'),
			AdminFormElement::textarea('land_desc_matt', 'matt'),
			AdminFormElement::textarea('land_desc_multi', 'multi'),
			AdminFormElement::textarea('land_desc_photo', 'photo'),
			AdminFormElement::textarea('land_desc_carved', 'carved'),
			AdminFormElement::textarea('land_desc_tissue', 'tissue')
    	]);
    	 
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
    	
    	 
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // todo: remove if unused
    }
}
