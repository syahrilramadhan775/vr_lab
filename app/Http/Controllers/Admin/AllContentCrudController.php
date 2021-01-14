<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\Backpack\AllContentResource;
use App\Models\Category\Category;
use App\Models\Content\Content;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AllContentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AllContentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Content::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/all-content');
        CRUD::setEntityNameStrings('Content', 'Contents');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // dd($this->crud->getListView());

        $this->crud->setListView('admin.content');

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
                    $this->crud->addClause(
                        'where',
                        'category_id',
                        $value
                    );
            }
        );

        // Subcategory Filter
        $this->crud->addFilter(
            [
                'name'  => 'sort',
                'type'  => 'select2',
                'label' =>  "Sortir"
            ],
            [
                1 => 'nama dari a-z',
                2 => 'nama dari z-a',
            ],
            function ($value) { // if the filter is active


                // null returned
                if (!$value) return;

                $params = [
                    'column' => 'id',
                    'sort' => 'desc'
                ];

                switch ($value) {
                    case 1:
                        $params = [
                            'column' => 'title',
                            'sort' => 'asc',
                        ];
                        break;
                    case 2:
                        $params = [
                            'column' => 'title',
                            'sort' => 'desc',
                        ];
                        break;
                }

                if ($params['column'] === 'title')
                    $this->crud->orderBy($params['column'], $params['sort']);
            }
        );

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * The search function that is called by the data table.
     *
     * @return array JSON Array of cells in HTML form.
     */
    public function search()
    {

        $perPage = 3 * 4;

        $this->crud->hasAccessOrFail('list');

        // Pagination Length Of One page
        $this->crud->take($perPage);

        $this->crud->applyUnappliedFilters();

        $totalRows = $this->crud->model->count();
        $filteredRows = $this->crud->query->toBase()->getCountForPagination();
        $startIndex = 0;
        // if a search term was present
        if (request()->has('search')) {

            $search = request()->post('search');

            // filter the results accordingly
            // $this->crud->applySearchTerm(request()->post('search'));

            $this->crud->addClause('where', 'title', 'like', "%$search%");
            // recalculate the number of filtered rows
            $filteredRows = $this->crud->count();
        }

        // Starting New Request
        if (request()->post('page', 1) > 1)
            $this->crud->skip(((int) request()->post('page') - 1) * $perPage);


        $entries = $this->crud->getEntries();

        return [
            'data' => AllContentResource::collection($entries),
            'filteredRows' => $filteredRows,
            'totalPage' => ceil($filteredRows / $perPage),
            'totalRows' => $totalRows,
        ];
    }
}
