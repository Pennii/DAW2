function medias() {
    var contenedor = document.getElementById("ejercicio1")
    var num1 = parseFloat(prompt("Ingrese un numero"))
    var num2 = parseFloat(prompt("Ingrese un numero"))
    var num3 = parseFloat(prompt("Ingrese un numero"))
    var media = document.createElement("p");

    while (isNaN(num1) || isNaN(num2) || isNaN(num3)) {
        alert("error al ingresar numeros, hagalo otra vez")
        num1 = parseFloat(prompt("Ingrese un numero"))
        num2 = parseFloat(prompt("Ingrese un numero"))
        num3 = parseFloat(prompt("Ingrese un numero"))
    }
    media.innerText = "La media de los 3 numeros es: " + ((num1 + num2 + num3) / 3)
    contenedor.appendChild(media)
}

function area() {
    var contenedor = document.getElementById("ejercicio2")
    var radio = parseFloat(prompt("Ingresa el radio del circulo"))
    var area = document.createElement("p")
    while (isNaN(radio)) {
        alert("Error al ingresar el radio")
        radio = parseFloat(prompt("Ingresa el radio del circulo"))
    }
    area.innerText = Math.PI * Math.pow(radio, 2)
    contenedor.appendChild(area)
}

function menorMayor() {
    var contenedor = document.getElementById("ejercicio3")
    var num1 = parseFloat(prompt("Ingrese un numero"))
    var num2 = parseFloat(prompt("Ingrese un numero"))
    var resultado = document.createElement("p")

    while (isNaN(num1) || isNaN(num2)) {
        alert("error al ingresar numeros")
        num1 = parseFloat(prompt("Ingrese un numero"))
        num2 = parseFloat(prompt("Ingrese un numero"))
    }
    if (num1 > num2) {
        resultado.innerText = "El primer numero es mayor"
    } else if (num2 > num1) {
        resultado.innerText = "El segundo numero es mayor"
    } else {
        resultado.innerText = "Los dos numeros son iguales"
    }
    contenedor.appendChild(resultado)
}

function vocales() {
    var contenedor = document.getElementById("ejercicio4")
    var text = prompt("Ingresa el texto que quieras")
    var parrafo = document.createElement("p")
    var contador = 0

    for (let i = 0; i < text.length; i++) {
        if (text[i].toLowerCase() == "a" || text[i].toLowerCase() == "e" || text[i].toLowerCase() == "i" || text[i].toLowerCase() == "o" || text[i].toLowerCase() == "u") {
            contador++
        }
    }
    parrafo.innerText = text + " contiene " + contador + " vocales"
    contenedor.appendChild(parrafo)
}

function aleatorio() {
    var num = Math.floor(1 + Math.random() * 100)
    alert(`El numero es: ${num}, no le digas a nadie`)

    var adivina = prompt("Intenta adivinar el numero [1-100]")
    while (adivina != num) {
        if (isNaN(adivina)) {
            alert("Ingresa un numero")
        } else {
            if (num > adivina) {
                alert("El numero que ingresaste es menor al secreto")
            } else {
                alert("El numero que ingresaste es mayor al secreto")
            }
        }
        adivina = prompt("Intenta adivinar")
    }
    alert("HAS ADIVINADO")
}

function pares() {
    var contenedor = document.getElementById("ejercicio6")
    var num = parseInt(prompt("Ingresa un numero"))
    var parrafo = document.createElement("p")
    var salida = ""
    while (isNaN(num)) {
        alert("ingresa un numero")
        num = parseInt(prompt("Ingresa un numero"))
    }

    for (let i = 0; i <= num; i += 2) {
        salida += `|${i}| `
    }
    parrafo.innerText = salida
    contenedor.appendChild(parrafo)
}

function palindromo() {
    var contenedor = document.getElementById("ejercicio7")
    var texto = prompt("Ingresa una palabra o texto")
    var otxet = ""
    var parrafo = document.createElement("p")

    texto.replace(" ", "")
    for (let i = texto.length - 1; i >= 0; i--) {
        otxet += texto[i]
    }
    if (texto.toLowerCase() == otxet.toLowerCase()) {
        parrafo.innerText = "tu texto es palindromo"
    } else {
        parrafo.innerText = "Tu texto no es palindromo"
    }
    contenedor.appendChild(parrafo)
}

function dados() {
    var contenedor = document.getElementById("ejercicio8")
    var dado1 = Math.floor(1 + Math.random() * 6)
    var dado2 = Math.floor(1 + Math.random() * 6)
    var dados = ""
    var muestra = document.createElement("div")
    var salida = document.createElement("p")

    switch (dado1) {
        case 1: dados = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-1" viewBox="0 0 16 16"> <circle cx="8" cy="8" r="1.5"/> <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/> </svg >'; break;
        case 2: dados = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-2" viewBox="0 0 16 16"> <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break;
        case 3: dados = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-3" viewBox="0 0 16 16"><path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break
        case 4: dados = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-4" viewBox="0 0 16 16"><path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break
        case 5: dados = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-5" viewBox="0 0 16 16"><path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break
        case 6: dados = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-6" viewBox="0 0 16 16"><path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-8 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break
    }
    switch (dado2) {
        case 1: dados += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-1" viewBox="0 0 16 16"> <circle cx="8" cy="8" r="1.5"/> <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/> </svg >'; break;
        case 2: dados += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-2" viewBox="0 0 16 16"> <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break;
        case 3: dados += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-3" viewBox="0 0 16 16"><path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break
        case 4: dados += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-4" viewBox="0 0 16 16"><path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break
        case 5: dados += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-5" viewBox="0 0 16 16"><path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break
        case 6: dados += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-6" viewBox="0 0 16 16"><path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/><path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-8 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>'; break
    }

    if (dado1 == dado2) {
        salida.innerText = "DOBLES"
    } else {
        salida.innerText = "no son dobles"
    }

    muestra.innerHTML = dados
    muestra.appendChild(salida)
    contenedor.appendChild(muestra)
}

function suma() {
    var contenedor = document.getElementById("ejercicio9")
    var numeros = prompt("Ingresa numeros separados por , por ejemplo 1,2,3,4,5,6")
    var suma = 0
    var nums = numeros.split(",")
    var parrafo = document.createElement("p")

    for (let i = 0; i < nums.length; i++) {
        if (!isNaN(nums[i])) {
            suma += parseInt(nums[i])
        }
    }
    parrafo.innerText = `La suma de los numeros ingresados es: ${suma}`
    contenedor.appendChild(parrafo)
}

function cuentaPalabras() {
    var contenedor = document.getElementById("ejercicio10")
    var texto = prompt("Ingresa un texto")
    var aux = texto.split(" ")
    var parrafo = document.createElement("p")

    parrafo.innerText = `Tu texto tiene ${aux.length} palabras`
    contenedor.appendChild(parrafo)
}