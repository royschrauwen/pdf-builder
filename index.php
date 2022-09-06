<?php

// Required for mPDF / Composer
require_once __DIR__ . '/vendor/autoload.php';

// I don't know how autoloaders work yet... '^_^
require_once __DIR__ . '/classes/Report.class.php';
require_once __DIR__ . '/classes/IncidentReport.class.php';
require_once __DIR__ . '/classes/Evaluation.class.php';
require_once __DIR__ . '/classes/InternalEvaluation.class.php';
require_once __DIR__ . '/classes/ExternalEvaluation.class.php';
require_once __DIR__ . '/classes/Inspection.class.php';
require_once __DIR__ . '/classes/FollowUpAction.class.php';
require_once __DIR__ . '/classes/Theme.class.php';
require_once __DIR__ . '/classes/Finding.class.php';
require_once __DIR__ . '/classes/PDFExport.class.php';


// Dummy data for testing
include_once 'includes/dummyDataInternalEvaluation.inc.php';
include_once 'includes/dummyDataExternalEvaluation.inc.php';
include_once 'includes/dummyDataInspection.inc.php';
include_once 'includes/dummyDataIncidentReport.inc.php';


// All three below are used for a different report templating structure

// (new PDFExport($oInternalEvaluation))->create();
// (new PDFExport($oExternalEvaluation))->create();
// (new PDFExport($oInspection))->create(PDFExport::OUTPUT_INLINE);
(new PDFExport($oIndicentReport))->create(PDFExport::OUTPUT_INLINE);


?>