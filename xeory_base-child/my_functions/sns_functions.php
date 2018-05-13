<?php
function get_twitter_ID($categoryID){
	switch($categoryID){

		//		ふぇ
		case 7:
		return "fe_gsdt";

		// 		Willogy
		case 10:
		return "toseethe_world";		
		
		// 		bit penguin
		case 11:
		return "Blockchain_UT";
		
		// 		Pass on
		case 19:
		return "pass_on_pr";
		
		//		Get Will
		case 20:
		break;

		//		CR_ASH
		case 21:
		return "IoT_creator";
			
		//		夜明け
		case 23:
		return "buzz_creators_";
		
		// 		OSCE
		case 24:
		return "OSCcccE";
		
		//		Curogames
		case 25:
		return "curogames0304";

		
		// 		Hope
		case 26:
		return "EduCollegeJomo";

		//		生類生類憐れみの令
		case 27:
		return "awaremi_";
		
		// 		BALLIFE
		case 28:
		return "ball_in_life_";
	}
	return "";
}
?>