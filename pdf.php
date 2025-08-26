<?php
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Enable remote resources if needed
$options = new Options();
$options->set('isRemoteEnabled', true);

// Initialize Dompdf
$dompdf = new Dompdf($options);

// Load HTML content from buffer
ob_start();
include 'invoice_template.php';
$html = ob_get_clean();

// Load and render
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output the PDF to browser
$dompdf->stream("invoice.pdf", ["Attachment" => false]);
