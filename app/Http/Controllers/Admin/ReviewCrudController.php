<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReviewRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Backpack\CRUD\app\Library\Widget;

/**
 * Class ReviewCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReviewCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Review::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/review');
        CRUD::setEntityNameStrings('review', 'reviews');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('contenido')->label('Contenido')->type('text');
        CRUD::column('user')->label('Usuario')->type('select')->attribute('name');
        CRUD::column('producto')->label('Producto')->type('select')->attribute('nombre');

        CRUD::column('calificacion')->label('Calificacion')->type('rating');

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
        CRUD::setValidation(ReviewRequest::class);

        CRUD::field('contenido')->label('Contenido')->type('textarea');
        CRUD::field('user')->label('Usuario')->type('select')->attribute('name');
        CRUD::field('producto')->label('Producto')->type('select')->attribute('nombre');
        CRUD::field('calificacion')->label('Calificación')->type('rating');
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
        $review = \App\Models\Review::withTrashed()->find($id);
        $review->restore();

        \Alert::success('Review restaurada exitosamente.')->flash();
        return redirect()->back();
    }
}
