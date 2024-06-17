<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('usuario', 'usuarios');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name')->label('Nombre')->type('text');
        CRUD::column('email')->label('Email')->type('email');
        CRUD::column('fechaNacimiento')->label('Fecha de Nacimiento')->type('date');
        CRUD::column('ci')->label('Carnet de identidad')->type('text');
        CRUD::column('roles')->label('Roles')->type('select')->attribute('name');

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
        CRUD::setValidation(UserRequest::class);

        CRUD::field('name')->label('Nombre')->type('text');
        CRUD::field('email')->label('Email')->type('text');
        CRUD::field('password')->label('Contraseña')->type('password');
        CRUD::field('fechaNacimiento')->label('Fecha de Nacimiento')->type('date')
            ->attributes(['max' => date('Y-m-d')]);
        CRUD::field('ci')->label('Carnet de identidad')->type('text');

        CRUD::field('roles')->label('Roles')->type('checklist')->attribute('name');
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
        $user = \App\Models\User::withTrashed()->find($id);
        $user->restore();

        \Alert::success('Usuario restaurado exitosamente.')->flash();
        return redirect()->back();
    }
}
