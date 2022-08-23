<?php

require_once __DIR__ . '/Equans.class.php';
/**
 * EQUANS PDF Reports
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class FollowUpAction extends Equans {
    
    function __construct(
    private string $description,
    private string $actionType,
    private string $reportedActionHolder,
    private string $linkedActionHolder,
    private string $plannedDate
    ) {} 
}
?>