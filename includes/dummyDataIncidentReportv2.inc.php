<?php

// Voorbeeldrapportage IncidentReport
// Import DummyIncidentJson.json as $json
$json = json_encode(file_get_contents(__DIR__ . '/DummyIncidentJson.json'));

$oIndicentReport2 = new IncidentReport($json);