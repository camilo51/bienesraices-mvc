<?php
    namespace Model;
    class Paginador
    {
        public $resultados;
        protected $totalRegistros;
        protected $porPagina;
        protected $paginaActual;

        public function __construct($resultados, $totalRegistros, $porPagina, $paginaActual)
        {
        $this->resultados = $resultados;
        $this->totalRegistros = $totalRegistros;
        $this->porPagina = $porPagina;
        $this->paginaActual = $paginaActual;
        }

    public function links($rutaBase)
    {
        $html = '';

        // Mostrar enlaces solo si hay más de una página
        if ($this->totalRegistros > $this->porPagina) {
            $html .= '<div class="paginacion">';
            $html .= '<p class="paginacion__actual">Mostrando ' . (($this->paginaActual - 1) * $this->porPagina + 1) . ' a ' . min($this->paginaActual * $this->porPagina, $this->totalRegistros) . ' de ' . $this->totalRegistros . ' Resultados</p>';
            $html .= '<nav class="paginacion__enlaces">';

            // Enlace a la página anterior
            if ($this->paginaActual > 1) {
                $html .= '<a href="' . $rutaBase . '?pagina=' . ($this->paginaActual - 1) . '"><i class="fa-solid fa-chevron-left"></i></a>';
            } else {
                $html .= '<a class="disabled"><i class="fa-solid fa-chevron-left"></i></a>';
            }

            // Enlaces de páginas
            $numPaginas = ceil($this->totalRegistros / $this->porPagina);

            if ($numPaginas <= 5) {
                // Mostrar todos los enlaces si hay 5 páginas o menos
                for ($i = 1; $i <= $numPaginas; $i++) {
                    if ($i == $this->paginaActual) {
                        $html .= '<a class="active" href="' . $rutaBase . '?pagina=' . $i . '">' . $i . '</a>';
                    } else {
                        $html .= '<a href="' . $rutaBase . '?pagina=' . $i . '">' . $i . '</a>';
                    }
                }
            } else {
                // Mostrar enlaces con puntos suspensivos y números específicos
                $html .= '<a href="' . $rutaBase . '?pagina=1">1</a>';

                if ($this->paginaActual > 3) {
                    $html .= '<p>...</p>';
                }

                // Mostrar números cercanos a la página actual
                $inicio = max(2, $this->paginaActual - 1);
                $fin = min($numPaginas - 1, $this->paginaActual + 1);

                for ($i = $inicio; $i <= $fin; $i++) {
                    if ($i == $this->paginaActual) {
                        $html .= '<a class="active" href="' . $rutaBase . '?pagina=' . $i . '">' . $i . '</a>';
                    } else {
                        $html .= '<a href="' . $rutaBase . '?pagina=' . $i . '">' . $i . '</a>';
                    }
                }

                if ($this->paginaActual < $numPaginas - 2) {
                    $html .= '<p>...</p>';
                }

                $html .= '<a href="' . $rutaBase . '?pagina=' . $numPaginas . '">' . $numPaginas . '</a>';
            }

            // Enlace a la página siguiente
            if ($this->paginaActual < $numPaginas) {
                $html .= '<a href="' . $rutaBase . '?pagina=' . ($this->paginaActual + 1) . '"><i class="fa-solid fa-chevron-right"></i></a>';
            } else {
                $html .= '<a class="disabled"><i class="fa-solid fa-chevron-right"></i></a>';
            }

            $html .= '</nav>';
            $html .= '</div>';
        }

        return $html;
    }
    }