const quizData = [
    {
        question: "En las últimas dos semanas, ¿con qué frecuencia te has sentido deprimido o sin esperanzas?",
        a: "Nunca",
        b: "Algunos días",
        c: "Más de la mitad de los días",
        d: "Casi todos los días",
        aspect: "depresion",
        scores: [0, 1, 2, 3]
    },
    {
        question: "En las últimas dos semanas, ¿con qué frecuencia te has sentido ansioso o nervioso?",
        a: "Nunca",
        b: "Algunos días",
        c: "Más de la mitad de los días",
        d: "Casi todos los días",
        aspect: "ansiedad",
        scores: [0, 1, 2, 3]
    },
    {
        question: "En las últimas dos semanas, ¿con qué frecuencia has tenido dificultades para dormir?",
        a: "Nunca",
        b: "Algunos días",
        c: "Más de la mitad de los días",
        d: "Casi todos los días",
        aspect: "insomnio",
        scores: [0, 1, 2, 3]
    },
    {
        question: "En las últimas dos semanas, ¿con qué frecuencia te has sentido estresado?",
        a: "Nunca",
        b: "Algunos días",
        c: "Más de la mitad de los días",
        d: "Casi todos los días",
        aspect: "estres",
        scores: [0, 1, 2, 3]
    },
    {
        question: "En las últimas dos semanas, ¿con qué frecuencia te has sentido con baja autoestima?",
        a: "Nunca",
        b: "Algunos días",
        c: "Más de la mitad de los días",
        d: "Casi todos los días",
        aspect: "bajaAutoestima",
        scores: [0, 1, 2, 3]
    }
];

const quiz = document.getElementById('quiz');
const answerEls = document.querySelectorAll('.answer');
const questionEl = document.getElementById('question');
const a_text = document.getElementById('a_text');
const b_text = document.getElementById('b_text');
const c_text = document.getElementById('c_text');
const d_text = document.getElementById('d_text');
const submitBtn = document.getElementById('submit');

let currentQuiz = 0;
let scores = {
    ansiedad: 0,
    depresion: 0,
    estres: 0,
    insomnio: 0,
    bajaAutoestima: 0
};

loadQuiz();

function loadQuiz() {
    deselectAnswers();
    const currentQuizData = quizData[currentQuiz];
    questionEl.innerText = currentQuizData.question;
    a_text.innerText = currentQuizData.a;
    b_text.innerText = currentQuizData.b;
    c_text.innerText = currentQuizData.c;
    d_text.innerText = currentQuizData.d;
}

function deselectAnswers() {
    answerEls.forEach(answerEl => answerEl.checked = false);
}

function getSelected() {
    let selectedAnswer = null;
    answerEls.forEach(answerEl => {
        if (answerEl.checked) {
            selectedAnswer = answerEl.id;
        }
    });
    return selectedAnswer;
}

submitBtn.addEventListener('click', () => {
    const selectedAnswer = getSelected();
    if (selectedAnswer) {
        const currentQuizData = quizData[currentQuiz];
        const score = currentQuizData.scores[selectedAnswer.charCodeAt(0) - 97];

        scores[currentQuizData.aspect] += score;

        console.log(scores); // Añadir log para depuración

        currentQuiz++;

        if (currentQuiz < quizData.length) {
            loadQuiz();
        } else {
            displayResults();
        }
    }
});

function displayResults() {
    let diagnosis = "<strong>Diagnóstico:</strong><br>";

    diagnosis += "<p>" + getDiagnosisMessage(scores.ansiedad, 'ansiedad') + "</p>";
    diagnosis += "<p>" + getDiagnosisMessage(scores.depresion, 'depresión') + "</p>";
    diagnosis += "<p>" + getDiagnosisMessage(scores.estres, 'estrés') + "</p>";
    diagnosis += "<p>" + getDiagnosisMessage(scores.insomnio, 'insomnio') + "</p>";
    diagnosis += "<p>" + getDiagnosisMessage(scores.bajaAutoestima, 'baja autoestima') + "</p>";

    quiz.innerHTML = `
        <h2>Diagnóstico:</h2>
        ${diagnosis}
        <button onclick="location.reload()">Volver a intentarlo</button>
    `;

    fetch('save_results.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            scores: scores,
            diagnosis: diagnosis
        })
    })
    .then(response => response.text())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}

function getDiagnosisMessage(score, category) {
    let message = '';
    if (score >= 9) {
        message = `Signos severos de <strong>${category}</strong>. Es recomendable buscar ayuda profesional.`;
    } else if (score >= 6) {
        message = `Signos moderados de <strong>${category}</strong>. Considera hablar con un profesional.`;
    } else if (score >= 3) {
        message = `Signos leves de <strong>${category}</strong>. Mantén un ojo en tu bienestar.`;
    } else {
        message = `No hay indicios significativos de <strong>${category}</strong>.`;
    }
    return message;
}
