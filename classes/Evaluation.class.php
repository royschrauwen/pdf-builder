<?php
/**
 * EQUANS PDF Evaluation
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Evaluation extends Report {
    
    function __construct(
        protected ?string $vWorkingTitle,
        protected ?string $idReport,
        protected ?string $vType,
        protected ?string $dtDateTime,
        protected ?string $vDepartment,
        protected ?string $vReportedByName,
        protected ?string $vReportedByPhone,
        protected ?string $vReportedByEmail,
        protected ?string $vCause,
        protected ?string $vReference,
        protected ?string $vCustomerInternal,
        protected ?string $vDescription,
        protected ?string $vNorm,
        protected ?string $vNormParagraph,
        protected ?string $vProcess,
        protected ?string $vImpactLevel,
        protected ?string $vSegment,
        protected ?string $vProjectNameNumber,
        protected ?string $vClientName,
        protected ?array $aImages,
        protected ?string $vCauseDescription,
        protected ?string $vCauseAnalysis,
        protected ?string $vSizeAnalysis,
        protected ?string $vHowShouldBeSolved,
        protected ?string $vActionsTaken,
        protected ?string $vPlanningDate,
        protected ?array $aFollowUpActions,
        protected ?string $vEffectiveness
    ) {}

    
}
?>