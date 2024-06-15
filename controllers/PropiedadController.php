<?php
    namespace Controllers;
    
    use MVC\Router;
    use Model\Propiedad;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;


    class PropiedadController
    {
        public static function index(Router $router){
            

            $paginacion = Propiedad::paginate(8, 'DESC');
            $propiedades = $paginacion->resultados;
            $links = $paginacion->links('/admin/propiedades');


            $vendedores = Vendedor::all();
            $resultado = $_GET['resultado'] ?? null;

            $router->render('propiedades/index', [
                'propiedades' => $propiedades,
                'resultado' => $resultado,
                'vendedores' => $vendedores,
                'links' => $links
            ], 'admin');
        }

        public static function crear(Router $router){
            
            $propiedad = new Propiedad;
            $vendedores = Vendedor::all();
            $errores = Propiedad::getErrores(); 

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $propiedad = new Propiedad($_POST['propiedad']);

                // Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

                // Realiza un resize a la imagen con Intervention Image
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                    $propiedad->setImagen($nombreImagen);
                }
                $errores = $propiedad->validar();
                if (empty($errores)) {        
                    // Crear Carpeta
                    if (!is_dir(CARPETA_IMAGENES_PROPIEDADES)) {mkdir(CARPETA_IMAGENES_PROPIEDADES);}
                    $image->save(CARPETA_IMAGENES_PROPIEDADES. $nombreImagen);
                    
                    $propiedad->guardar();
                }
            }

            $router->render('propiedades/crear',[
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
        }

        public static function actualizar(Router $router){
            
            $id = validarORedireccionar('/admin');
            $propiedad = Propiedad::find($id);
            $errores = Propiedad::getErrores();
            $vendedores = Vendedor::all();


            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Asignar los valores
                $args = $_POST['propiedad'];
                $propiedad->sincronizar($args);

                $errores = $propiedad->validar();
                
                $imagen = $_FILES['imagen'];
                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                    $propiedad->setImagen($nombreImagen);
                }

                if (empty($errores)) {        
                    if ($_FILES['propiedad']['tmp_name']['imagen']) {
                        $image->save(CARPETA_IMAGENES_PROPIEDADES . $nombreImagen);
                    }

                    $propiedad->guardar();
                }
            }

            $router->render('propiedades/actualizar',[
                'propiedad' => $propiedad,
                'errores' => $errores,
                'vendedores' => $vendedores
            ]);
        }

        public static function eliminar(){
            if($_SERVER['REQUEST_METHOD'] === 'POST') {

                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
                
                if ($id) {
                    $tipo = $_POST['tipo'];
                    if (validarTipoContenido($tipo)) {
                        $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                    }
                }
            }
        }

    }