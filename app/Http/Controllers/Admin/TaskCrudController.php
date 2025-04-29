<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TaskCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TaskCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Task::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/task');
        CRUD::setEntityNameStrings('task', 'tasks');
        if (backpack_user()->role == 'user') {
            // Filter: hanya tampilkan task milik user yang sedang login
            CRUD::addClause('where', 'user_id', backpack_user()->id);
        }
    }
    
    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('description');
        CRUD::column('deadline');
        CRUD::column('status');
        CRUD::orderBy('deadline', 'asc');

        // Tampilkan nama user, hanya jika admin
        if (backpack_user()->role === 'admin') {
            CRUD::addColumn([
                'name' => 'user_id',
                'type' => 'select',
                'label' => 'User',
                'entity' => 'user',         // nama method relasi di model Task
                'attribute' => 'name',      // kolom yang ingin ditampilkan
                'model' => 'App\Models\User'
            ]);
        }
    }
    
    

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TaskRequest::class);
    
        CRUD::field('name');
        CRUD::field('description');
        CRUD::field('deadline')->type('date');
        CRUD::field('status')->type('enum');
    
        // Tambahkan user_id secara otomatis dari yang sedang login
        CRUD::addField([
            'name' => 'user_id',
            'type' => 'hidden',
            'value' => backpack_user()->id,
        ]);
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
    protected function setupShowOperation()
    {
        $this->setupListOperation(); // gunakan konfigurasi dari list
    }    
}
