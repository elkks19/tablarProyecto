<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DivisaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DivisaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DivisaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Divisa::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/divisa');
        CRUD::setEntityNameStrings('divisa', 'divisas');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        // ELIMINAMOS EL BOTON DE DETALLES, COSA QUE HAREMOS EN TODAS LAS VISTAS
        CRUD::removeButton('show');

        // Añadimos el botón personalizado para mostrar eliminados
        CRUD::addButtonFromView('top', 'trashed', 'trashed', 'beginning');

        // Verificamos si estamos en la vista de eliminados
        if (request()->query('trashed') == 'true') {
            // Si estamos en la vista de eliminados, quitamos todos los botones
            CRUD::removeAllButtonsFromStack('line');
            // Añadimos un botón personalizado para la restauración de los registros
            CRUD::addButtonFromView('line', 'restore', 'restore_button', 'end');

            $this->crud->query = $this->crud->query->onlyTrashed();

        } else {
            $this->crud->query = $this->crud->query->withoutTrashed();
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
        CRUD::setValidation(DivisaRequest::class);

        CRUD::field('nombre')->type('text');
        CRUD::field('simbolo')->type('text');
        CRUD::field('tasa')->type('number');
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

    public function restore($id)
    {
        $divisa = \App\Models\Divisa::withTrashed()->find($id);
        $divisa->restore();

        \Alert::success('Divisa restaurada exitosamente.')->flash();
        return redirect()->back();
    }
}
