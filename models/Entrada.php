<?php

    namespace Model; 


    class Entrada extends ActiveRecord{
        protected static $columnasDB = ['id', 'titulo', 'informacion', 'imagen', 'fecha'];
        protected static $tabla = 'entradas';
        
        protected static $carpetaImagenes = CARPETA_IMAGENES_ENTRADAS;


        public $id;
        public $titulo;
        public $informacion;
        public $imagen;
        public $fecha;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->titulo = $args['titulo'] ?? '';
            $this->informacion = $args['informacion'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->fecha = date('Y/m/d');
        }
            
        public function validar(){
            if(!$this->titulo){
                self::$errores[] = "El titulo es obligatorio";
            }
            if (!$this->informacion) {
                self::$errores[] = "La informacion es obligatoria";
            }
            if (!$this->imagen) {
                self::$errores[] = "La imagen es obligatoria";
            }
            return self::$errores;
        }

    }