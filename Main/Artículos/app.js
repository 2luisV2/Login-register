let cantidadNoticias = 5;
let pageFinal = cantidadNoticias;
let pageInicial = 0;

let apiKey = '18fa699379554ce9bebff518e1b313f1';
let queries = [
    'psicología emocional', 'psicologia de las emociones', 'problemas emocionales', 'trastornos psicológicos',
    'salud mental', 'terapia emocional', 'inteligencia emocional', 'bienestar emocional',
    'ansiedad', 'depresión', 'psicología positiva', 'resiliencia emocional', 'desarrollo personal',
    'apoyo psicológico', 'autoestima', 'trastornos de ansiedad', 'mindfulness', 'meditación',
    'relaciones interpersonales', 'crecimiento emocional'
];
let query = queries.map(q => `(${encodeURIComponent(q)})`).join(' OR ');
let language = 'es';


let noticias = {
    apiKey: apiKey,
    query: query,
    fetchNoticias: function () {
        fetch(`https://newsapi.org/v2/everything?q=${this.query}&language=${language}&apiKey=${this.apiKey}`)
            .then((response) => response.json())
            .then((data) => this.displayNoticias(data))
            .catch((error) => console.error('Error fetching news:', error));
    },
    displayNoticias: function (data) {
        if (pageInicial == 0) {
            document.querySelector(".container-noticias").textContent = "";
        }

        if (!data.articles || data.articles.length === 0) {
            let noResults = document.createElement("p");
            noResults.textContent = "No se encontraron noticias.";
            document.querySelector(".container-noticias").appendChild(noResults);
            return;
        }

        let articlesToShow = data.articles.slice(pageInicial, pageFinal + 1);
        for (let article of articlesToShow) {
            const { title, urlToImage, publishedAt, source, url } = article;

            let h2 = document.createElement("h2");
            h2.textContent = title;

            let img = document.createElement("img");
            img.setAttribute("src", urlToImage);

            let info_item = document.createElement("div");
            info_item.className = "info_item";

            let fecha = document.createElement("span");
            let date = publishedAt.split("T")[0].split("-").reverse().join("-");
            fecha.className = "fecha";
            fecha.textContent = date;

            let fuente = document.createElement("span");
            fuente.className = "fuente";
            fuente.textContent = source.name;

            info_item.appendChild(fecha);
            info_item.appendChild(fuente);

            let item = document.createElement("div");
            item.className = "item";
            item.appendChild(h2);
            item.appendChild(img);
            item.appendChild(info_item);
            item.setAttribute("onclick", "location.href='" + url + "'");
            document.querySelector(".container-noticias").appendChild(item);
        }

        if (pageFinal < data.articles.length - 1) {
            let btnSiguiente = document.createElement("span");
            btnSiguiente.id = "btnSiguiente";
            btnSiguiente.textContent = "Ver más";
            btnSiguiente.setAttribute("onclick", "siguiente()");
            document.querySelector(".container-noticias").appendChild(btnSiguiente);
        }
    }
}

function siguiente() {
    pageInicial = pageFinal + 1;
    pageFinal = pageFinal + cantidadNoticias + 1;
    document.querySelector("#btnSiguiente").remove();
    noticias.fetchNoticias();
}

noticias.fetchNoticias();
