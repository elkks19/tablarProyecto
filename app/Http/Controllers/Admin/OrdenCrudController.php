<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrdenRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Orden;
use App\Models\Pago;
use App\Models\Envio;
use App\Models\Divisa;
use App\Models\MetodoPago;

/**
 * Class OrdenCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrdenCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Orden::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/orden');
        CRUD::setEntityNameStrings('orden', 'ordenes');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('codigo')->label('Código de la orden')->type('text');

        CRUD::column('user')->label('Usuario')->type('select')->attribute('name');

        CRUD::column('estado')->label('Estado de la orden')->type('enum');

        CRUD::column('fechaPago')->label('Fecha del pago')->type('datetime');

        CRUD::column('montoPago')->label('Monto pagado')->type('number');

        CRUD::column('metodoPago')->entity('pago')->label('Metodo de pago')
            ->type('select')->attribute('nombreMetodoPago');


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
        CRUD::setValidation(OrdenRequest::class);

        Orden::creating(function ($orden) {
            $this->saveAdditionalData($orden);
        });
        // TAB PARA LA ORDEN
        CRUD::field([
            'name' => 'estado',
            'label' => 'Estado de la orden',
            'type' => 'enum',
            'tab' => 'Orden',
        ]);

        CRUD::field([
            'name' => 'user',
            'label' => 'Usuario',
            'type' => 'select',
            'attribute' => 'name',
            'tab' => 'Orden',
        ]);

        // TAB PARA EL PAGO
        CRUD::field('montoPago')->label('Monto pagado')->type('number')->tab('Pago');

        CRUD::field('fechaPago')->label('Fecha del pago')->type('datetime')->tab('Pago')
            ->entity('pago')->attribute('fechaPago');

        CRUD::field('divisa')->label('Moneda')->type('select')->tab('Pago')
            ->entity('pago')->attribute('nombreDivisa');

        CRUD::field('nombreMetodoPago')->label('Metodo de pago')->type('select')->tab('Pago')
            ->entity('pago')->attribute('nombreMetodoPago');

        CRUD::field([
            'name' => 'estadoPago',
            'label' => 'Estado del pago',
            'type' => 'enum',
            'enum_class' => 'App\Enums\EstadosPago',
            'tab' => 'Pago',
        ]);
        // TAB PARA EL ENVIO
        CRUD::field('direccionEnvio')->label('Dirección de envío')->type('text')->tab('Envío');
        CRUD::field('fechaEnvio')->label('Fecha de envío')->type('datetime')->tab('Envío');
        CRUD::field('fechaRecepcion')->label('Fecha de recepción')->type('datetime')->tab('Envío');
        CRUD::field('precioEnvio')->label('Precio de envío')->type('number')->tab('Envío');

        CRUD::field([
            'name' => 'estadoEnvio',
            'label' => 'Estado del envío',
            'type' => 'enum',
            'enum_class' => 'App\Enums\EstadosEnvio',
            'tab' => 'Envío',
        ]);
        //TAB PARA LOS PRODUCTOS
        CRUD::field([
            'name' => 'productos',
            'label' => 'Productos',
            'type' => 'product_list',
            'products' => \App\Models\Producto::all(),
            'tab' => 'Productos',
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

    public function restore($id)
    {
        $orden = \App\Models\Orden::withTrashed()->find($id);
        $orden->restore();

        \Alert::success('Orden restaurada exitosamente.')->flash();
        return redirect()->back();
    }

    protected function saveAdditionalData($orden)
    {
        // Guardar en ProductDetails
        $pago = Pago::create([
            'monto' => request('montoPago'),
            'estado' => request('estadoPago'),
            'fechaPago' => request('fechaPago'),
            'divisa_id' => request('nombreDivisa'),
            'metodo_de_pago_id' => request('metodoPago')
        ]);
        $orden->pago()->associate($pago);

        // Guardar en ProductCategories
        $envio = Envio::create([
            'estado' => request('estadoEnvio'),
            'direccion' => request('direccionEnvio'),
            'precio' => request('precioEnvio'),
            'fechaEnvio' => request('fechaEnvio'),
            'fechaRecepcion' => request('fechaRecepcion'),
        ]);
        $orden->envio()->associate($envio);

         // Obtener los datos de los productos y sus cantidades
        $productsData = $request->input('products_data');

        // Agregar los productos a la orden
        foreach ($productsData as $productData) {
            $orden->productos()->attach($productData['id'], ['cantidad' => $productData['quantity']]);
        }

        \Log::info('Productos request: '.$productos);
        \Log::info('productos orden: '.$orden->productos);
    }
}
