<?php 
/**
 * Alert helper. Contains helpful functions for alert.
 * 
 * @package    Alert
 * @author     Ushahidi Team
 * @copyright  (c) 2008 Ushahidi Team
 * @license    http://www.ushahidi.com/license.html
 */


class alert_Core {

	/**
	* Verfies if the alertee requested a category for the specific incidents
	* @param array of categories
	* @param array of incident_categories
	* @returns boolean
	*/
	public static function requested_category($alert_categories, $incident_id){
		
		//If no category was requested, just assume they want them all.
		if(count($alert_categories) == 0)
			return True;
		
		//grab the incident categories for the incident
		$incident_categories = ORM::factory("incident_category")->where("incident_id",$incident_id);
		
		$in = array();
		$count = 0;
		
		foreach($alert_categories as $category){
			//get all the category ids
			$in[$count++] = ($category->category_id);
		}
		
		//Get the set of incidents that contain the alert_category.category_id for the alertee.
		if(isset($in))
			$incident_categories->in("category_id",$in);
		
		//Check to see if any incidents where returned. 
		if($incident_categories->count_all() > 0){
			return True; //alertee asked for this incident by category
		}else{
			return False; //alertee did not ask for this incident, it does not have the category they specified
		}
	}





}