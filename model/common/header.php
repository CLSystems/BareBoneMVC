<?php
/**
 * Model class Header for SilverJet BareBone.
 *
 * @package BareBone\Model\Common 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCommonHeader extends Model {
	/**
	 * Function to generate the VIS-special header-links for the seasons
	 *
	 * @level public
	 * @param string $sn The current/selected season
	 * @param array $aSeasons The seasons-array that will be searched
	 * @param string $token Security token
	 *
	 * @return string HTML-string to be used within UL tags
	 *
	 */	
	public function CheckSeason($sn, $aSeasons, $token) {
		$s = '';
		foreach($aSeasons as $k => $v) { 
			if ($sn==$k){
			  $s.= '<li><a><font color=yellow>'.$v.'</font></a></li>';
			}else{
			  $s.='<li><a href="index.php?route=vis/aroutes&token='.$token.'&setseason='.$k.'">'.$v.'</a></li>';
			}
		}
		return $s;
	}



}
?>