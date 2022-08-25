<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/classes/Report.class.php';
require_once __DIR__ . '/classes/FollowUpAction.class.php';
require_once __DIR__ . '/classes/PDFExport.class.php';

include_once 'dummyDataInternalEvaluation.inc.php';

$pdfExport = new PDFExport($report);
$pdfExport->createEvaluationPDF();

?>