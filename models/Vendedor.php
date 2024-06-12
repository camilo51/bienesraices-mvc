<?php
    namespace Model;

    class Vendedor extends ActiveRecord
    {
        protected static $columnasDB = ['id', 'nombre','apellido', 'imagen', 'telefono'];
        protected static $tabla = 'vendedores';

        protected static $carpetaImagenes = CARPETA_IMAGENES_VENDEDORES;

        public $id;
        public $nombre;
        public $apellido;
        public $imagen;
        public $telefono;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->telefono = $args['telefono'] ?? '';

        }

        public function validar() {
            
            if (!$this->nombre) {
                self::$errores[] = "El nombre es obligatorio";
            }
            if (!$this->apellido) {
                self::$errores[] = "El apellido es obligatorio";
            }
            if (!$this->imagen) {
                self::$errores[] = "La imagen es obligatoria";
            }
            if (!$this->telefono) {
                self::$errores[] = "El telefono es obligatorio";
            }
            if (!preg_match('/[0-9]{10}/', $this->telefono)) {
                self::$errores[] = "Formato de teléfono no válido";
            }

            return self::$errores;
        }
    }