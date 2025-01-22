const noticia = document.getElementById("noticia");
let valorNoticia = new URLSearchParams(window.location.search).get("noticia")
switch (valorNoticia) {
    case 1:
        noticia.src = 'https://www.msn.com/es-es/mascotas-y-animales/mascotas/soy-veterinaria-y-estos-alimentos-naturales-pueden-ayudar-a-tu-perro-o-gato-con-sus-problemas-digestivos/ar-AA1xrMoA?ocid=BingNewsVerp'
        break;
    case 2:
        noticia.src = 'https://www.elperiodico.com/es/vida-y-estilo/20250120/10-actividades-gatos-adoran-mascotas-dv-113523081'
        break;
    case 3:
        noticia.src = 'https://www.infobae.com/mascotas/2025/01/18/la-memoria-y-comprension-del-lenguaje-en-los-gatos-revela-su-nivel-de-inteligencia/'
        break;

    default:
        window.location = "hogares.html"
        break;
}