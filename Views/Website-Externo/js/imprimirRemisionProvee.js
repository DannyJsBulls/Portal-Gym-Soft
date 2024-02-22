function imprimirComprobante() {
    // Captura el contenido de la sección
    var contenidoSeccion = document.getElementById('comprobanteSection').outerHTML;

    // Abre una nueva ventana o pestaña con el contenido
    var ventanaImpresion = window.open('', '_blank');
    ventanaImpresion.document.write('<html><head><title>Recibo Pedido Proveedor</title>');

    // Incluye los enlaces a los estilos y recursos necesarios
    ventanaImpresion.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">');
    ventanaImpresion.document.write('<link rel="stylesheet" type="text/css" href="../Dashboard/css/bootstrap.min.css">');
    ventanaImpresion.document.write('<link rel="stylesheet" type="text/css" href="../Dashboard/css/style.css">');

    // Puedes incluir más enlaces según sea necesario

    ventanaImpresion.document.write('</head><body>');
    ventanaImpresion.document.write(contenidoSeccion);
    ventanaImpresion.document.write('</body></html>');
    ventanaImpresion.document.close();

    // Espera a que los estilos y recursos se carguen antes de imprimir
    ventanaImpresion.onload = function() {
        ventanaImpresion.print();
    };
}