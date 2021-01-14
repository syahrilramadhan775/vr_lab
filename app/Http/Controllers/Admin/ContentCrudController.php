<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content\Content;
use App\Http\Requests\ContentRequest;
use App\Models\Category\Category;
use App\Models\Subscriptions\SubscriptionType;
use App\Utils\AppAsset;
use App\Utils\UI;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /** @var Boolean */
    private $temp;

    /**
     * Check If User Is Admin
     * 
     * @return Boolean
     */
    protected function isAdmin()
    {
        if (!is_null($this->temp)) return $this->temp;

        return $this->temp = backpack_user()->hasRole('admin');
    }

    /**
     * 
     * 
     */
    private function userPrivilages()
    {
        if (!$this->isAdmin()) {
            // filtering By

            $this->crud->addClause('whereHas', 'SubcriptionType', function ($subscriptionType) {
                $subscriptionType->where('order', '<=', backpack_user()->UserSubcription->SubcriptionType->order);
            });

            // Denyable access
            $this->crud->denyAccess('update');
            $this->crud->denyAccess('delete');
            $this->crud->denyAccess('create');
        }
    }

    private function defineColumn()
    {

        // Title Column
        $this->crud->addColumn([
            'name' => 'title',
            'type' => 'text',
        ]);

        // Subcategory title Column
        $this->crud->addColumn([
            'name'  => 'Category.title',
            'type'  => 'text',
            'label' => 'Category'
        ]);

        // Desription Column
        $this->crud->addColumn([
            'name' => 'description',
            'type' => 'text',
            // 'label' => 'bab',
        ]);
    }




    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        $PluralName = $this->isAdmin() ? 'Contents' : 'My Contents';
        $SingularName = $this->isAdmin() ? 'Content' : 'My Content';

        CRUD::setModel(Content::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/content');
        CRUD::setEntityNameStrings($SingularName, $PluralName);

        $this->crud->setOperationSetting('setFromDb', false);

        $this->userPrivilages();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        //  =========================== COLUMNS ===========================

        // Setting Global Column
        $this->defineColumn();

        //  =========================== Filter ===========================

        $this->crud->addFilter(
            [
                'name'  => 'category',
                'type'  => 'select2',
                'label' =>  'Category'
            ],
            Category::all()->pluck('title', 'id')->all(),
            function ($value) { // if the filter is active
                if ($value)
                    $this->crud->addClause('where', 'category_id', $value);
            }
        );
    }

    protected function setupShowOperation()
    {


        //  =========================== COLUMNS ===========================

        // Calling Defined Column
        $this->defineColumn();

        // Video Player
        $this->crud->addColumn([
            'name'  => 'video_path',
            'type'  => 'appVideo',
            'label' => 'Video',
            'path'  => function ($entry) {
                // return AppAsset::url(AppAsset::VIDEO, $entry->video_path);
                return  $entry->video_path;
            }
        ]);
    }


    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ContentRequest::class);

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
