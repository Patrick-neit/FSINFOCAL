<?php

use App\Http\Controllers\AdvanceUiController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BasicTableController;
use App\Http\Controllers\BasicUiController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CssController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\DosificacionEmpresaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CatalogoPrecioProductoController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\EjemploController;
use App\Http\Controllers\ExtraComponentsController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PuntoVentaController;
use App\Http\Controllers\SubFamiliaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use LukePOLO\LaraCart\Facades\LaraCart;
use App\Http\Controllers\VentasController;
use LukePOLO\LaraCart\LaraCartServiceProvider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

// Dashboard Route
// Route::get('/', [DashboardController::class, 'dashboardModern'])->middleware('verified');
/* Route::get('/', [DashboardController::class, 'dashboardModern']); */

// Authentication Route
Route::get('/', [AuthenticationController::class, 'userLogin'])->name('login');
Route::get('/user-register', [AuthenticationController::class, 'userRegister']);
Route::get('/user-forgot-password', [AuthenticationController::class, 'forgotPassword']);
Route::get('/user-lock-screen', [AuthenticationController::class, 'lockScreen']);

Route::group([
    'prefix' => 'autentification',
    'controller' => AuthenticationController::class,
], function () {
    Route::post('login', 'login')->name('autentification.login');
    Route::post('register', 'register')->name('autentification.register');
    Route::get('userLogin', 'userLogin')->name('autentification.userLogin'); //View
    Route::get('/auth/google/redirect', 'redirectLogin')->name('auth.google.redirect');
    Route::get('/login/google/callback', 'callbackLogin')->name('login.google.callback');

    // Función que se ejecuta al enviar el formulario y que enviará el email al usuario
    Route::post('/enviar-recuperar-contrasenia', 'enviarRecuperarContrasenia')->name('enviar-recuperacion');

    // Formulario donde se modificará la contraseña
    Route::get('/reiniciar-contrasenia/{token}', 'formularioActualizacion')->name('formulario-actualizar-contrasenia');

    // Función que actualiza la contraseña del usuario
    Route::post('/actualizar-contrasenia', 'actualizarContrasenia')->name('actualizar-contrasenia');
});

Route::group([
    'prefix' => 'dashboard',
    'controller' => DashboardController::class,
], function () {
    Route::get('dashboardModern', 'dashboardModern')->name('dashboard.dashboardModern');
    Route::get('dashboardEcommerce', 'dashboardEcommerce');
    Route::get('dashboardAnalytics', 'dashboardAnalytics');
});

// Application Route
Route::get('/app-email', [ApplicationController::class, 'emailApp']);
Route::get('/app-email/content', [ApplicationController::class, 'emailContentApp']);
Route::get('/app-chat', [ApplicationController::class, 'chatApp']);
Route::get('/app-todo', [ApplicationController::class, 'todoApp']);
Route::get('/app-kanban', [ApplicationController::class, 'kanbanApp']);
Route::get('/app-file-manager', [ApplicationController::class, 'fileManagerApp']);
Route::get('/app-contacts', [ApplicationController::class, 'contactApp']);
Route::get('/app-calendar', [ApplicationController::class, 'calendarApp']);
Route::get('/app-invoice-list', [ApplicationController::class, 'invoiceList']);
Route::get('/app-invoice-view', [ApplicationController::class, 'invoiceView']);
Route::get('/app-invoice-edit', [ApplicationController::class, 'invoiceEdit']);
Route::get('/app-invoice-add', [ApplicationController::class, 'invoiceAdd']);
Route::get('/eCommerce-products-page', [ApplicationController::class, 'ecommerceProduct']);
Route::get('/eCommerce-pricing', [ApplicationController::class, 'eCommercePricing']);

// User profile Route
Route::get('/user-profile-page', [UserProfileController::class, 'userProfile']);

