<?php


    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use PHPMailer\PHPMailer\PHPMailer;

    class PaginasController
    {
        public static function index(Router $router)
        {
            $propiedades = Propiedad::get(3, "DESC");
            $inicio = true;

            $router->render('paginas/index', [
                'propiedades' => $propiedades,
                'inicio' => $inicio
            ]);
        }
        public static function nosotros(Router $router)
        {
            $router->render('paginas/nosotros');
        }
        public static function propiedades(Router $router)
        {
            $propiedades = Propiedad::all();

            $router->render('paginas/propiedades', [
                'propiedades' => $propiedades
            ]);
        }
        public static function propiedad(Router $router)
        {
            $id = validarORedireccionar('/propiedades');
            $propiedad = Propiedad::find($id);

            $router->render('paginas/propiedad', [
                'propiedad' => $propiedad
            ]);
        }
        public static function blog(Router $router)
        {
            $router->render('paginas/blog');
        }
        public static function entrada(Router $router)
        {
            $router->render('paginas/entrada');
        }
        public static function contacto(Router $router)
        {
            $mensaje = null;

            if($_SERVER['REQUEST_METHOD'] === 'POST') {

                $mail = new PHPMailer();

                $mail->isSMTP();
                $mail->Host = $_ENV['EMAIL_HOST'];
                $mail->SMTPAuth = true;
                $mail->Port = $_ENV['EMAIL_PORT'];
                $mail->Username = $_ENV['EMAIL_USER'];
                $mail->Password = $_ENV['EMAIL_PASS'];
                $mail->SMTPSecure = 'tls';

                $mail->setFrom('admin@bienesraices.com');
                $mail->addAddress('admin@bienesraices.com', "BienesRaices.com");
                $mail->Subject = 'Tienes un nuevo mensaje';

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';

                $contenido = '<html>';
                $contenido .= '<p>Tienes un nuevo mensaje</p>';
                $contenido .= '<p><strong>Nombre</strong>: ' . $_POST['contacto']['nombre'] . '</p>';


                // Enviar de forma condicional los datos
                if($_POST['contacto']['contacto'] === 'telefono') {
                    $contenido .= '<p>Eligió ser contactado por teléfono</p>';
                    $contenido .= '<p><strong>Teléfono</strong>: ' . $_POST['contacto']['telefono'] . '</p>';
                    $contenido .= '<p><strong>Fecha Contacto</strong> : ' . $_POST['contacto']['fecha'] . '</p>';
                    $contenido .= '<p><strong>Hora</strong> : ' . $_POST['contacto']['hora'] . '</p>';

                }else{
                    $contenido .= '<p>Eligió ser contactado por email</p>';
                    $contenido .= '<p><strong>Email</strong>: ' . $_POST['contacto']['email'] . '</p>';
                }

                $contenido .= '<p><strong>Mensaje</strong>: ' . $_POST['contacto']['mensaje'] . '</p>';
                $contenido .= '<p><strong>Vende o Compra</strong> : ' . $_POST['contacto']['tipo'] . '</p>';
                $contenido .= '<p><strong>Precio o Presupuesto</strong> : $' . $_POST['contacto']['precio'] . '</p>';
                $contenido .= '</html>';

                $mail->Body = $contenido;
                if($mail->send()) {
                    $mensaje =  "Mensaje enviado correctamente";
                }else{
                    $mensaje =  "El mensaje no se pudo enviar";
                }
                // $mail->send();
            }

            $router->render('paginas/contacto',[
                'mensaje' => $mensaje
            ]);
        }
    }