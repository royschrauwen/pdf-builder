<?php

// Required for mPDF / Composer
require_once __DIR__ . '/vendor/autoload.php';

// Included here but has to be replaced with the correct one
require_once __DIR__ . '/includes/sjaquery.php';

// All classes needed for the PDF Export
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
//include_once 'includes/dummyDataInternalEvaluation.inc.php';
//include_once 'includes/dummyDataExternalEvaluation.inc.php';
//include_once 'includes/dummyDataInspection.inc.php';


// Different PDF Export Templates
//(new PDFExport(new Inspection(json_encode(file_get_contents(__DIR__ . '/includes/DummyInspection.json')))))->create(PDFExport::OUTPUT_INLINE);
//(new PDFExport(new ExternalEvaluation(json_encode(file_get_contents(__DIR__ . '/includes/DummyEvaluation.json')))))->create(PDFExport::OUTPUT_INLINE);
//(new PDFExport(new InternalEvaluation(json_encode(file_get_contents(__DIR__ . '/includes/DummyEvaluation.json')))))->create(PDFExport::OUTPUT_INLINE);
(new PDFExport(new IncidentReport(json_encode(file_get_contents(__DIR__ . '/includes/DummyIncidentJson.json')))))->create(PDFExport::OUTPUT_INLINE);
