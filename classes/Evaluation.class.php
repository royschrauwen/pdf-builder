<?php
/**
 * EQUANS PDF Evaluation
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
abstract class Evaluation extends Report {
    
    protected ?string $vWorkingTitle;
    protected ?string $idReport;
    protected ?string $dtDateTime;
    protected ?string $vDepartment;
    protected ?string $vReportedByName;
    protected ?string $vReportedByPhone;
    protected ?string $vReportedByEmail;
    protected ?string $vCause;
    protected ?string $vReference;
    protected ?string $vCustomerInternal;
    protected ?string $vDescription;
    protected ?string $vNorm;
    protected ?string $vNormParagraph;
    protected ?string $vProcess;
    protected ?string $vImpactLevel;
    protected ?string $vSegment;
    protected ?string $vProjectNameNumber;
    protected ?string $vClientName;
    protected ?array  $aImages;
    protected ?string $vCauseDescription;
    protected ?string $vCauseAnalysis;
    protected ?string $vSizeAnalysis;
    protected ?string $vHowShouldBeSolved;
    protected ?string $vActionsTaken;
    protected ?string $vPlanningDate;
    protected ?array  $aFollowUpActions;
    protected ?string $vEffectiveness;

    function __construct(
        string $vWorkingTitle,
        string $idReport,
        string $dtDateTime,
        string $vDepartment,
        string $vReportedByName,
        string $vReportedByPhone,
        string $vReportedByEmail,
        string $vCause,
        string $vReference,
        string $vCustomerInternal,
        string $vDescription,
        string $vNorm,
        string $vNormParagraph,
        string $vProcess,
        string $vImpactLevel,
        string $vSegment,
        string $vProjectNameNumber,
        string $vClientName,
        array  $aImages,
        string $vCauseDescription,
        string $vCauseAnalysis,
        string $vSizeAnalysis,
        string $vHowShouldBeSolved,
        string $vActionsTaken,
        string $vPlanningDate,
        array  $aFollowUpActions,
        string $vEffectiveness
    ) {

        $this->vWorkingTitle = $vWorkingTitle;
        $this->idReport = $idReport;
        $this->vType = $vType;
        $this->dtDateTime = $dtDateTime;
        $this->vDepartment = $vDepartment;
        $this->vReportedByName = $vReportedByName;
        $this->vReportedByPhone = $vReportedByPhone;
        $this->vReportedByEmail = $vReportedByEmail;
        $this->vCause = $vCause;
        $this->vReference = $vReference;
        $this->vCustomerInternal = $vCustomerInternal;
        $this->vDescription = $vDescription;
        $this->vNorm = $vNorm;
        $this->vNormParagraph = $vNormParagraph;
        $this->vProcess = $vProcess;
        $this->vImpactLevel = $vImpactLevel;
        $this->vSegment = $vSegment;
        $this->vProjectNameNumber = $vProjectNameNumber;
        $this->vClientName = $vClientName;
        $this->aImages = $aImages;
        $this->vCauseDescription = $vCauseDescription;
        $this->vCauseAnalysis = $vCauseAnalysis;
        $this->vSizeAnalysis = $vSizeAnalysis;
        $this->vHowShouldBeSolved = $vHowShouldBeSolved;
        $this->vActionsTaken = $vActionsTaken;
        $this->vPlanningDate = $vPlanningDate;
        $this->aFollowUpActions = $aFollowUpActions;
        $this->vEffectiveness = $vEffectiveness;

    }

    
}
?>