<?php

require_once __DIR__ . '/vendor/autoload.php';

// I don't know how autoloaders work yet...
require_once __DIR__ . '/classes/Report.class.php';
require_once __DIR__ . '/classes/InternalEvaluation.class.php';
require_once __DIR__ . '/classes/ExternalEvaluation.class.php';
require_once __DIR__ . '/classes/Inspection.class.php';
require_once __DIR__ . '/classes/FollowUpAction.class.php';
require_once __DIR__ . '/classes/Theme.class.php';
require_once __DIR__ . '/classes/Finding.class.php';
require_once __DIR__ . '/classes/PDFExport.class.php';


//$oInternalEvaluation data comes from dummyDataInternalEvaluation.inc.php
include_once 'includes/dummyDataInternalEvaluation.inc.php';

//$oExternalEvaluation data comes from dummyDataInternalEvaluation.inc.php
include_once 'includes/dummyDataExternalEvaluation.inc.php';

//$oInspection data comes from dummyDataInternalEvaluation.inc.php
include_once 'includes/dummyDataInspection.inc.php';


// This method is used to generate the PDF file for Internal Evaluations
// (new PDFExport($oInternalEvaluation))->createInternalEvaluationPDF();

// This method is used to generate the PDF file for External Evaluations
// (new PDFExport($oExternalEvaluation))->createExternalEvaluationPDF();

// This method is used to generate the PDF file for External Evaluations
(new PDFExport($oInspection))->createInspectionPDF();

?>