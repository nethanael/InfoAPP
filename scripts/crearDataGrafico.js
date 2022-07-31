function crearData(misDatos){
    var datosFormato = [];

    for (let i=0; i < misDatos.length; i++){
        if (i % 2 == 0){
            datosFormato.push(misDatos[i]);
        }
    }
    return (datosFormato);
}

function crearLabels(misDatos){
    var datosFormato = [];
    for (let i=0; i < misDatos.length; i++){
        if (i % 2 != 0){
            datosFormato.push(misDatos[i]);
        }
    }
    return (datosFormato);
}