<?php
    namespace Model;

    class Propiedad extends ActiveRecord 
    {
        protected static $columnasDB = [ 'id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
        protected static $tabla = 'propiedades';

        protected static $carpetaImagenes = CARPETA_IMAGENES_PROPIEDADES;

        public $id;
        public $titulo;
        public $precio;
        public $imagen;
        public $descripcion;
        public $habitaciones;
        public $wc;
        public $estacionamiento;
        public $creado;
        public $vendedorId;
    
        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->titulo = $args['titulo'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->habitaciones = $args['habitaciones'] ?? '';
            $this->wc = $args['wc'] ?? '';
            $this->estacionamiento = $args['estacionamiento'] ?? '';
            $this->creado = date('Y/m/d');
            $this->vendedorId = $args['vendedorId'] ?? '';
        }

        public function validar() {
            
            if (!$this->titulo) {
                self::$errores[] = "Debes añadir un título";
            }
            if (!$this->precio) {
                self::$errores[] = "El precio es obligatorio";
            }
            if (strlen($this->descripcion) < 50) {
                self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
            }
            if (!$this->habitaciones) {
                self::$errores[] = "Elige el numero de habitaciones";
            }
            if (!$this->wc) {
                self::$errores[] = "Elige el numero de baños";
            }
            if (!$this->estacionamiento) {
                self::$errores[] = "Elige el numero de estacionamiento";
            }
            if (!$this->vendedorId) {
                self::$errores[] = "Elige un vendedor";
            }
            if (!$this->imagen) {
                self::$errores[] = "La imagen es obligatoria";
            }
            return self::$errores;

        }
    
    }

