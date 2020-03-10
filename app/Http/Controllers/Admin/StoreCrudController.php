<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StoreCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StoreCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Store');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/store');
        $this->crud->setEntityNameStrings('store', 'stores');
  



        
    }
 
    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->removeColumns(['address_lat','address_lng']);
        

        $this->crud->denyAccess('show');

      
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

 
        $this->crud->addField(['name'=>'name']);

        $this->crud->addField(['name'=>'stock_available']);
        $this->crud->addField(['name'=>'is_eligible']);
        $this->crud->addField(['name'=>'address_lat']);
        $this->crud->addField(['name'=>'address_lng']);
        
        

        
        
 

    }

    protected function setupUpdateOperation()
    {
        

        

         
        $this->setupCreateOperation();

    }
}