// Page Route
Route::get('/page-contact', [PageController::class, 'contactPage']);
Route::get('/page-blog-list', [PageController::class, 'pageBlogList']);
Route::get('/page-search', [PageController::class, 'searchPage']);
Route::get('/page-knowledge', [PageController::class, 'knowledgePage']);
Route::get('/page-knowledge/licensing', [PageController::class, 'knowledgeLicensingPage']);
Route::get('/page-knowledge/licensing/detail', [PageController::class, 'knowledgeLicensingPageDetails']);
Route::get('/page-timeline', [PageController::class, 'timelinePage']);
Route::get('/page-faq', [PageController::class, 'faqPage']);
Route::get('/page-faq-detail', [PageController::class, 'faqDetailsPage']);
Route::get('/page-account-settings', [PageController::class, 'accountSetting']);
Route::get('/page-blank', [PageController::class, 'blankPage']);
Route::get('/page-collapse', [PageController::class, 'collapsePage']);

// Media Route
Route::get('/media-gallery-page', [MediaController::class, 'mediaGallery']);
Route::get('/media-hover-effects', [MediaController::class, 'hoverEffect']);

// User Route
Route::get('/page-users-list', [UserController::class, 'usersList']);
Route::get('/page-users-view', [UserController::class, 'usersView']);
Route::get('/page-users-edit', [UserController::class, 'usersEdit']);

// Misc Route
Route::get('/page-404', [MiscController::class, 'page404']);
Route::get('/page-maintenance', [MiscController::class, 'maintenancePage']);
Route::get('/page-500', [MiscController::class, 'page500']);

// Card Route
Route::get('/cards-basic', [CardController::class, 'cardBasic']);
Route::get('/cards-advance', [CardController::class, 'cardAdvance']);
Route::get('/cards-extended', [CardController::class, 'cardsExtended']);

// Css Route
Route::get('/css-typography', [CssController::class, 'typographyCss']);
Route::get('/css-color', [CssController::class, 'colorCss']);
Route::get('/css-grid', [CssController::class, 'gridCss']);
Route::get('/css-helpers', [CssController::class, 'helpersCss']);
Route::get('/css-media', [CssController::class, 'mediaCss']);
Route::get('/css-pulse', [CssController::class, 'pulseCss']);
Route::get('/css-sass', [CssController::class, 'sassCss']);
Route::get('/css-shadow', [CssController::class, 'shadowCss']);
Route::get('/css-animations', [CssController::class, 'animationCss']);
Route::get('/css-transitions', [CssController::class, 'transitionCss']);

// Basic Ui Route
Route::get('/ui-basic-buttons', [BasicUiController::class, 'basicButtons']);
Route::get('/ui-extended-buttons', [BasicUiController::class, 'extendedButtons']);
Route::get('/ui-icons', [BasicUiController::class, 'iconsUI']);
Route::get('/ui-alerts', [BasicUiController::class, 'alertsUI']);
Route::get('/ui-badges', [BasicUiController::class, 'badgesUI']);
Route::get('/ui-breadcrumbs', [BasicUiController::class, 'breadcrumbsUI']);
Route::get('/ui-chips', [BasicUiController::class, 'chipsUI']);
Route::get('/ui-chips', [BasicUiController::class, 'chipsUI']);
Route::get('/ui-collections', [BasicUiController::class, 'collectionsUI']);
Route::get('/ui-navbar', [BasicUiController::class, 'navbarUI']);
Route::get('/ui-pagination', [BasicUiController::class, 'paginationUI']);
Route::get('/ui-preloader', [BasicUiController::class, 'preloaderUI']);

// Advance UI Route
Route::get('/advance-ui-carousel', [AdvanceUiController::class, 'carouselUI']);
Route::get('/advance-ui-collapsibles', [AdvanceUiController::class, 'collapsibleUI']);
Route::get('/advance-ui-toasts', [AdvanceUiController::class, 'toastUI']);
Route::get('/advance-ui-tooltip', [AdvanceUiController::class, 'tooltipUI']);
Route::get('/advance-ui-dropdown', [AdvanceUiController::class, 'dropdownUI']);
Route::get('/advance-ui-feature-discovery', [AdvanceUiController::class, 'discoveryFeature']);
Route::get('/advance-ui-media', [AdvanceUiController::class, 'mediaUI']);
Route::get('/advance-ui-modals', [AdvanceUiController::class, 'modalUI']);
Route::get('/advance-ui-scrollspy', [AdvanceUiController::class, 'scrollspyUI']);
Route::get('/advance-ui-tabs', [AdvanceUiController::class, 'tabsUI']);
Route::get('/advance-ui-waves', [AdvanceUiController::class, 'wavesUI']);
Route::get('/fullscreen-slider-demo', [AdvanceUiController::class, 'fullscreenSlider']);

