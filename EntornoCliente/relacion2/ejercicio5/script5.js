var mes = parseInt(prompt("Ingresa el mes del año con valor numerico"));

switch(mes){
    case 1:
    case 3:
    case 5:
    case 7:
    case 8:
    case 10:
    case 12:
        document.write("El mes tiene 31 dias");
        break;
    case 4:
    case 6:
    case 9:
    case 11:
        document.write("El mes tiene 30 dias");
        break;
    default: document.write("El mes tiene 28 dias");
    }
