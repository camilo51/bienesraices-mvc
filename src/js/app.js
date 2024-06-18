document.addEventListener("DOMContentLoaded", function () {
    eventListeners();
    darkMode();
    widthHeader();
    heightHeader();
});

// Dark Mode
const darkMode = () => {
    const prefiereDarkMode = window.matchMedia("(prefers-color-scheme:dark)");
    const botonDarkMode = document.querySelector(".dark-mode-boton");

    // Verificar si hay un valor guardado en el sessionStorage
    const darkModeValue = sessionStorage.getItem("darkMode");
    if (darkModeValue === "true") {
        document.body.classList.add("dark-mode");
    } else if (darkModeValue === "false") {
        document.body.classList.remove("dark-mode");
    } else if (prefiereDarkMode.matches) {
        document.body.classList.add("dark-mode");
    }

    // Agregar el evento de clic al botón de modo oscuro
    botonDarkMode.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
        // Guardar el nuevo valor en el sessionStorage
        sessionStorage.setItem("darkMode", document.body.classList.contains("dark-mode").toString());
    });

    // Agregar el evento de cambio al matchMedia
    prefiereDarkMode.addEventListener("change", () => {
        if (prefiereDarkMode.matches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        }
    });
};

// Menu Responsive
const eventListeners = () => {
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileMenu.addEventListener("click", navegacionResponsive);

    //  Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach((input) => input.addEventListener("click", mostrarMetodosContacto));
};
const navegacionResponsive = () => {
    const navegacion = document.querySelector(".derecha-contenido");
    navegacion.classList.toggle("mostrar");
};
const widthHeader = () => {
    const header = document.querySelector(".header");
    const titulo = document.querySelector(".header .contenido-header h1");
    const barraResponsive = document.querySelector(".header .contenido-header .barra-responsive");
    if (innerWidth < 768 && header.children[0].classList.contains("contenedor")) {
        header.children[0].classList.remove("contenedor");
        if (titulo) {
            titulo.classList.add('contenedor');
        }

        barraResponsive.classList.add("contenedor");
    }else{
        header.children[0].classList.add("contenedor");
        if (titulo) {
            titulo.classList.remove("contenedor");
        }
        barraResponsive.classList.remove("contenedor");
    }
};

const heightHeader = () => {
        const mobileMenu = document.querySelector(".mobile-menu");
        const navContent = document.querySelector(".derecha-contenido");

        mobileMenu.addEventListener("click", () => {
            if (navContent.style.height === "0px" || navContent.style.height === "") {
                navContent.style.visibility = "visible";
                navContent.style.opacity = "1";
                navContent.style.height = navContent.scrollHeight + "px";
            } else {
                navContent.style.visibility = "hidden";
                navContent.style.opacity = "0";
                navContent.style.height = "0px";
            }
        });
}

const mostrarMetodosContacto = (e) => {
    const contactoDiv = document.querySelector("#contacto");

    if(e.target.value === "telefono"){
        contactoDiv.innerHTML = `
            <label for="telefono">Numero de Telefono</label>
            <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]" />
            
            <p>Elija la fecha y la hora para la llamada</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]" />

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" />
        `;
     
    }else{
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required />
        `;
    }

};