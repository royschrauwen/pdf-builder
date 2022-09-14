<?php
/**
 * EQUANS PDF Evaluation
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
abstract class Evaluation extends Report {


    function __construct(string $jsonData) {

        $reportData = json_decode(json_decode($jsonData), true);

        $this->vWorkingTitle = SJAQuery::get($reportData, 'workingTitle') ?? " ";
        $this->idReport = SJAQuery::get($reportData, '_id') ?? 0;
        $this->vType = SJAQuery::get($reportData, 'reportType') ?? 0;
        $this->dtDateTime = SJAQuery::get($reportData, 'tsDate') ? date('d-m-Y H:i', SJAQuery::get($reportData, 'tsDate')) : "-";
        $this->vDepartment = SJAQuery::get($reportData, 'department') ?? 0;
        $this->vReportedByName = SJAQuery::get($reportData, 'creator.name') ?? "";
        $this->vReportedByPhone = SJAQuery::get($reportData, 'creator.phoneNumber') ?? "";
        $this->vReportedByEmail = SJAQuery::get($reportData, 'creator.email') ?? "";
        $this->vCause = SJAQuery::get($reportData, 'reason') ?? "";
        $this->vReference = SJAQuery::get($reportData, 'reference') ?? "";
        $this->vCustomerInternal = SJAQuery::get($reportData, 'customerInternal') ?? "";
        $this->vDescription = SJAQuery::get($reportData, 'description') ?? "";
        $this->vNorm = SJAQuery::get($reportData, 'norm') ?? "";
        $this->vNormParagraph = SJAQuery::get($reportData, 'normParagraph') ?? "";
        $this->aProcess = SJAQuery::get($reportData, 'process.list') ?? "";
        $this->vImpactLevel = SJAQuery::get($reportData, 'impactLevel') ?? "";
        $this->vSegment = SJAQuery::get($reportData, 'segment') ?? "";
        $this->vProjectNameNumber = SJAQuery::get($reportData, 'projectNameNumber') ?? "";
        $this->vClientName = SJAQuery::get($reportData, 'location.clientName') ?? "";
        $this->aImages = SJAQuery::get($reportData, 'evidence.photo') ?? "";
        $this->vCauseDescription = SJAQuery::get($reportData, 'directCause') ?? "";
        $this->vCauseAnalysis = SJAQuery::get($reportData, 'directCause') ?? "";
        $this->vSizeAnalysis = SJAQuery::get($reportData, 'sizeAnalysis') ?? "";
        $this->vHowShouldBeSolved = SJAQuery::get($reportData, 'howShouldBeSolved') ?? "";
        $this->vActionsTaken = SJAQuery::get($reportData, 'actionsTaken') ?? "";
        $this->dtPlanningDate = SJAQuery::get($reportData, 'tsPlanned') ? date('d-m-Y', SJAQuery::get($reportData, 'tsPlanned')) : "-";
        $this->aFollowUpActions = SJAQuery::get($reportData, 'findings.actions') ?? "";
        $this->vEffectiveness = SJAQuery::get($reportData, 'impactLevel') ?? "";

    }

    
}
