<?php
use \setasign\Fpdi\Fpdi;

require_once('vendor/fpdf/fpdf.php');
require_once('vendor/fpdi/src/autoload.php');

// Verificar si se ha enviado un archivo
if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] === UPLOAD_ERR_OK) {
    // Ruta temporal del archivo subido
    $archivoTemporal = $_FILES['archivo_pdf']['tmp_name'];

    $altura = $_POST['medida_altura'];

    // Ruta al directorio donde se guardarán los archivos
    $directorioDestino = 'uploads/';

    // Nombre único para el archivo PDF
    $nombreArchivo = uniqid('pdf_') . '.pdf';

    // Mover el archivo temporal al directorio de destino
    move_uploaded_file($archivoTemporal, $directorioDestino . $nombreArchivo);

    // Ruta al archivo PDF original
    $archivoPDF = $directorioDestino . $nombreArchivo;

    // Ruta al archivo PDF de salida con la marca de agua
    $archivoSalida = $directorioDestino . '_sellado.pdf';

    // Ruta a la imagen de la marca de agua
    $marcaAgua = 'img/sello_manuales.png';

    // Verificar si se ha enviado el valor de 'sellar-manual_registro'
    if (isset($_POST['sellar-manual_registro'])) {
        $registro = $_POST['sellar-manual_registro'];

        // Crear una nueva instancia de FPDI
        $pdf = new Fpdi();

        // Obtener el número de páginas del PDF original
        $paginas = $pdf->setSourceFile($archivoPDF);

        // Recorrer todas las páginas del PDF original
        for ($i = 1; $i <= $paginas; $i++) {
            // Agregar una página en blanco al PDF de salida
            $pdf->AddPage();

            // Importar la página del PDF original
            $template = $pdf->importPage($i);

            // Establecer la página importada como la página actual
            $pdf->useTemplate($template);

            // Agregar la marca de agua a la página actual
            $pdf->Image($marcaAgua, 130, 10, 75, 45);

            // Agregar texto solo en la primera página
            if ($i === 1) {
                $pdf->SetFont('Helvetica', 'B', 18);
                $pdf->SetTextColor(112, 112, 112);

                // Get the width of the page
                $pageWidth = $pdf->GetPageWidth();

                // Get the width of the text
                $textWidth = $pdf->GetStringWidth($registro);

                // Calculate the x-coordinate to center the text
                $x = ($pageWidth - $textWidth) / 2;

                $pdf->SetXY($x, $altura);
                $pdf->Cell(0, 10, $registro, 0, 1, 'L');
            }
        }

        // Guardar el PDF de salida con la marca de agua
        $pdf->Output($archivoSalida, 'F');

        // Descargar el archivo con la marca de agua
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $registro . '_sellado.pdf"');
        readfile($archivoSalida);

        // Borrar los archivos temporales
        unlink($archivoPDF);
        unlink($archivoSalida);
    } else {
        echo "El campo 'sellar-manual_registro' no se ha enviado correctamente.";
    }
} else {
    echo "No se ha enviado ningún archivo o ha ocurrido un error en la carga.";
}