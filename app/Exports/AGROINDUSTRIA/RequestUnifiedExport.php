<?php

namespace App\Exports\AGROINDUSTRIA;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RequestUnifiedExport implements FromCollection, WithHeadings, Responsable, WithStyles, WithDrawings
{
    use Exportable;

    protected $groupedSupplies;
    protected $planning_date;

    public function __construct(Collection $groupedSupplies, $planning_date)
    {
        $this->groupedSupplies = $groupedSupplies;
        $this->planning_date = $planning_date;
    }

    public function collection(){
        return collect([]);
    }

    public function headings(): array
    {
        // Define las columnas del encabezado
        return [];
    }

    public function toResponse($request)
    {
        // Genera y descarga el archivo Excel
        $excelFileName = 'PPMI_F06 SOLICITUD DE MATERIALES ALMACEN.xlsx';
        return $this->download($excelFileName)
            ->withHeaders([
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
    }

    public function styles(Worksheet $sheet)
    {
        //Pixeles columnas
        $sheet->getColumnDimension('A')->setWidth(1.5);
        $sheet->getColumnDimension('B')->setWidth(5.7);
        $sheet->getColumnDimension('C')->setWidth(12.3);
        $sheet->getColumnDimension('D')->setWidth(1.7);
        $sheet->getColumnDimension('E')->setWidth(16);
        $sheet->getColumnDimension('F')->setWidth(1.7);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(12.5);
        $sheet->getColumnDimension('I')->setWidth(5.7);
        $sheet->getColumnDimension('J')->setWidth(5.7); 
        $sheet->getColumnDimension('K')->setWidth(11);
        $sheet->getColumnDimension('L')->setWidth(11);
        $sheet->getColumnDimension('M')->setWidth(18);

        //Pixeles hileras
        $sheet->getRowDimension(1)->setRowHeight(8);
        $sheet->getRowDimension(2)->setRowHeight(8);
        $sheet->getRowDimension(3)->setRowHeight(8);
        $sheet->getRowDimension(4)->setRowHeight(8);
        $sheet->getRowDimension(5)->setRowHeight(8);
        $sheet->getRowDimension(6)->setRowHeight(8);
        $sheet->getRowDimension(7)->setRowHeight(20);
        $sheet->getRowDimension(8)->setRowHeight(20);
        $sheet->getRowDimension(9)->setRowHeight(32);
        $sheet->getRowDimension(10)->setRowHeight(27);
        $sheet->getRowDimension(11)->setRowHeight(27);
        $sheet->getRowDimension(12)->setRowHeight(27);
        $sheet->getRowDimension(13)->setRowHeight(27);
        $sheet->getRowDimension(14)->setRowHeight(27);
        $sheet->getRowDimension(15)->setRowHeight(27);
        $sheet->getRowDimension(16)->setRowHeight(16);

        // Unir celdas
        $sheet->mergeCells('B2:E9');
        $sheet->mergeCells('F2:M9');
        $sheet->mergeCells('B10:C10');
        $sheet->mergeCells('E10:F10');
        $sheet->mergeCells('H10:I10');
        $sheet->mergeCells('J10:M10');
        $sheet->mergeCells('B11:C11');
        $sheet->mergeCells('E11:F11');
        $sheet->mergeCells('G11:H11');
        $sheet->mergeCells('I11:M11');
        $sheet->mergeCells('B12:C12');
        $sheet->mergeCells('E12:F12');
        $sheet->mergeCells('G12:H12');
        $sheet->mergeCells('I12:M12');
        $sheet->mergeCells('H13:K13');
        $sheet->mergeCells('B14:G14');
        $sheet->mergeCells('H14:K14');
        $sheet->mergeCells('H15:M15');
        $sheet->mergeCells('C17:D17');
        $sheet->mergeCells('E17:G17');
        $sheet->mergeCells('I17:J17');
        $sheet->mergeCells('K17:M17');

        // Agregar bordes a las celdas
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        // Aplicar estilos a las celdas
        $sheet->getStyle('B2:M9')->applyFromArray($styleArray);
        $sheet->getStyle('B10:M16')->applyFromArray($styleArray);
        $sheet->getStyle('B17')->applyFromArray($styleArray);
        $sheet->getStyle('C17:D17')->applyFromArray($styleArray);
        $sheet->getStyle('E17:G17')->applyFromArray($styleArray);
        $sheet->getStyle('H17')->applyFromArray($styleArray);
        $sheet->getStyle('I17:J17')->applyFromArray($styleArray);
        $sheet->getStyle('K17:M17')->applyFromArray($styleArray);

        // Configuración de estilos
        $sheet->getStyle('F2:M9')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
        ]);

        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('F2', "SERVICIO NACIONAL DE APRENDIZAJE SENA\nGESTIÓN DE INFRAESTRUCTURA Y LOGÍSTICA\nFORMATO SOLICITUD DE BIENES");
        $sheet->getStyle('F2')->getAlignment()->setWrapText(true);
        $sheet->getStyle('F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);        
        

        // Configurar estilos para el texto en B10:C10
        $sheet->getStyle('B10')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('B10', 'FECHA SOLICITUD');

        
        
        $sheet->getStyle('E10:F10')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('E10')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('E10', $this->planning_date);

        $sheet->getStyle('H10')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('H10', 'AREA');

        $sheet->getStyle('J10:M10')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('J10')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('J10', 'COMPLEJO AGROINDUSTRIAL');

        $sheet->getStyle('B11')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('B11', 'CODIGO REGIONAL');

        $sheet->getStyle('E11:F11')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('E11')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('E11', '41');

        $sheet->getStyle('G11')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('G11', 'NOMBRE REGIONAL');

        $sheet->getStyle('I11:M11')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('I11')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('I11', 'HUILA');

        $sheet->getStyle('B12')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('B12', 'CÓDIGO DE COSTOS');

        $sheet->getStyle('E12:F12')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('E12')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('E12', '911610');

        $sheet->getStyle('G12')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('G12', 'NOMBRE CENTRO DE COSTO');

        $sheet->getStyle('I12:M12')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('I12')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('I12', 'Centro de Formación Agroindsutrial La Angostura.');

        $sheet->getStyle('B13')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('B13', 'NOMBRE DE JEFE DE OFICINA O COORDINADOR DE AREA:');

        $sheet->getStyle('H13:K13')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('H13')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('H13', '');

        $sheet->getStyle('L13')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('L13', 'CEDULA');

        $sheet->getStyle('M13')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('M13')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('M13', '');

        $sheet->getStyle('B14')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('B14', 'NOMBRE DE SERVIDOR PÚBLICO A QUIEN SE LE ASIGNARA EL BIEN:');

        $sheet->getStyle('H14:K14')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('H14')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('H14', '');

        $sheet->getStyle('L14')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('L14', 'CEDULA');

        $sheet->getStyle('M14')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('M14')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('M14', '');

        $sheet->getStyle('B15')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);
    
        // Agregar texto a las celdas fusionadas
        $sheet->setCellValue('B15', 'CÓDIGO DE GRUPO O FICHA DE CARACTERIZACIÓN');

        $sheet->getStyle('H15:M15')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('H15')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('H15', '');

        $sheet->getStyle('B17')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->setCellValue('B17', 'ITEM');

        $sheet->getStyle('C17')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->setCellValue('C17', 'CÓDIGO SENA');

        $sheet->getStyle('E17')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->setCellValue('E17', 'DESCRIPCION DE BIEN');

        $sheet->getStyle('H17')->getAlignment()->setWrapText(true);
        $sheet->getStyle('H17')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->setCellValue('H17', 'UNIDAD DE MEDIDA');

        $sheet->getStyle('I17')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->setCellValue('I17', 'CANTIDAD');

        $sheet->getStyle('K17')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->setCellValue('K17', 'OBSERVACIONES');

        $consumablesStartRow = 17;

        $itemNumber = 1;
        foreach ($this->groupedSupplies as $supplie) {
            $sheet->getStyle('B'. $consumablesStartRow + $itemNumber)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

            $sheet->getStyle('B' . $consumablesStartRow + $itemNumber)->applyFromArray([
                'font' => [
                    'size' => 11,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ]);

            $sheet->setCellValue('B' . $consumablesStartRow + $itemNumber, $itemNumber);

            // Calcula la fila actual
            $currentRow = $consumablesStartRow + $itemNumber;

            $sheet->mergeCells('C' . $currentRow . ':D' . $currentRow);
            $sheet->mergeCells('E' . $currentRow . ':G' . $currentRow);
            $sheet->mergeCells('I' . $currentRow . ':J' . $currentRow);
            $sheet->mergeCells('K' . $currentRow . ':M' . $currentRow);

            $sheet->getRowDimension($currentRow)->setRowHeight(27);

            $sheet->getStyle('B' . $currentRow)->applyFromArray($styleArray);
            $sheet->getStyle('B'. $currentRow)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('C' . $currentRow . ':D' . $currentRow)->applyFromArray($styleArray);
            $sheet->getStyle('C' . $currentRow . ':D' . $currentRow)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('E' . $currentRow . ':G' . $currentRow)->applyFromArray($styleArray);
            $sheet->getStyle('E' . $currentRow . ':G' . $currentRow)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('H' . $currentRow)->applyFromArray($styleArray);
            $sheet->getStyle('H' . $currentRow)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('I' . $currentRow . ':J' . $currentRow)->applyFromArray($styleArray);
            $sheet->getStyle('I' . $currentRow . ':J' . $currentRow)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('K' . $currentRow . ':M' . $currentRow)->applyFromArray($styleArray);
            $sheet->getStyle('K' . $currentRow . ':M' . $currentRow)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

            $sheet->getStyle('C' . $currentRow)->applyFromArray([
                'font' => [
                    'size' => 11,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
            ]);

            $sheet->setCellValue('C' . $currentRow, $supplie['code_sena']);

            $sheet->getStyle('E' . $currentRow)->applyFromArray([
                'font' => [
                    'size' => 11,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
            ]);

            $sheet->setCellValue('E' . $currentRow, $supplie['element_name']);

            $sheet->getStyle('H' . $currentRow)->applyFromArray([
                'font' => [
                    'size' => 11,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ]);

            $sheet->setCellValue('H' . $currentRow, $supplie['measurement_unit']);

            $sheet->getStyle('I' . $currentRow)->applyFromArray([
                'font' => [
                    'size' => 11,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ]);

            $sheet->setCellValue('I' . $currentRow, $supplie['total_quantity']);

            // Incrementa el número de ítem
            $itemNumber++;
        }
        // Después del bucle, obtén la fila de la última celda generada
        $lastRow = $consumablesStartRow + $itemNumber - 1;

        // Agrega la nueva celda después de la última generada
        $newRow = $lastRow + 1;

        $sheet->mergeCells('F' . $newRow+1 . ':L' . $newRow+1);

        $sheet->getRowDimension($newRow)->setRowHeight(27);
        $sheet->getRowDimension($newRow+1)->setRowHeight(16);
        $sheet->getRowDimension($newRow+2)->setRowHeight(16);

        $sheet->getStyle('B' . $newRow . ':M' . $newRow+2)->applyFromArray($styleArray);

        $sheet->getStyle('B' . $newRow+1)->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('B' . $newRow+1, 'FIRMA DE QUIEN AUTORIZA');

        $sheet->getStyle('F' . $newRow+1 . ':L' . $newRow+1)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('F' . $newRow+1)->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->setCellValue('F' . $newRow+1, '');


        $sheet->getStyle('M' . $newRow+3)->applyFromArray([
            'font' => [
                'bold' => false,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->setCellValue('M' . $newRow+3, 'GIL-F-010 V.03');
    }
        
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Imagen 2');
        $drawing->setPath(public_path('/modules/agroindustria/img/f_solicitud.png'));
        $drawing->setCoordinates('B2');
        $drawing->setOffsetX(20);
        $drawing->setOffsetY(10);
        $drawing->setWidth(100); // Ajusta el ancho según sea necesario
        $drawing->setHeight(130); // Ajusta la altura según sea necesario
        
        return $drawing;
    }
}

