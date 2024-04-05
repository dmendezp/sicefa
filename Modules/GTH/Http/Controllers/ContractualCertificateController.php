<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\Person;
use Carbon\Carbon; // Asegúrate de importar la clase Carbon
use Barryvdh\DomPDF\Facade\Pdf;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;
use Money\Formatter\IntlMoneyFormatter;
use NumberToWords\NumberToWords;

class ContractualCertificateController extends Controller
{
    public function viewcontractualcertificate(Request $request)
    {
        $contractors = [];

        // Si se envía el formulario de búsqueda, realiza la búsqueda en la base de datos.
        if ($request->has('person_id')) {
            $contractors = Contractor::where('person_id', $request->input('person_id'))->get();
        }

        return view('gth::contractualcertificate.contractualcertificate', compact('contractors'));
    }
    public function search(Request $request)
    {
        $document_number = $request->input('document');

        $personid = Person::where('document_number', $document_number)->get()->pluck('id');

        $contract = Contractor::where('person_id', $personid)->get();

        return view('gth::contractualcertificate.resultcontractual', [
            'contractors' => $contract,


        ]);
    }
    
    public function pdf(Request $request, $id)
{
    $contracts = Contractor::where('id', $id)->get();

    if ($contracts->isEmpty()) {
        // Manejar el caso donde no se encuentran contratos
        abort(404);
    }

    // Supongamos que solo estás interesado en el primer contrato de la colección
    $contract = $contracts->first();

    $imagePath = public_path('modules/gth/images/sena.jpg');
    $imageData = file_get_contents($imagePath);
    $base64Image = 'data:image/jpeg;base64,' . base64_encode($imageData);

    $Path = public_path('modules/gth/images/certificado.jpg');
    $Data = file_get_contents($Path);
    $image1 = 'data:image/jpeg;base64,' . base64_encode($Data);

    // Calcula la diferencia entre la fecha de inicio y la fecha de fin
    $startDate = Carbon::parse($contract->contract_start_date);
    $endDate = Carbon::parse($contract->contract_end_date);
    $duration = $endDate->diff($startDate);

    // Convierte el valor total del contrato a letras
    $totalInCOP = new Money($contract->total_contract_value, new Currency('COP'));
    $numberToWords = new NumberToWords();
    $currencyTransformer = $numberToWords->getCurrencyTransformer('es');
    $totalInWords = $currencyTransformer->toWords($totalInCOP->getAmount(), 'COP');

    // Formatea el valor total del contrato en moneda colombiana
    $formatter = new IntlMoneyFormatter(
        new \NumberFormatter('es_CO', \NumberFormatter::CURRENCY),
        new ISOCurrencies()
    );
    $formattedTotal = $formatter->format($totalInCOP);

    $pdf = PDF::loadView('gth::contractualcertificate.contractpdf', [
        'contractors' => $contracts,
        'image' => $base64Image,
        'image1' => $image1,
        'duration' => $duration,
        'totalInWords' => $totalInWords,
        'formattedTotal' => $formattedTotal,

    ]);

    // Personaliza opciones del PDF si es necesario
    $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

    // Devuelve el PDF para verlo o descargar
    return $pdf->stream('Contractual.PDF');
}


}
