<?php 
/**
 * Alerts view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     API Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
?>
				<div id="content">
					<div class="content-bg">
						<!-- start alerts block -->
						<div class="big-block alerts">
                        <?php
							if ($form_error) {
							?>
							<!-- red-box -->
							<div class="red-box">
								<h3>Error!</h3>
								<ul>
									<?php
									foreach ($errors as $error_item => $error_description)
									{
									// print "<li>" . $error_description . "</li>";
									print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
									}
									?>
								</ul>
							</div>
							<?php
							}
							?>
							<?php print form::open() ?>
                            
							<h1><?php echo Kohana::lang('ui_main.alerts_get'); ?></h1>
							<h3>Ushahidi Alerts allow you to be notified of certain reports based on a location and categories and/or keywords.</h3>
                   
                   
                   <!--### Step 1: Location ###-->
                            <h2 class="s1">Select Your Location</h2>
                            
                            <div class="step-body">
                                
                                <table class="tbl-two-col"  border="0">
                                <tr>
                                    <td style="width:500px;">
                                        <div class="step-1">
                                        	<h3 style="margin-bottom:8px;">Click on the map to pin-point your location. </h3>
                                            <h2 class="hide"><?php echo Kohana::lang('ui_main.alerts_step1_select_city'); ?></h2>
                                            <p class="hide"><?php echo Kohana::lang('ui_main.alerts_place_spot'); ?></p>
                                            <div class="map">
                                                <div class="map-holder" id="divMap"></div>
                                              	<div id="mapStatus" style="width:auto; float:none; height:25px; border-top:1px solid #999; border-right:none; border-left:none; border-bottom:none;">
                                                    <p>
                                                    <span id="mapMousePosition" style="width:135px; display:block; float:left; height:25px; border-right: solid 1px #999;text-align: center; margin-right:18px;"></span>
                                                    </p>
                                                </div>
                                            
                                            
                                            </div>
                                            
                                        </div>
                                        <input type="hidden" id="alert_lat" name="alert_lat" value="<?php echo $form['alert_lat']; ?>">
                                        <input type="hidden" id="alert_lon" name="alert_lon" value="<?php echo $form['alert_lon']; ?>">
                                        
                                    </td>
                                    <td style="padding:0 0 0 18px">
                                        <h3 style="margin:23px 0 5px 0;">Don't see your location? </h3>
                                        <p><?php print form::input('location_find', 'Search for it here', ' title="City, State and/or Country" class="findtext"'); ?>
                                       	<input type="button" name="button" id="button" value="Find Location" class="btn_find" /></p>
                                        <div id="find_loading" class="report-find-loading"></div>
                                        
                                        <br />
                                        
                                        <h3 style="margin-bottom:5px;">Adjust Radius</h3>
                                        <div class="report-find-location">
                                                <select name="alert_radius" id="alert_radius">
                                                    <option value="1">1 KM</option>
                                                    <option value="5">5 KM</option>
                                                    <option value="10">10 KM</option>
                                                    <option value="20" selected="selected">20 KM</option>
                                                    <option value="50">50 KM</option>
                                                    <option value="100">100 KM</option>
                                                </select>
                                            </div>
                                        </div>
                                    
                                    </td>
                                </tr>
                                </table>
                            </div>
                            
                            <hr />
                            
                   <!--### Step 2: Preferences ###-->
                            <h2 class="s2">Set Your Alert Preferences</h2>
                            <div class="step-body">
                    	       	<h3>Select Categories<?php //echo Kohana::lang('ui_main.reports_categories'); ?></h3>
                                <div class="report_category" id="categories">
	                                <?php 
	                                $selected_categories = array();
	                                 if (!empty($form['alert_category']) && is_array($form['alert_category'])) {
	                                    $selected_categories = $form['alert_category'];
	                                }
	                                echo category::pseudo_tree_checkboxes($categories, $selected_categories, 'alert_category', 2);
	                                ?>
	                            </div>
                             </div>
                            
                            <hr />
                            
                    <!--### Step 3: How To Receive ###-->        
                            <h2 class="s3">Choose Where To Receive Alerts</h2>
                            <h2 class="hide"><?php echo Kohana::lang('ui_main.alerts_step2_send_alerts'); ?></h2>
							<div class="step-body">
                                <table class="tbl-two-col" border="0">
                                <tr>
                                    <td style="width:265px; border-right:2px solid #ccc;">
                                       <h3>
											<?php
                                                if ($form['alert_mobile_yes'] == 1) {
                                                    $checked = true;
                                                }
                                                else
                                                {
                                                    $checked = false;
                                                }
                                                print form::checkbox('alert_mobile_yes', '1', $checked);
                                            ?>
                                            <span><?php echo Kohana::lang('ui_main.alerts_mobile_phone'); ?></span>
                                        </h3>
                                        <p><?php echo Kohana::lang('ui_main.alerts_enter_mobile'); ?></p>
                                        <span><?php print form::input('alert_mobile', $form['alert_mobile'], ' class="text medium"'); ?></span>
                                    </td>
                                    <td style="padding:0 0 0 48px;">
                                        <h3>
											<?php
                                                if ($form['alert_email_yes'] == 1) {
                                                    $checked = true;
                                                }
                                                else
                                                {
                                                    $checked = false;
                                                }
                                                print form::checkbox('alert_email_yes', '1', $checked);
                                            ?>
                                            <span><?php echo Kohana::lang('ui_main.alerts_email'); ?></span>
                                        </h3>
                                        <p><?php echo Kohana::lang('ui_main.alerts_enter_email'); ?></p>
                                        <span><?php print form::input('alert_email', $form['alert_email'], ' class="text long"'); ?></span>
                                    </td>
                                </tr>
                                </table>                       
                            </div>
                            
                           <p><input id="btn-send-alerts" class="btn_submit" type="submit" value="<?php echo Kohana::lang('ui_main.alerts_btn_send'); ?>" />
                           &nbsp;&nbsp;-Or-&nbsp;&nbsp; 
                           <a href="<?php echo url::base()."alerts/confirm";?>"><?php echo Kohana::lang('ui_main.alert_confirm_previous'); ?></a></p>
							
                            <hr />
                            
							<?php print form::close(); ?>
                            
							<?php
								if ($allow_feed == 1 )
								{
							?>
							
								<div class="feed">
									<h2><?php echo Kohana::lang('ui_main.alerts_rss'); ?></h2>
									<div class="holder">
										<div class="box" style="text-align:center;">
											<a href="<?php echo url::site(); ?>feed/"><img src="<?php echo url::base(); ?>media/img/icon-feed.png" style="vertical-align: middle;" border="0"></a>&nbsp;<strong><a href="<?php echo url::site(); ?>feed/"><?php echo url::site(); ?>feed/</a></strong>
										</div>
									</div>
								</div>
							<?php
								}
							?>
						</div>
						<!-- end alerts block -->
					</div>
				</div>
			</div>
		</div>
	</div>
