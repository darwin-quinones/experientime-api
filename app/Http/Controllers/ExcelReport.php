<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use PhpOffice\PhpSpreadsheet\Style\Fill;


// PHP SPREADSHEET LIBRARY
require '../vendor/autoload.php';

class ExcelReport extends Controller
{

    public function generateCarsExcel()
    {
        // get data first
        $data = Car::select('name', 'model', 'brand', 'country', 'creation_date', 'update_date')->get();
        $mySpreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // delete the default active sheet
        $mySpreadsheet->removeSheetByIndex(0);
        $worksheet1 = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($mySpreadsheet, 'cars excel');
        $mySpreadsheet->addSheet($worksheet1);

        $data_head = [
            'Name', 'Model', 'Brand', 'Country', 'Creation date', 'Update date'
        ];

        // transform array to 2D array
        $dataArray = json_decode(json_encode($data), true);
        $data = array_map(function ($row) {
            return array_values((array)$row);
        }, $dataArray);
        array_unshift($data, $data_head);
        $worksheet1->fromArray($data, null, 'A1');
        // $worksheets = [$worksheet1];

        // Set the background color
        for ($rowNumber = 1; $rowNumber < 2; $rowNumber++) {
            $color = '4472C4';
            $worksheet1->getStyle('A' . $rowNumber . ':F' . $rowNumber)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($color);
        }

        // Set the font style to bold and text color to white for the header row (first row)
        $worksheet1->getStyle('1:1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
        ]);

        $filename = "cars-excel.xlsx";

        // Set the path to the directory where the file will be saved
        $directoryPath = public_path('uploads/reports');

        // Ensure the directory exists, if it doesn't create it
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
        // Set the full file path
        $filePath = $directoryPath . '/' . $filename;
        // ensure the file exists. if exists will deleted it
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Save to file.
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($mySpreadsheet);
        $writer->save($filePath);

        // File is save here: public\uploads\reports\excel...
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
