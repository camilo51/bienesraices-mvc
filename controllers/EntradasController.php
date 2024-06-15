<?php
    namespace Controllers;
    use MVC\Router;
    use Model\Entrada;
    use Intervention\Image\ImageManagerStatic as Image;


    class EntradasController 
    {

        public static function index(Router $router){
            $paginacion = Entrada::paginate(8,'DESC');
            $entradas = $paginacion->resultados;
            $links = $paginacion->links('/admin/entradas');
            $router->render('entradas/index', [
                'entradas' => $entradas,
                'links' => $links
            ], 'admin');
        }
        public static function crear(Router $router){

            $errores = Entrada::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $entrada = new Entrada($_POST['entrada']);

                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
                if ($_FILES['entrada']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800, 600);
                    $entrada->setImagen($nombreImagen);
                }

                $errores = $entrada->validar();
                if (empty($errores)) {
                    if (!is_dir(CARPETA_IMAGENES_ENTRADAS)) {
                        mkdir(CARPETA_IMAGENES_ENTRADAS);
                    }
                    $image->save(CARPETA_IMAGENES_ENTRADAS . $nombreImagen);

                    $entrada->guardar();
                }
            }

            $router->render('entradas/crear', [
                'entrada' => $entrada,
                'errores' => $errores
            ]);
        }

        public static function actualizar(Router $router){
            $id = validarORedireccionar('/admin/entradas');
            $entrada = Entrada::find($id);
            $errores = Entrada::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $args = $_POST['entrada'];
                $entrada->sincronizar($args);

                $errores = $entrada->validar();

                $imagen = $_FILES['imagen'];
                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
                if ($_FILES['entrada']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800, 600);
                $entrada->setImagen($nombreImagen);
                }

                if (empty($errores)) {
                    if ($_FILES['entrada']['tmp_name']['imagen']) {
                        $image->save(CARPETA_IMAGENES_ENTRADAS . $nombreImagen);
                    }

                $entrada->guardar();
                }
            }

            $router->render('entradas/actualizar', [
                'entrada' => $entrada,
                'errores' => $errores
            ]);
        }
    }
