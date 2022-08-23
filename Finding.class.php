<?php

require_once __DIR__ . '/Equans.class.php';


/**
 * EQUANS PDF Inspection PDF Findings
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Finding extends Equans {

    function __construct(
    private string $description,
    private string $type,
    private string $collegues,
    private string $department,
    private array $images,
    private string $actionsTaken,
    private array $followUpActions,
    ) {}

    

}