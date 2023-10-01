<?php

/*
	Total Body = tb
	Total Body calculate % = tbp
	Total Combined Rating = tcr
	Monthly Compensation = mc
	Bilateral Factor = bf
*/

require_once 'data.php';

$tb = 100;
$tcr = 0;
$bf = 0;
$tbp = 0;
$final_tcr = 0;
$same_leg = false;
$same_arm = false;
$legs = 0;
$arms = 0;
$othersCom = 0;
$cdr = 0;
$body = 0;

$legs = array_merge($llegs, $rlegs);
rsort($legs);

$arms = array_merge($larms, $rarms);
rsort($arms);

/* BF for legs */
if (count($rlegs) > 0 && count($llegs) > 0) {

	foreach ($legs as $key => $leg) {
		
		if ($key > 0) {
			$tbp = (($tb * $leg) / 100);
		} else {
			$tbp = $leg;
		}

		$tb = $tb - $tbp;
		$tcr = $tcr + $tbp;

		$bf = (($tcr * 10) /100);
	}

} else {
	$others = array_merge($others, $legs);
}


/* BF for arms */
if (count($larms) > 0 && count($rarms) > 0) {

	foreach ($arms as $key => $arm) {
		
		if ($bf > 0) {
			$tbp = (($tb * $arm) / 100);
		} elseif ($key > 0 && $bf == 0) {
			$tbp = (($tb * $arm) / 100);
		} else {
			$tbp = $arm;
		}

		$tb = $tb - $tbp;
		$tcr = $tcr + $tbp;

		$bf = (($tcr * 10) /100);
	}

} else {
	$others = array_merge($others, $arms);
}


if ($bf > 0 && count($others) > 0) {
	$bf_other = round($tcr + $bf);
	array_push($others, $bf_other);	
} else {
	$final_tcr = $tcr + $bf;
} 

// rsort($others);

// others 

if ( count($others) > 0 ) {
	
	$tb = 100;
	$tcr = 0;
	$tbp = 0;	

	foreach ($others as $key => $other) {
		
		if ($key > 0 ) {
			$tbp = (($tb * $other) / 100);
		} else {
			$tbp = $other;
		}

		$tb = $tb - $tbp;
		$tcr = $tcr + $tbp;
	}

	$final_tcr = $tcr;
}

/* Round CDR */
if ($final_tcr > 100) {
	$cdr = 100;
} else {
	$cdr = round(($final_tcr / 10), 1);
	$cdr = round($cdr) * 10;
}

if ( $mStatus == 1 && $parents == 0 && $child == 0 ) {
	/* spouse */
     $addVal = $spouse[$cdr];
} elseif ( $mStatus == 1 && $parents == 1 && $child == 0 ) {
    /* spouse and 1 parent */
     $addVal = $spOnePar[$cdr];        
} elseif ( $mStatus == 1 && $parents == 2 && $child == 0 ) {
    /* spouse and 2 parents */
	$addVal = $spTwoPar[$cdr];      
} elseif ( $mStatus == 0 && $parents == 1 && $child == 0 ) {
    /* 1 parent */
	$addVal = $onePar[$cdr];      
} elseif ( $mStatus == 0 && $parents == 2 && $child == 0 ) {
    /* 2 parent */
	$addVal = $twoPar[$cdr];       
} elseif ( $mStatus == 0 && $parents == 0 && $child > 0 ) {
    /* child */
	$addVal = $Vchild[$cdr];        
} elseif ( $mStatus == 1 && $parents == 0 && $child > 0 ) {
    /* child and spouse */
	$addVal = $childSp[$cdr];     
} elseif ( $mStatus == 1 && $parents == 1 && $child > 0 ) {
    /* spouse, child and parent 1 */
	$addVal = $childSpPar[$cdr];      
} elseif ( $mStatus == 1 && $parents == 2 && $child > 0 ) {
    /* spouse, child and parent 2 */
	$addVal = $childSpTpar[$cdr];     
} elseif ( $mStatus == 0 && $parents == 1 && $child > 0 ) {
    /* child and parent */
	$addVal = $childPar[$cdr];       
} elseif ( $mStatus == 0 && $parents == 2 && $child > 0 ) {
    /* child and parent 2 */
	$addVal = $childTpar[$cdr];       
} else {
	$addVal = 0;
}

/* body part */
if ($cdr > 0 && $addVal == 0 ) {
	foreach ($other_data as $key => $other) {
		if ($key == $cdr) {
			$body = $other;
		}
	}
}

/* Additional Child */
if ( $child > 1 ) {
    $addChild = ($child - 1) * $eaChild[$cdr];
} else {
    $addChild = 0;
}

/* Additional Elder Child */
if ( $elderChild > 0 ) {
    $addElchild = $elderChild * $eaElchild[$cdr];
} else {
    $addElchild = 0;
}

/* Spouse Aid */
if ( $mStatus == 1 && $marAA == 1 ) {
    $marrAA = $spAid[$cdr];
} else {
    $marrAA = 0;
}


// $data['cdr']= $cdr;
// $data['value']= array($body, $addVal, $addChild, $addElchild, $marrAA);

$monthly_comp = $body + $addVal + $addChild + $addElchild + $marrAA;