// Extra components Route
Route::get('/extra-components-range-slider', [ExtraComponentsController::class, 'rangeSlider']);
Route::get('/extra-components-sweetalert', [ExtraComponentsController::class, 'sweetAlert']);
Route::get('/extra-components-nestable', [ExtraComponentsController::class, 'nestAble']);
Route::get('/extra-components-treeview', [ExtraComponentsController::class, 'treeView']);
Route::get('/extra-components-ratings', [ExtraComponentsController::class, 'ratings']);
Route::get('/extra-components-tour', [ExtraComponentsController::class, 'tour']);
Route::get('/extra-components-i18n', [ExtraComponentsController::class, 'i18n']);
Route::get('/extra-components-highlight', [ExtraComponentsController::class, 'highlight']);

// Basic Tables Route
Route::get('/table-basic', [BasicTableController::class, 'tableBasic']);

// Data Table Route
Route::get('/table-data-table', [DataTableController::class, 'dataTable']);

// Form Route
Route::get('/form-elements', [FormController::class, 'formElement']);
Route::get('/form-select2', [FormController::class, 'formSelect2']);
Route::get('/form-validation', [FormController::class, 'formValidation']);
Route::get('/form-masks', [FormController::class, 'masksForm']);
Route::get('/form-editor', [FormController::class, 'formEditor']);
Route::get('/form-file-uploads', [FormController::class, 'fileUploads']);
Route::get('/form-layouts', [FormController::class, 'formLayouts']);
Route::get('/form-wizard', [FormController::class, 'formWizard']);

// Charts Route
Route::get('/charts-chartjs', [ChartController::class, 'chartJs']);
Route::get('/charts-chartist', [ChartController::class, 'chartist']);
Route::get('/charts-sparklines', [ChartController::class, 'sparklines']);

// locale route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::get('/ejemplo', [EjemploController::class, 'ejemplo']);

/* Rutas Alumos */
Route::group(['middleware' => 'web'], function () {
    Route::get('/alumnos', [App\Http\Controllers\AlumnoController::class, 'index'])->name('alumnos.index');
    Route::get('/alumnos/create', [App\Http\Controllers\AlumnoController::class, 'create'])->name('alumnos.create');
    Route::post('/alumnos', [App\Http\Controllers\AlumnoController::class, 'store'])->name('alumnos.store');
    Route::get('/alumnos/edit/{id}', [App\Http\Controllers\AlumnoController::class, 'edit'])->name('alumnos.edit');
    Route::put('/alumnos/{id}', [App\Http\Controllers\AlumnoController::class, 'update'])->name('alumnos.update');
    Route::get('/alumnos/show/{id}', [App\Http\Controllers\AlumnoController::class, 'show'])->name('alumnos.show');
    Route::delete('/alumnos', [\App\Http\Controllers\AlumnoController::class, 'destroy'])->name('alumnos.destroy');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/ventas/registrar', [\App\Http\Controllers\AlumnoController::class, 'registrar_alumnos'])->name('ventas.registrar_alumnos');
});

/* Rutas Docentes */
Route::group(['middleware' => 'web'], function () {
    Route::get('/docentes', [App\Http\Controllers\DocenteController::class, 'index'])->name('docentes.index');
    Route::get('/docentes/create', [App\Http\Controllers\DocenteController::class, 'create'])->name('docentes.create');
    Route::post('/docentes', [App\Http\Controllers\DocenteController::class, 'store'])->name('docentes.store');
    Route::get('/docentes/edit/{id}', [App\Http\Controllers\DocenteController::class, 'edit'])->name('docentes.edit');
    Route::put('/docentes/{id}', [App\Http\Controllers\DocenteController::class, 'update'])->name('docentes.update');
    Route::get('/docentes/show/{id}', [App\Http\Controllers\DocenteController::class, 'show'])->name('docentes.show');
    Route::delete('/docentes', [\App\Http\Controllers\DocenteController::class, 'destroy'])->name('docentes.destroy');
});

