<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CupCakeRequestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Store;
/**
 * Class CupCakeRequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CupCakeRequestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\UserCupCake');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/cupcakerequest');
        $this->crud->setEntityNameStrings('Cup Cake Request', 'Cup Cake Requests');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn('StoreName');
        $this->crud->addColumn('email');
        
        $this->crud->addColumn(['name'=>'programmed_date_to_pick',
                                'label'=>'Date']);


        $this->crud->denyAccess(['create','show']);
        $stores= Store::all();
        $store_drop_down=[];
        foreach ($stores as $store){
            $store_drop_down[$store->id]= $store->id . " :: ".$store->name;

        }

        $this->crud->addFilter([
            'name' => 'Store',
            'type' => 'dropdown',
            'label'=> 'Store'
          ], $store_drop_down, function($value) { // if the filter is active
             $this->crud->addClause('where', 'store_id', $value);
          });

        // filter per store
        
        // filter per date




    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CupCakeRequestRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
