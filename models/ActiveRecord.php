<?php
    namespace Model;

    class ActiveRecord
    {
        
        // DB
        protected static $db;
        protected static $columnasDB = [];
        protected static $tabla = '';

        // Errores
        protected static $errores = [];

        // URL Imagenes
        protected static $carpetaImagenes = '';

        public static function setDB($database) {
            self::$db = $database;  
        }

        public function guardar() {
            if(!is_null($this->id)) {
                // Actualizar
                $this->actualizar();
            }else{
                // Crear
                $this->crear();
            }
        }

        public function crear() {

            // Sanitizar los datos
            $atributos = $this->sanitizarAtributos();
            
            // Insertar en la base de datos
            $query = "INSERT INTO " . static::$tabla . " (";
            $query .= join(', ', array_keys($atributos));
            $query .= ") VALUES ('";
            $query .= join("', '", array_values($atributos));
            $query .= "')";
         
            $resultado = self::$db->query($query);

            if ($resultado) {
                // Redireccionar al usuario
                header("Location: /admin?resultado=1");
            }
        }
        public function actualizar() {
            $atributos = $this->sanitizarAtributos();

            $valores = [];
            foreach($atributos as $key => $value) {
                $valores[] = "{$key} = '{$value}'";
            }

            $query = "UPDATE " . static::$tabla . " SET ";
            $query .= join(', ', $valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1"; 

            $resultado = self::$db->query($query);

            if ($resultado) {
                // Redireccionar al usuario
                header("Location: /admin?resultado=2");
            }
        }
        public function eliminar() {
            $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
            $resultado = self::$db->query($query);

            if ($resultado) {
                $this->borrarImagen();
                header("Location: /admin?resultado=3");
            }
        }
        
        public function atributos() {
            $atributos = [];
            foreach(static::$columnasDB as $columna) {
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }

        public function sanitizarAtributos() {
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value) {
                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }

        public function setImagen($imagen) {
            // Elimina el nombre del archivo previo
            if(!is_null($this->id)){
                $this->borrarImagen();
            }
            if($imagen){
                $this->imagen = $imagen;
            }
        }
        public function borrarImagen() {
            $existeArchivo = file_exists(static::$carpetaImagenes . $this->imagen);
            if($existeArchivo) unlink(static::$carpetaImagenes . $this->imagen);
        }
        public static function getErrores() {
            return static::$errores;
        }

        public function validar() {

            static::$errores = [];
            return static::$errores;
        }

        // Lista todas los registros
        public static function all($orden = 'ASC'){
            $query = "SELECT * FROM " . static::$tabla . " ORDER BY id " . $orden;
            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        // Obtiene determinado número de registros
        public static function get($limite, $orden = 'ASC') {
            $query = "SELECT * FROM " . static::$tabla . " ORDER BY id " . $orden . " LIMIT " . $limite;
            $resultado = self::consultarSQL($query);
            
            return $resultado;
        }

        // Busca un regustro por su id
        public static function find($id){
            $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
            $resultado = self::consultarSQL($query);
            return array_shift($resultado);
        }

        public static function consultarSQL($query) {
            // Consultar la base de datos
            $resultado = self::$db->query($query);

            // Iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }

            // Liberar la memoria
            $resultado->free();

            // Retornar los resultados
            return $array;
        }

        protected static function crearObjeto($registro) {
            $objeto = new static;
            foreach($registro as $key => $value) {
                if(property_exists($objeto, $key)) {
                    $objeto->$key = $value;
                }
            }
            return $objeto;
        }
    
        // Sincroniza el objeto en memoria con los cambios en la base de datos
        public function sincronizar($args=[]) {
            foreach($args as $key => $value) {
                if(property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                }
            }
        }
    }