/* Rutas Empresas */
Route::group(['middleware' => 'web'], function () {
    Route::get('/empresas', [App\Http\Controllers\EmpresaController::class, 'index'])->name('empresas.index');
    Route::get('/empresas/create', [App\Http\Controllers\EmpresaController::class, 'create'])->name('empresas.create');
    Route::post('/empresas/store', [App\Http\Controllers\EmpresaController::class, 'store'])->name('empresas.store');
    Route::get('/empresas/edit/{id}', [App\Http\Controllers\EmpresaController::class, 'edit'])->name('empresas.edit');
    Route::put('/empresas/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('empresas.update');
    Route::get('/empresas/show/{id}', [App\Http\Controllers\EmpresaController::class, 'show'])->name('empresas.show');
    Route::delete('/empresas', [\App\Http\Controllers\EmpresaController::class, 'destroy'])->name('empresas.destroy');
});

/* Rutas Sucursales */
Route::group(['middleware' => 'web'], function () {
    Route::get('/sucursales', [App\Http\Controllers\SucursalController::class, 'index'])->name('sucursales.index');
    Route::get('/sucursales/create', [App\Http\Controllers\SucursalController::class, 'create'])->name('sucursales.create');
    Route::post('/sucursales', [App\Http\Controllers\SucursalController::class, 'store'])->name('sucursales.store');
    Route::get('/sucursales/edit/{id}', [App\Http\Controllers\SucursalController::class, 'edit'])->name('sucursales.edit');
    Route::put('/sucursales/{id}', [App\Http\Controllers\SucursalController::class, 'update'])->name('sucursales.update');
    Route::get('/sucursales/show/{id}', [App\Http\Controllers\SucursalController::class, 'show'])->name('sucursales.show');
    Route::delete('/sucursales', [\App\Http\Controllers\SucursalController::class, 'destroy'])->name('sucursales.destroy');
});

/* Rutas Configuracion Impuesto */
Route::group(['middleware' => 'web'], function () {
    Route::get('/configuraciones_impuestos', [App\Http\Controllers\ConfiguracionImpuestoController::class, 'index'])->name('configuraciones_impuestos.index');
    Route::get('/configuraciones_impuestos/create', [App\Http\Controllers\ConfiguracionImpuestoController::class, 'create'])->name('configuraciones_impuestos.create');
    Route::post('/configuraciones_impuestos', [App\Http\Controllers\ConfiguracionImpuestoController::class, 'store'])->name('configuraciones_impuestos.store');
    Route::get('/configuraciones_impuestos/edit/{id}', [App\Http\Controllers\ConfiguracionImpuestoController::class, 'edit'])->name('configuraciones_impuestos.edit');
    Route::put('/configuraciones_impuestos/{id}', [App\Http\Controllers\ConfiguracionImpuestoController::class, 'update'])->name('configuraciones_impuestos.update');
    Route::get('/configuraciones_impuestos/show/{id}', [App\Http\Controllers\ConfiguracionImpuestoController::class, 'show'])->name('configuraciones_impuestos.show');
    Route::delete('/configuraciones_impuestos', [\App\Http\Controllers\ConfiguracionImpuestoController::class, 'destroy'])->name('configuraciones_impuestos.destroy');
});

//sincronizacion de catalogos
Route::get('/catalogos/index', [CatalogosController::class, 'index2'])->name('catalogos.index2');
Route::get('/catalogos/{sincronizacion}', [CatalogosController::class, 'index'])->name('catalogos.index');
Route::get('/catalogos/sincronizarCatalogos/{accion}', [CatalogosController::class, 'sincronizarCatalogos'])->name('sincronizar');

Route::group([
    'middleware' => 'web',
    'prefix' => 'users',
    'controller' => UserController::class,
], function () {
    Route::get('index', 'index')->name('users.index');
    Route::get('asignarEmpresaUser/{id}', 'asignarEmpresaUser')->name('users.asignarEmpresaUser');
    Route::post('user/show', 'show')->name('users.show');
    Route::post('user/update', 'update')->name('users.update');
    Route::post('saveAsignarEmpresaUser', 'saveAsignarEmpresaUser')->name('users.saveAsignarEmpresaUser');
    Route::post('save/user', 'store')->name('users.store');
    Route::delete('user/delete', 'deleteUser')->name('users.deleteUser');
});

Route::group([
    'prefix' => 'proveedor',
    'controller' => ProveedorController::class,
], function () {
    Route::get('index', 'index')->name('proveedor.index');
    Route::get('create', 'create')->name('proveedor.create');
    Route::get('/edit/{id}', 'edit')->name('proveedor.edit');
    Route::post('store', 'store')->name('proveedor.store');
    Route::post('update', 'update')->name('proveedor.update');
    Route::delete('destroy', 'destroy')->name('proveedor.destroy');
});

Route::group([
    'prefix' => 'puntos_ventas',
    'controller' => PuntoVentaController::class,
], function () {
    Route::get('index', 'index')->name('puntos_ventas.index');
    Route::get('create', 'create')->name('puntos_ventas.create');
    Route::post('store', 'store')->name('puntos_ventas.store');
});
Route::group([
    'prefix' => 'familia',
    'controller' => FamiliaController::class,
], function () {
    Route::get('index', 'index')->name('familia.index');
    Route::get('create', 'create')->name('familia.create');
    Route::get('/edit/{id}', 'edit')->name('familia.edit');
    Route::post('udpate', 'update')->name('familia.update');
    Route::post('store', 'store')->name('familia.store');
    Route::delete('destroy', 'destroy')->name('familia.destroy');
});

Route::group([
    'prefix' => 'categoria',
    'controller' => CategoriaController::class,
], function () {
    Route::get('index', 'index')->name('categoria.index');
    Route::get('create', 'create')->name('categoria.create');
    Route::get('/edit/{id}', 'edit')->name('categoria.edit');
    Route::post('udpate', 'update')->name('categoria.update');
    Route::post('store', 'store')->name('categoria.store');
    Route::delete('destroy', 'destroy')->name('categoria.destroy');
});

Route::group([
                 'prefix' => 'ventas',
                 'controller' => VentasController::class,
             ], function () {
    Route::get('index', 'index')->name('ventas.index');
    Route::get('create', 'create')->name('categoria.create');
    Route::get('/edit/{id}', 'edit')->name('categoria.edit');
    Route::post('store', 'store')->name('categoria.store');
    Route::delete('destroy', 'destroy')->name('categoria.destroy');

    Route::post('getDataCliente', 'getDataCliente')->name('ventas.getDataCliente');
});

Route::group([
    'prefix' => 'sub_familia',
    'controller' => SubFamiliaController::class,
], function () {
    Route::get('index', 'index')->name('sub_familia.index');
    Route::get('create', 'create')->name('sub_familia.create');
    Route::post('udpate', 'update')->name('sub_familia.update');
    Route::get('/edit/{id}', 'edit')->name('sub_familia.edit');
    Route::post('store', 'store')->name('sub_familia.store');
    Route::delete('destroy', 'destroy')->name('sub_familia.destroy');
});

Route::group([
    'prefix' => 'marca',
    'controller' => MarcaController::class,
], function () {
    Route::get('index', 'index')->name('marca.index');
    Route::get('create', 'create')->name('marca.create');
    Route::put('update/{id}', 'update')->name('marca.update');
    Route::get('/edit/{id}', 'edit')->name('marca.edit');
    Route::post('store', 'store')->name('marca.store');
    Route::delete('destroy', 'destroy')->name('marca.destroy');
});

Route::group([
    'prefix' => 'cliente',
    'controller' => ClienteController::class,
], function () {
    Route::get('index', 'index')->name('cliente.index');
    Route::get('create', 'create')->name('cliente.create');
    Route::get('/edit/{id}', 'edit')->name('cliente.edit');
    Route::post('store', 'store')->name('cliente.store');
    Route::post('update', 'update')->name('cliente.update');
    Route::delete('destroy', 'destroy')->name('cliente.destroy');
});

Route::group(
    [
        'prefix' => 'pedidos',
        'controller' => PedidoController::class,
    ],
    function () {
        Route::get('index', 'index')->name('pedido.index');
        Route::get('create', 'create')->name('pedido.create');
        Route::get('/edit/{id}', 'edit')->name('pedido.edit');
        Route::post('store', 'store')->name('pedido.store');
        Route::delete('destroy', 'destroy')->name('pedido.destroy');
    }
);

Route::group(
    [
        'prefix' => 'producto',
        'controller' => ProductoController::class,
    ],
    function () {
        Route::get('index', 'index')->name('producto.index');
        Route::post('producto/get/name', 'getProductoNombre')->name('producto.get.name');
        Route::post('producto/destroyProducto', 'destroyProducto')->name('producto.destroyProducto');
        Route::get('create', 'create')->name('producto.create');
        Route::get('/edit/{id}', 'edit')->name('producto.edit');
        Route::post('/get_actividad/documento_sector', 'getActividadProducto')->name('actividad.getActividad');
        Route::post('store', 'store')->name('producto.store');
        Route::post('update', 'update')->name('producto.update');
        Route::delete('destroy', 'destroy')->name('producto.destroy');
        Route::post('getDataProductoServicio', 'getDataProductoServicio')->name('producto.getDataProductoServicio');
        Route::post('/update/product/cart', 'updateProductCart')->name('update.product.cart');
        Route::post('/ver_cart', 'getAllCart')->name('get.all.cart');

        Route::get('/ver_carrito', function () {

            return responseJson('LaraCart', LaraCart::getItems(), 200);
        })->name('ver.carrito');
        Route::get('/vaciar_cart', function () {
            dd(LaraCart::emptyCart());
        });
    }
);

Route::group([
    'prefix' => 'dosificaciones_empresas',
    'controller' => DosificacionEmpresaController::class,
], function () {
    Route::get('index', 'index')->name('dosificaciones_empresas.index');
    Route::get('create', 'create')->name('dosificaciones_empresas.create');
    Route::post('store', 'store')->name('dosificaciones_empresas.store');
    Route::get('edit/{id}', 'edit')->name('dosificaciones_empresas.edit');
    Route::post('eliminarDetalle', 'eliminarDetalle')->name('dosificaciones_empresas.eliminarDetalle');
    Route::post('getDataDocumentoSector', 'getDataDocumentoSector')->name('dosificaciones_empresas.getDataDocumentoSector');
});

Route::group([
    'prefix' => 'almacenes',
    'controller' =>  AlmacenController::class,
], function () {
    Route::get('index', 'index')->name('almacenes.index');
    Route::get('create', 'create')->name('almacenes.create');
    Route::get('/edit/{id}', 'edit')->name('almacenes.edit');
    Route::post('store', 'store')->name('almacenes.store');
    Route::delete('destroy', 'destroy')->name('almacenes.destroy');
});
Route::group([
    'prefix' => 'compras',
    'controller' => ComprasController::class
], function () {
    Route::get('/aprobar/pedido/index/{pedido}', 'compras_index')->name('compras.aprobar_index');
    Route::post('/aprobar/pedido', 'aprobar_pedido')->name('compras.aprobar_pedido');
});

Route::group([
    'prefix' => 'catalogos_productos',
    'controller' => CatalogoPrecioProductoController::class
], function () {
    Route::get('index', 'index')->name('catalogos_productos.index');
    Route::get('create', 'create')->name('catalogos_productos.create');
    Route::get('tipo_precio_index', 'tipo_precio_index')->name('catalogos_productos.tipo_precio_index');
    Route::get('tipo_precio_edit/{cliente}', 'tipo_precio_edit')->name('catalogos_productos.tipo_precio_edit');
    Route::post('tipo_precio_store/edit', 'tipo_precio_store')->name('catalogos_productos.tipo_precio_store');
    Route::post('cliente_tipo_precio/update', 'updateClientePrecio')->name('catalogos_productos.cliente_tipo_precio');
    Route::get('/edit/{id}', 'edit')->name('catalogos_productos.edit');
    Route::post('store', 'store')->name('catalogos_productos.store');
    Route::delete('destroy', 'destroy')->name('catalogos_productos.destroy');
});
