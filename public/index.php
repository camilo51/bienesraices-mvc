<?php

    require_once __DIR__ . '/../includes/app.php';

    use MVC\Router;
    use Controllers\AdminController;
    use Controllers\PropiedadController;
    use Controllers\VendedoresController;
    use Controllers\PaginasController;
    use Controllers\LoginController;
    use Controllers\EntradasController;

    $router = new Router();

    // Zona Privada
    $router->get('/admin', [AdminController::class, 'index']);

    $router->get('/admin/propiedades', [PropiedadController::class, 'index']);
    $router->get('/admin/propiedades/crear', [PropiedadController::class, 'crear']);
    $router->post('/admin/propiedades/crear', [PropiedadController::class, 'crear']);
    $router->get('/admin/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
    $router->post('/admin/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
    $router->post('/admin/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

    $router->get('/admin/vendedores', [VendedoresController::class, 'index']);
    $router->get('/admin/vendedores/crear', [VendedoresController::class, 'crear']);
    $router->post('/admin/vendedores/crear', [VendedoresController::class, 'crear']);
    $router->get('/admin/vendedores/actualizar', [VendedoresController::class, 'actualizar']);
    $router->post('/admin/vendedores/actualizar', [VendedoresController::class, 'actualizar']);
    $router->post('/admin/vendedores/eliminar', [VendedoresController::class, 'eliminar']);

    $router->get('/admin/entradas', [EntradasController::class, 'index']);
    $router->get('/admin/entradas/crear', [EntradasController::class, 'crear']);
    $router->post('/admin/entradas/crear', [EntradasController::class, 'crear']);
    $router->get('/admin/entradas/actualizar', [EntradasController::class, 'actualizar']);
    $router->post('/admin/entradas/actualizar', [EntradasController::class, 'actualizar']);
    $router->post('/admin/entradas/eliminar', [EntradasController::class, 'eliminar']);

    // Zona Publica
    $router->get('/', [PaginasController::class, 'index']);
    $router->get('/nosotros', [PaginasController::class, 'nosotros']);
    $router->get('/propiedades', [PaginasController::class, 'propiedades']);
    $router->get('/propiedad', [PaginasController::class, 'propiedad']);
    $router->get('/blog', [PaginasController::class, 'blog']);
    $router->get('/entrada', [PaginasController::class, 'entrada']);
    $router->get('/contacto', [PaginasController::class, 'contacto']);
    $router->post('/contacto', [PaginasController::class, 'contacto']);

    // Login Y Autenticacion
    $router->get('/login', [LoginController::class, 'login']);
    $router->post('/login', [LoginController::class, 'login']);
    $router->get('/logout', [LoginController::class, 'logout']);

    $router->comprobarRutas();