<?php
    namespace Controllers;

    use MVC\Router;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    class VendedoresController
    {
        public static function index(Router $router)
        {
            $paginacion = Vendedor::paginate(8, 'DESC');
            $vendedores = $paginacion->resultados;
            $links = $paginacion->links('/admin/vendedores');
            $router->render('vendedores/index', [
                'vendedores' => $vendedores,
                'links' => $links
            ], 'admin');
        }

        public static function crear(Router $router)
        {
            $errores = Vendedor::getErrores();  
            
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $vendedor = new Vendedor($_POST['vendedor']);

                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
                if ($_FILES['vendedor']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                    $vendedor->setImagen($nombreImagen);
                }

                $errores = $vendedor->validar();
                if(empty($errores)) {
                    if (!is_dir(CARPETA_IMAGENES_VENDEDORES)) {mkdir(CARPETA_IMAGENES_VENDEDORES);}
                    $image->save(CARPETA_IMAGENES_VENDEDORES. $nombreImagen);

                    $vendedor->guardar();
                }
            }
            
            $router->render('vendedores/crear', [
                'vendedor' => $vendedor,
                'errores' => $errores
            ]);
        }

        public static function actualizar(Router $router)
        {
            $id = validarORedireccionar('/admin');
            $vendedor = Vendedor::find($id);
            $errores = Vendedor::getErrores();  

            if($_SERVER['REQUEST_METHOD'] === 'POST') {     
                $args = $_POST['vendedor'];
                $vendedor->sincronizar($args);

                $errores = $vendedor->validar();
                
                $imagen = $_FILES['imagen'];
                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
                if ($_FILES['vendedor']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                    $vendedor->setImagen($nombreImagen);
                }
                if(empty($errores)) {
                    if ($_FILES['vendedor']['tmp_name']['imagen']) {
                        $image->save(CARPETA_IMAGENES_VENDEDORES . $nombreImagen);
                    }
                    $vendedor->guardar();
                }
            }

            $router->render('vendedores/actualizar', [
                'vendedor' => $vendedor,
                'errores' => $errores
            ]);
        }

        public static function eliminar(){
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
                
                if ($id) {
                    $tipo = $_POST['tipo'];
                    if (validarTipoContenido($tipo)) {
                        $propiedad = Vendedor::find($id);
                        $propiedad->eliminar();
                    }
                }
            }
        }
    }