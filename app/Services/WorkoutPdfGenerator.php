<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class WorkoutPdfGenerator
{
    public static function generate($workout)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('pdfs.workout', ['workout' => $workout])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf;
    }
}
