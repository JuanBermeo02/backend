<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

// Crear un nuevo archivo de Excel
$spreadsheet = new Spreadsheet();

// Obtener todas las tablas de la base de datos
$tablesQuery = mysqli_query($conexion, "SHOW TABLES");
$tableIndex = 0;

while ($tableRow = mysqli_fetch_row($tablesQuery)) {
    $tableName = $tableRow[0];

    // Si no es la primera tabla, crea una nueva hoja
    if ($tableIndex > 0) {
        $spreadsheet->createSheet();
    }

    $spreadsheet->setActiveSheetIndex($tableIndex);
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle(substr($tableName, 0, 31)); // nombre de hoja (máx 31 caracteres)

    $result = mysqli_query($conexion, "SELECT * FROM `$tableName`");
    $columns = mysqli_fetch_fields($result);

    // Escribir encabezados
    $colIndex = 1;
    foreach ($columns as $col) {
        $colLetter = Coordinate::stringFromColumnIndex($colIndex);
        $sheet->setCellValue($colLetter . '1', $col->name);
        $colIndex++;
    }

    // Escribir datos
    $rowIndex = 2;
    while ($row = mysqli_fetch_assoc($result)) {
        $colIndex = 1;
        foreach ($row as $cell) {
            $colLetter = Coordinate::stringFromColumnIndex($colIndex);
            $sheet->setCellValue($colLetter . $rowIndex, $cell);
            $colIndex++;
        }
        $rowIndex++;
    }

    $tableIndex++;
}

// Definir el nombre del archivo Excel
$filename = "reporte_general_" . date("Y-m-d_H-i-s") . ".xlsx";

// Configurar cabeceras para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

// Enviar el archivo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
