<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CartRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CartCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CartCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Cart::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cart');
        CRUD::setEntityNameStrings('cart', 'carts');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */

        $this->crud->addColumn(
            [
                'type' => 'table',
                'name' => 'products',
                'label' => 'Products',
                'columns' => [
                    'name' => 'Product name',
                    'price' => 'Product price',
                    'pivot->qty' => 'Quantity',
                ],
            ]
        );
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CartRequest::class);

//        CRUD::addField([
//            'type' => 'select2_multiple',
//            'name' => 'products', // the relationship name in your Model
//            'entity' => 'products', // the relationship name in your Model
//            'attribute' => 'name', // attribute on Article that is shown to admin
//            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
//        ]);

        $this->crud->addField(
            [   // repeatable
                'name' => 'products',
                'label' => 'Products',
                'type' => 'repeatable',
                'fields' => [
                    [
                        'label' => "Product Name",
                        'type' => 'select2',
                        'name' => 'name',
                        'pivot' => true,

                        'entity' => 'products',

                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ],
//                    [
//                        'name' => "pivot->qty",
//                        'type' => 'number',
//                        'default' => 1,
//                        'label' => 'Quantity',
//                        'wrapper' => ['class' => 'form-group col-md-4'],
//                    ],
                ],
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?

            ],
        );

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
