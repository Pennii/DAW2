const noticia = document.getElementById("noticia");
let valorNoticia = new URLSearchParams(window.location.search).get("noticia")
switch (valorNoticia) {
    case "1":
        noticia.src = 'https://www.ambito.com/mexico/informacion-general/las-croquetas-gato-no-tan-populares-que-tienen-una-excelente-calidad-y-la-profeco-recomienda-n6103868'
        break;
    case "2":
        noticia.src = 'https://www.elperiodico.com/es/vida-y-estilo/20250120/10-actividades-gatos-adoran-mascotas-dv-113523081'
        break;
    case "3":
        noticia.src = 'https://www.infobae.com/mascotas/2025/01/18/la-memoria-y-comprension-del-lenguaje-en-los-gatos-revela-su-nivel-de-inteligencia/'
        break;

    default:
        window.location = "inicio.html"
        break;
}

const menuLateral = document.getElementById("menuLateral")

menuLateral.innerHTML += '<ul id="miga"><li><a href="inicio.html">Inicio</a> -> Noticias</li></ul>'