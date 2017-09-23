<?php
	
	class Pushengage
	{
		private static $pushengage;
		public static $pushengage_version = '1.4.5';
		public static $database_version = 20170721;
		//Constructor Function
		public function __construct() 
		{
			//blank

		}
		
		//Init Function
		public static function init()
		{
			if ( is_null( self::$pushengage ) ) 
			{
				self::$pushengage = new self();				
				$pushengage_settings = self::pushengage_settings();
				$app_key = $pushengage_settings['appKey'];
				
				if(!$app_key)
				$app_key = $_POST['appid'];
			
				self::register_session();
			
				if($_GET['page']=='pushengage-admin')
				{
					$_SESSION['check_auth'] = Api_class::verifyUser($app_key);
				}
				
				self::add_actions();
				if ($app_key) 
				{
					$menu_active_key = true;
					
				} else {
					$menu_active_key = false;
				}
				
				if ( empty( $pushengage_settings ) || ( self::$pushengage_version !== $pushengage_settings['version'] ) ) 
				{
					self::install( $pushengage_settings );
				}
			}
			return self::$pushengage;
		}
		
		public static function print_my_inline_script() 
		{
			if ( wp_script_is( 'core', 'done' ) ) 
			{
				echo "<script>_pe.subscribe();</script>";
			}
		}
		
		//Actions Function
		public static function add_actions() 
		{		
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'pushengageDomainScripts') );
			add_action( 'wp_head', array( __CLASS__, 'print_my_inline_script') );
			add_action( 'transition_post_status', array( __CLASS__, 'sendPostNotifications' ), 10, 3 );
			
			
			if ( is_admin() ) 
			{
				add_action('init', 'register_session', 1);
				add_action( 'post_submitbox_misc_actions', array( __CLASS__, 'note_override' ) );
				add_action( 'add_meta_boxes', array( __CLASS__, 'custom_note_text' ), 10, 2 );
				add_action( 'admin_init', array( __CLASS__, 'pushengage_save_settings' ) );
				add_action( 'admin_menu', array( __CLASS__, 'admin_menu_add' ) );	
				add_action( 'save_post', array( __CLASS__, 'save_post_meta_data' ) );
			}
		}
		
		public static function pushengage_settings() 
		{
			return get_option( 'pushengage_settings' );
		}
		
		public static function pushengage_active() 
		{
			$pushengage_settings = self::pushengage_settings();
			$app_key = $pushengage_settings['appKey'];
			if ( ! empty( $app_key ) ) {
				return true;
			} else {
				return false;
			}
		}
		
		public static function note_override() 
		{
			$pushengage_settings = self::pushengage_settings();
			$app_key = $pushengage_settings['appKey'];
			
			$auto_push = $pushengage_settings['autoPush'];
			$all_post_types = $pushengage_settings['all_post_types'];
			global $post;
			$check_auth = $_SESSION['check_auth'];
			if($check_auth['block_user'])
				return false;

			if ( 'post' === $post->post_type || true === $all_post_types ) 
			{
				printf('<div style="padding-left:10px;padding-bottom:15px" id="pushengage-post-checkboxes">');
				//var_dump($post->post_status);var_dump(get_post_meta( $post->ID, '_pe_override', true ));print_r($post->ID);
				$display_segments_div = " display:none; ";
				if ( 'auto-draft' === $post->post_status ) 
				{
					if ( true === $auto_push || true === $all_post_types ) {
						printf( '<label><input type="checkbox" value="1" checked id="pushengage-override-checkbox" name="pushengage-override" style="margin: -3px 9px 0 1px;" checked onclick="selectSubscriberSegments()"/>');
						echo 'Send PushEngage Notification</label>';
						$display_segments_div = "style='display:block'";
					} else {
						printf( '<label><input type="checkbox" value="1" id="pushengage-override-checkbox" name="pushengage-override" style="margin: -3px 9px 0 1px;" onclick="selectSubscriberSegments()"/>');
						echo 'Send PushEngage Notification</label>';
					}
				}
				else 
				{
					//check for over ride and scheduled options.
					$pe_override = get_post_meta( $post->ID, '_pe_override', true );
					$pe_scheduled = get_post_meta( $post->ID, 'pe_override_scheduled', true );
					if($pe_override == '1' || $pe_scheduled == '1')
					{
						$upd_chk_box = 'checked';
						$display_segments_div = " display:block; ";
					}					
					else
					$upd_chk_box = '';
					
					printf('<label><input type="checkbox" value="1" id="pushengage-override-checkbox" name="pushengage-override" style="margin: -3px 9px 0 1px;" '.$upd_chk_box.'  onclick="selectSubscriberSegments()"/>');
					echo 'Send PushEngage Notification on Update</label>';
				} 
				//check all subscribers when click on send notification
				$draft_segments = get_post_meta( $post->ID, '_pe_draft_segments', true );
				if(!empty($draft_segments))
				{
					$draft_segments = explode(' ', $draft_segments);
				}
				echo "<script>
						function selectSubscriberSegments()
						{
							if(document.getElementById('pushengage-override-checkbox').checked == true)
							{
								var drft_seg ='".$draft_segments."';
								if(!drft_seg)
								document.getElementById('selectall').checked=true;
								document.getElementById('pushengage-post-categories').style.display = 'block';
							}
							else
							{
								
							document.getElementById('selectall').checked=false;	document.getElementById('pushengage-post-categories').style.display = 'none'; 
							}
						}
					  </script>
					 ";
				wp_nonce_field( 'pushengage_save_post', 'hidden_pe' );
				echo '</div>';
					$segmets_data = Api_class::getSegments($app_key);
					
					if(!empty($segmets_data["segments"]))
					{
						$pe_override = get_post_meta( $post->ID, '_pe_override', true );
						
						if($auto_push || $all_post_types || empty($draft_segments))
							$check ="checked";
						else
							$check ="";
						
						if($post->post_status == 'auto-draft' && ($auto_push || $all_post_types))
						$check ='checked';
					
						printf('<div style="padding-left:37px;padding-top:0px;padding-bottom:10px;'.$display_segments_div.'" id="pushengage-post-categories"><span style="font-weight:bold;">Select PushEngage Segments</span>');					
						//echo "<pre>";print_r($segmets_data);echo "</pre>";exit;
						echo '<br><input type="checkbox" id="selectall" '. $check.' onclick="selectAll();"><span  style="margin-left:10px;">All Subscribers</span>';
						foreach($segmets_data["segments"] as $segment)
						{
							if(!empty($draft_segments) && in_array($segment["segment_id"], $draft_segments))
							$seg_chk_box = ' checked ';
							else
							$seg_chk_box = '';

							if(!empty($segment["segment_name"]))
							{
								echo '<div style="margin:5px 10px 5px 0px !important;"><input type="checkbox"   '.$seg_chk_box.'class="pushengage-segments" onclick="selectAllSubscribers()" name="pushengage-categories[]" value="'.$segment["segment_id"].'" ><span style="margin-left:10px;">'.$segment["segment_name"].'</span></div>';
							}							
						}
						echo '</div>';
						echo '<script>
						function selectAll()
						{
							var all_cb = document.getElementById("selectall").checked;
							var pe_segments = document.getElementsByClassName("pushengage-segments");

							for (var key in pe_segments) 
							{
							  if (pe_segments.hasOwnProperty(key)) 
							  {
								if(all_cb)
								{
									pe_segments[key].checked = false;
								}
								else
								{
									pe_segments[key].checked = true;
								}
							  }
							}
						}
						
						function selectAllSubscribers()
						{
							var pe_segments = document.getElementsByClassName("pushengage-segments");
							var check_flag = false;
							for (var key in pe_segments) 
							{
								if(pe_segments[key].checked == true)
								check_flag = true;
							}
							if(check_flag==false)
							{
								document.getElementById("selectall").checked = true;
							}
							else
							{
								document.getElementById("selectall").checked = false;
							}
						}
						
						</script>';
					}

			}
		}

		public static function custom_note_text( $post_type, $post ) 
		{
			$pushengage_settings = self::pushengage_settings();
			$all_post_types = $pushengage_settings['all_post_types'];
			if ( 'post' === $post_type || true === $all_post_types ) {
				if ( 'attachment' !== $post_type && 'comment' !== $post_type && 'dashboard' !== $post_type && 'link' !== $post_type ) {
					add_meta_box(
						'pushengage_meta',
						'Custom Notification Title',
						array( __CLASS__, 'pushengage_custom_headline_content' ),
						'',
						'normal',
						'high'
					);
				}
			}
		}

		public static function pushengage_custom_headline_content( $post ) 
		{
			$custom_note_text = get_post_meta( $post->ID, '_pushengage_custom_text', true );
			?>
			<div id="pushengage-custom-note" class="form-field form-required">
				<input type="text" id="pushengage-custom-note-text" maxlength="73" placeholder="Enter Custom Headline For Your Notification" name="pushengage-custom-msg" value="<?php echo ! empty( $custom_note_text ) ? esc_attr( $custom_note_text ) : ''; ?>" /><br>
				<span id="pushengage-custom-note-text-description" >Custom headline limit 73 characters.<br/>When using a custom headline, this text will be used in place of the default blog post title for your push notification.</span>
			</div>
		<?php
		}
		
		public static function pushengage_save_settings() 
		{
			
			if ( isset( $_POST['save-settings'] ) ) 
			{
				
				
				$pushengage_settings = self::pushengage_settings();
				$app_key = $pushengage_settings['appKey'];
				$auto_push = false;
				$bbPress = false;
				$prompt_min = false;
				$prompt_visits = 2;
				$prompt_event = false;
				$non_pushengage_categories = array();
				$segment_send = false;
				$use_custom_script = false;
				$custom_script = '';
				$use_featured_image = false;
				$all_post_types = false;
				$utmcheckbox=false;
				$utm_medium = '';
				$utm_campaign =	'';
				$utm_source	= '';
				
				if($app_key!=$_POST['pushengage-apikey'])
				{
					$result = self::getSiteData($_POST['pushengage-apikey']);
					if(isset($result[0]['site_id']))
					{
						$app_key = $_POST['pushengage-apikey'];
					}
				}

				if ( isset( $_POST['pushengage-auto-push'] ) ) {
					$auto_push = true;
				}
				if ( isset( $_POST['bbPress'] ) ) {
					$bbPress = true;
				}
				if ( isset( $_POST['pushengage-prompt-min'] ) ) {
					$prompt_min = true;
				}
				if ( isset( $_POST['pushengage-prompt-visits'] ) ) {
					if ( '0' === $_POST['pushengage-prompt-visits'] || '1' === $_POST['pushengage-prompt-visits'] ) {
						$prompt_visits = 2;
					} else {
						$prompt_visits = sanitize_text_field( $_POST['pushengage-prompt-visits'] );
					}
				}
				if ( isset( $_POST['pushengage-prompt-event'] ) ) {
					$prompt_event = true;
				}
				if ( isset( $_POST['pushengage-categories'] ) ) {
					$non_pushengage_categories = array_map( sanitize_text_field, $_POST['pushengage-categories'] );
				}
				if ( isset( $_POST['pushengage-segment-send'] ) ) {
					$segment_send = true;
				}
				if ( isset( $_POST['pushengage-custom-image'] ) ) {
					$use_featured_image = true;
				}
				if ( isset( $_POST['pushengage-require-interaction'] ) ) {
					$use_require_interaction = true;
				}
				if ( isset( $_POST['pushengage-all-post-types'] ) ) {
					$all_post_types = true;
				}
				if ( isset( $_POST['pushengage-use-custom-script'] ) ) {
					$use_custom_script = true;
				}
				if ( isset( $_POST['utmcheckbox'] ) ) 
				{
					$utmcheckbox = true;
					if ( isset( $_POST['utm_source'] ) ) {
					$utm_source = $_POST['utm_source'];
					}
					if ( isset( $_POST['utm_medium'] ) ) {
						$utm_medium = $_POST['utm_medium'];
					}
					if ( isset( $_POST['utm_campaign'] ) ) {
						$utm_campaign = $_POST['utm_campaign'];
					}
				}

				$custom_script = esc_html( $_POST['pushengage-custom-script'] );

				$form_data = array(
					'app_key' => $app_key,
					'auto_push' => $auto_push,
					'bbPress' => $bbPress,
					'prompt_min' => $prompt_min,
					'prompt_visits' => $prompt_visits,
					'prompt_event' => $prompt_event,
					'categories' => $non_pushengage_categories,
					'segment_send' => $segment_send,
					'use_custom_script' => $use_custom_script,
					'custom_script' => $custom_script,
					'use_featured_image' => $use_featured_image,
					'use_require_interaction' => $use_require_interaction,
					'utmcheckbox' => $utmcheckbox,
					'utm_source' => $utm_source,
					'utm_medium' => $utm_medium,
					'utm_campaign' => $utm_campaign,
					'all_post_types' => $all_post_types,
				);

				self::update_settings( $form_data );
				$status = base64_encode('success');
				$status = urlencode( $status );
				wp_redirect( esc_url_raw( admin_url( 'admin.php?page=pushengage-admin' ) . '&status=' . $status ));
				exit;
			}
		}
		
		public static function install( $pushengage_settings ) 
		{
			if ( empty( $pushengage_settings ) ) 
			{
				$pushengage_settings = array(
					'appKey' => '',
					'appSecret' => '',
					'version' => self::$pushengage_version,
					'autoPush' => true,
					'bbPress' => true,
					'database_version' => self::$database_version,
					'prompt_min' => false,
					'prompt_visits' => 2,
					'prompt_event' => false,
					'categories' => array(),
					'segment_send' => false,
					'use_custom_script' => false,
					'custom_script' => '',
					'chrome_error_dismiss' => false,
					'gcm_token' => '',
					'use_featured_image' => true,
					'use_require_interaction' => true,
					'all_post_types' => true,
				);
				add_option( 'pushengage_settings', $pushengage_settings );
			}
			if ( self::$pushengage_version !== $pushengage_version['version'] ) 
			{
				self::update( $pushengage_settings );
			}
		}
		
		public static function update( $pushengage_settings ) 
		{
			$pushengage_settings['version'] = self::$pushengage_version;
			if(!$pushengage_settings['site_name'])
			{
				if(isset($_SESSION['appdata']['site_name']) && !empty($_SESSION['appdata']['site_name']))
				$pushengage_settings['site_name'] = $_SESSION['appdata']['site_name'];
				else
				{
					$appdata = Api_class::getSiteinfo($_POST['appid']);
					$appdata = $appdata[0];
					
					if(isset($appdata['site_name']) && !empty($appdata['site_name']))
					$pushengage_settings['site_name'] = $appdata['site_name'];
				}
			}			
			update_option( 'pushengage_settings', $pushengage_settings );
		}
		
		public static function admin_menu_add()
		{
			$pushengage_settings = self::pushengage_settings();
			$app_key = $pushengage_settings['appKey'];
			
			add_menu_page(
				'Pushengage',
				'PushEngage',
				'manage_options',
				'pushengage-admin',
				array( __CLASS__, 'admin_menu_page' ),
				PUSHENGAGE_URL . 'images/pe_logo.png'
			);		
		}

		public static function admin_menu_page() 
		{
			$pushengage_settings = self::pushengage_settings();
			$app_key = $pushengage_settings['appKey'];
			$cat_args = array(
				'hide_empty' => 0,
				'order' => 'ASC'
			);
			$cats = get_categories( $cat_args );

			if(isset($_POST['appid']) && $_POST['appid'])
			{	$tab_start="setup";
				$appdata = Api_class::getSiteinfo($_POST['appid']);
				$appdata = $appdata[0];
				$_SESSION['appdata'] = $appdata;

				if(!empty($appdata))
				{
					$pushengage_settings['appKey'] = $_POST['appid'];
					
					if($appdata['site_name'])
					$pushengage_settings['site_name'] = $appdata['site_name'];

					if($appdata['site_id'])
					$pushengage_settings['site_id'] = $appdata['site_id'];
					
					self::update($pushengage_settings);
					$pushengage_settings = self::pushengage_settings();
					$app_key = $pushengage_settings['appKey'];
					
				}
				else
				{
					$status = "faild";
					$menu_active_key = false;
				}
			}
			
			if($app_key)
			{				
				if(empty($_SESSION['appdata']))
				{
					//Site Info
					$appdata = Api_class::getSiteinfo($app_key);
					$appdata = $appdata[0];
					$_SESSION['appdata'] = $appdata;					
				}
				
				if(($_GET['tab'] == 'gSettings' || $_GET['tab'] == '') && $_GET['page']=='pushengage-admin')
				{					
					//Subscription Plan Info
					$sub_data = Api_class::getSubcriptionPlans($app_key, $appdata['current_plan']);
					$sub_data = $sub_data[0];
					$_SESSION['sub_data'] = $sub_data;
				
					//Active subscribers count from node
					$active_subscriber = Api_class::getActiveSubscriberFromNode($app_key);
					$active_subscriber = json_decode($active_subscriber,true);
					$active_subscriber=$active_subscriber['data']['count'];
					$_SESSION['active_subscriber'] = $active_subscriber;	
				}
				
				if($_GET['tab'] == 'subDialogbox' && empty($_SESSION['optin_settings_data']))
				{
					$optin_settings_data = Api_class::getOptinSettings($app_key, $_SESSION['appdata']['site_id']);
					$optin_settings_data = json_decode($optin_settings_data[0]['optin_settings']);
					$_SESSION['optin_settings_data'] = $optin_settings_data;
					$set_site_type = $site_type['site_type'];
				}

				if($_GET['tab'] == 'subDialogbox')
				{
					$segments_data = Api_class::getSegments($app_key);
					$segments_data = $segments_data['segments'];
				}

				if($_GET['tab'] == 'subDialogbox' && empty($_SESSION['site_type']))
				{
					$site_type = Api_class::getSiteType($app_key); 
					$set_site_type = $site_type['site_type'];
					$_SESSION['site_type'] = $site_type;
				}
				//echo "<pre>";print_r($_SESSION['optin_settings_data']);	exit;
				if ($_POST['action']=="update_optin_settings")
				{
					$tab = "subDialogbox";
					if(isset($_POST['plan-switch']) && $_POST['plan-switch'] == "on")
					{
						if(isset($_POST['optin_sw_support']) && $_POST['optin_sw_support'] == "on" && !in_array($_POST['optin_type'], array(4,5)))
						{
							$quick_install = false;
						}
						else
						{
							$quick_install = true;
						}

						$optindata = array(
							'desktop'=> array(
								'http' =>$_SESSION['optin_settings_data']->desktop->http,
								'https' =>array( 'optin_delay' => $_POST['optin_delay'],'optin_type' => $_POST['optin_type'],'optin_title' => $_POST['optin_title'],'optin_allow_btn_txt' => $_POST['optin_allow_btn_txt'],'optin_close_btn_txt' => $_POST['optin_close_btn_txt'],'optin_font' =>'', 'optin_sw_support'=>$quick_install, 'optin_segments'=>json_encode($_POST['segments'])
					 		)
								),'mobile' =>'','intermediate'=>$_SESSION['optin_settings_data']->intermediate
							);
					}
					else{
						$optindata = array(
							'desktop'=> array(
								'http' =>array( 'optin_delay' => $_POST['optin_delay'],'optin_type' => $_POST['optin_type'],'optin_title' => $_POST['optin_title'],'optin_allow_btn_txt' => $_POST['optin_allow_btn_txt'],'optin_close_btn_txt' => $_POST['optin_close_btn_txt'],'optin_font' =>'','optin_segments'=>json_encode($_POST['segments'])
					 		),
								'https' => $_SESSION['optin_settings_data']->desktop->https
								),'mobile' =>'','intermediate'=>$_SESSION['optin_settings_data']->intermediate
							);
					}

					$data = array(
									'site_id'		=>	$_SESSION['appdata']['site_id'],
									'type'			=>	'update_optin_settings',
									'option_data'	=>	$optindata
								);
					$appdata = Api_class::updateOptinSettings($app_key, $data);
					if(isset($_POST['plan-switch']) && $_POST['plan-switch'] == "on")
					{
						$updateSiteTypeData = array(
							'type'          => 'update_pe_options',
							'site_type'     => 'https'
							);
					}
					else{
						$updateSiteTypeData = array(
							'type'          => 'update_pe_options',
							'site_type'     => 'http'
							);
					}
					Api_class::updateSiteType($app_key,$updateSiteTypeData);
					$_SESSION['appdata']['optin_settings'] = json_encode($optindata);
					$_SESSION['optin_settings_data'] = json_decode(json_encode($optindata));
					$_SESSION['site_type'] = array('site_type' => $updateSiteTypeData['site_type']);
				}
				
				if ($_POST['action']=="update_optin_page_settings")
				{
					$tab = "subDialogbox";
					$optindata = array('desktop' => $_SESSION['optin_settings_data']->desktop,'mobile'=>$_SESSION['optin_settings_data']->mobile,'intermediate'=> array('page_heading' => $_POST['page_heading'], 'page_tagline'=>$_POST['page_tagline'])); 
					$data = array(
									'site_id'		=>	$_SESSION['appdata']['site_id'],
									'type'			=>	'update_optin_settings',
									'option_data'	=>	$optindata
								);
					$result = Api_class::updateOptinSettings($app_key, $data);
					//echo "<pre>";print_r($result);exit;
					$_SESSION['appdata']['optin_settings'] = json_encode($optindata);
					$_SESSION['optin_settings_data'] = json_decode(json_encode($optindata));
				}

				// welcome notification settings
				if ($_POST['action']=="save_welcome_notification")
				{
					$tab = "welcome_notification";					
					if(isset($_POST['welcome_enabled']))
					{	if($_POST['welcome_enabled']=="true") 
						$welcome_enabled = "true";
						else
						$welcome_enabled = "false";
					}
					$data = array(
									'site_id'	=> $_SESSION['appdata']['site_id'],
									'type'		=> 'update_welcome_notification',
									'notification_title'	=> $_POST['notification_title'],
									'notification_message'	=> $_POST['notification_message'],
									'notification_url'	=> $_POST['display_notification_url'],
									'welcome_enabled'	=> $welcome_enabled
								);
					$welcome_note_data = Api_class::updateWelcomeNotification($app_key, $data); 
					$wc_data = array(
										'notification_title' => $_POST['notification_title'],
										'notification_message' => $_POST['notification_message'],
										'notification_url' => $_POST['display_notification_url'],
										'welcome_enabled' => $welcome_enabled
									);
					$_SESSION['welcome_note_data'] = (object)$wc_data;
				 }
				if($_GET['tab'] == 'welcome_notification' && empty($_SESSION['welcome_note_data']))
				{
					$welcome_note_data = Api_class::getWelcomeNotification($app_key, $_SESSION['appdata']['site_id']);
					$_SESSION['welcome_note_data'] = $welcome_note_data;
				}
				// installation settings
				if($_GET['tab'] == 'insSettings' && empty($_SESSION['userdata']))
				{
					$userdata = Api_class::getUserinfo($app_key, $_SESSION['appdata']['site_id']);
					$userdata = $userdata[0];
					$_SESSION['userdata'] = $userdata;
				}
				if($_GET['tab'] == 'insSettings' && empty($_SESSION['timezone']))
				{
					$timezonedata = Api_class::getTimezoneInfo($app_key, $_SESSION['appdata']['site_id']);
					$timezone = $timezonedata[0]['option_value'];
					$_SESSION['timezone'] = $timezone;
				}
				if ($_POST['action']=="update_site_settings")
				{
					$tab = "insSettings";

					$data = array(
									'site_id'                 => $_SESSION['appdata']['site_id'],
									'type'	                  => 'update_site_settings',
									'site_name'	          => $_POST['site_name'],
									'site_url'	          => $_POST['site_url'],
									'max_notifications'	  => $_POST['max_notifications']
								);
					$result = Api_class::updateSiteSettings($app_key, $data);
					//echo "<pre>".$app_key;print_r($result);exit;
					$_SESSION['appdata']['site_name'] = $_POST['site_name'];
					$_SESSION['appdata']['site_url'] = $_POST['site_url'];
					$_SESSION['appdata']['max_notifications'] = $_POST['max_notifications'];
					
					if(!empty($_SESSION['appdata']['site_name']))
					{
						$pushengage_settings['site_name'] = $_SESSION['appdata']['site_name'];
					
						self::update($pushengage_settings);
					}
				}
				
				if ($_POST['action']=="update_profile")
				{
					$tab = "insSettings";
					$data = array(
									'site_id' => $_SESSION['appdata']['site_id'],
									'type'	  => 'update_profile_settings',
									'user_name'	  => $_POST['user_name'],
									'password'	  => $_POST['password'],
									'new_password'	  => $_POST['new_password'],
									'timezones'	  => $_POST['timezones']
								);
					$result = Api_class::updateProfileSettings($app_key, $data);
					//print_r($result);exit;
					$_SESSION['userdata']['user_name'] = $_POST['user_name'];
					$_SESSION['timezone'] = $_POST['timezones'];
				}
				
				if($_GET['tab'] == 'gcmSettings' && empty($_SESSION['gcmdata']))
				{
					//gcm settings
					$gcmdata = Api_class::getGCMSettings($app_key, $_SESSION['appdata']['site_id']);
					$_SESSION['gcmdata'] = $gcmdata;
				}
				
				if(isset($_POST['verify_gcm'])) 
				{
					$tab = "gcmSettings"; 
					$data = array('gcm_api_key'=>$_POST['gcm_api_key'],'type'=>'verify_gcm');
					$verify_gcm_result = Api_class::verifyGCM($app_key, $data);
				}		
				else if ($_POST['action']=="update_gcm_settings") 
				{    
					$tab = "gcmSettings"; 
					$error_message = "";
					if(is_numeric($_POST['gcm_project_key']))
					{
						$data = array('gcm_project_key'=>$_POST['gcm_project_key'],'gcm_api_key'=>$_POST['gcm_api_key']);
					
						$result = Api_class::updateGcmSettings($app_key, $_SESSION['appdata']['site_id'], $data);

						$verify_gcm_result['banner'] = 'GCM settings updated successfully';
						
						 $gcmdata = array(
											'gcm_project_key' => $_POST['gcm_project_key'],
											'gcm_api_key'	=> $_POST['gcm_api_key']
										);
						$_SESSION['gcmdata'] = (object)$gcmdata;						
					}   
					else
					{
						echo $error_message = "GCM project key should be a number.";
					} 
				}

				$menu_active_key=true;
			}
			//echo "<pre>";print_r($_SESSION['check_auth']);
			if(!empty($_SESSION) && isset($_SESSION['check_auth']['success']))
				$menu_active_key =false;
			require_once( PUSHENGAGE_PLUGIN_DIR . '/views/admin.php' );
		}
		
		public static function getSiteData($app_key)
		{
			$sitedata = Api_class::getSiteinfo($app_key);
			
			return $sitedata;
		}
		
		public static function update_settings($form_data)
		{
			if(!empty($form_data))
			{
				$pushengage_settings = self::pushengage_settings();
				$pushengage_settings['appKey'] = $form_data['app_key'];
				$pushengage_settings['autoPush'] = $form_data['auto_push'];
				$pushengage_settings['prompt_min'] = $form_data['prompt_min'];
				$pushengage_settings['prompt_visits'] = $form_data['prompt_visits'];
				$pushengage_settings['prompt_event'] = $form_data['prompt_event'];
				$pushengage_settings['categories'] = $form_data['categories'];
				$pushengage_settings['segment_send'] = $form_data['segment_send'];
				$pushengage_settings['use_custom_script'] = $form_data['use_custom_script'];
				$pushengage_settings['custom_script'] = $form_data['custom_script'];
				$pushengage_settings['use_featured_image'] = $form_data['use_featured_image'];
				$pushengage_settings['use_require_interaction'] = $form_data['use_require_interaction'];
				$pushengage_settings['utmcheckbox'] = $form_data['utmcheckbox'];
				$pushengage_settings['use_require_interaction'] = $form_data['use_require_interaction'];
				$pushengage_settings['utm_source'] = $form_data['utm_source'];
				$pushengage_settings['utm_medium'] = $form_data['utm_medium'];
				$pushengage_settings['utm_campaign'] = $form_data['utm_campaign'];
				$pushengage_settings['all_post_types'] = $form_data['all_post_types'];
				update_option('pushengage_settings', $pushengage_settings);
			}			
		}
		
		public static function pushengageDomainScripts()
		{
			$pushengage_settings = self::pushengage_settings();
			$app_key = $pushengage_settings['appKey'];
			
			$appdata = Api_class::getSiteinfo($app_key);
			$appdata = $appdata[0];

			if($pushengage_settings['site_id'])
			$site_id = $pushengage_settings['site_id'];
			else
			$site_id = $appdata['site_id'];

			$pe_dynemic_js = '//clientcdn.pushengage.com/core/'.$site_id.'.js';
			
			if($app_key && isset($site_id))
			{
				wp_enqueue_script( 'core', $pe_dynemic_js, array('jquery'),  "",  false );
			}
			
		}

		
		 public static function save_post_meta_data( $post_id ) 
		 {
			
			if (! current_user_can( 'edit_posts' ) ) 
			{
				return false;
			} 
			else 
			{
				$no_note = get_post_meta( $post_id, '_pe_override', true );
				if ( isset( $_POST['pushengage-override'] ) && ! $no_note ) 
				{
					$override_setting = sanitize_text_field( $_POST['pushengage-override'] );
					add_post_meta( $post_id, '_pe_override', $override_setting, true );
				} 
				elseif ( ! isset( $_POST['pushengage-override'] ) && $no_note ) 
				{
					delete_post_meta( $post_id, '_pe_override' );
				}
				if ( isset( $_POST['pushengage-custom-msg'] ) ) {
					update_post_meta( $post_id, '_pushengage_custom_text', sanitize_text_field( $_POST['pushengage-custom-msg'] ) );
				}
				if(isset($_POST['pushengage-override']))
				{
					if(!empty( $_POST['pushengage-categories'] ))
					{
						$draft_segments = implode(" ",$_POST['pushengage-categories']);
						$prev_segments = get_post_meta( $post_id, '_pe_draft_segments', true );
						update_post_meta( $post_id, '_pe_draft_segments', $draft_segments, $prev_segments );
					}
					else
					{
						delete_post_meta($post_id, '_pe_draft_segments');
					}
					
					
					$str = "";
					if ( isset($_POST['pushengage-categories']) && !empty( $_POST['pushengage-categories'] ) && (get_post_status( $post_id ) == 'future' || get_post_status( $post_id ) == 'inherit') ) 
					{
						$str = implode(" ",$_POST['pushengage-categories']);
						add_post_meta( $post_id, '_sedule_notification', $str, true );
					}
					add_post_meta( $post_id, 'pe_override_scheduled', 1, true );
				}
				else
				{
					delete_post_meta($post_id, '_pe_draft_segments');
					delete_post_meta($post_id, '_sedule_notification');
					delete_post_meta($post_id, 'pe_override_scheduled');
				}
			}
		}
		
		public static function sendPostNotifications( $new_status, $old_status, $post ) 
		{
			if ( false === self::pushengage_active() ) {
				return;
			}
			if ( empty( $post ) ) {
				return;
			}
			if ( ! current_user_can( 'publish_posts' ) && ! DOING_CRON  ) {
				return;
			}
				
			$pushengage_settings = self::pushengage_settings();
			$app_key = $pushengage_settings['appKey'];
			$all_post_types = $pushengage_settings['all_post_types'];
			
			$appdata = $_SESSION['appdata'];
			
			$post_id = $post->ID;
			$post_type = get_post_type( $post );

			if ( false === $all_post_types ) 
			{
				if ( 'post' !== $post_type ) {
					return;
				}
			}
//echo 'new status: '.$new_status.'<br> old status: '.$old_status;exit;
			if ( 'publish' === $new_status  ) 
			{
				if ( isset( $_POST['pushengage-override'] ) ) {
					$send_note = true;
				}
			}
			if('publish' === $new_status && 'future' === $old_status)
			{
				if(get_post_meta( $post_id, 'pe_override_scheduled', true ))
					$send_note = true;
			}
			if ( $new_status !== $old_status || ! empty( $send_note ) ) 
			{ 
				if ( 'publish' === $new_status ) 
				{
					$categories = get_the_category( $post_id );
					$auto_push = $pushengage_settings['autoPush'];
					$non_pe_categories = $pushengage_settings['categories'];
					$segment_send = $pushengage_settings['segment_send'];
					$use_featured_image = $pushengage_settings['use_featured_image'];
					$segments = null;
					$image_url = null;

					if ( ( 'publish' === $new_status && 'future' === $old_status )) 
					{
						$override = get_post_meta( $post_id, '_pe_override', true );
						$custom_headline = get_post_meta( $post_id, '_pushengage_custom_text', true );
						$segments=explode(" ",get_post_meta( $post_id, '_sedule_notification', true ));
						$seg_array = array_filter($segments);
						if(empty($seg_array))
						$segments=false;
					}
					else 
					{
						if ( isset( $_POST['pushengage-override'] ) ) {
							$override = sanitize_text_field( $_POST['pushengage-override'] );
						}
						if ( isset( $_POST['pushengage-custom-msg'] ) && ! empty( $_POST['pushengage-custom-msg'] ) ) {
							$custom_headline = sanitize_text_field( $_POST['pushengage-custom-msg'] );
						}
					}
					if($pushengage_settings['use_require_interaction'])
					{
						$adv_options['require_interaction'] = true;
					}
					else
					{
						$adv_options['require_interaction'] = '0';
					}
					if ( $send_note ) 
					{
						
						if ( !empty( $override ) ) 
						{
							if ( isset($_POST['pushengage-categories']) && !empty( $_POST['pushengage-categories'] ) ) 
							{
								$segments = $_POST['pushengage-categories'];
							}
							if ( ! empty( $custom_headline ) ) {
								$note_text = stripslashes( $custom_headline ) ;
							} else {
								$note_text = sanitize_text_field(substr(get_the_title( $post_id ),0,72));
							}
							$note_link = get_permalink( $post_id );
							if ( $use_featured_image ) {
								if ( has_post_thumbnail( $post_id ) ) {
									$raw_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) );
									$image_url = $raw_image[0];
								}
							}
							
							//add UTM params for link
							if(isset($pushengage_settings['utmcheckbox'])&& !empty($pushengage_settings['utmcheckbox']) && isset($pushengage_settings['utm_source']) && isset($pushengage_settings['utm_medium']) && isset($pushengage_settings['utm_campaign'])){

								$note_link_temp = '?utm_source='.$pushengage_settings['utm_source'].'&utm_medium='.$pushengage_settings['utm_medium'].'&utm_campaign='.$pushengage_settings['utm_campaign'];
								$note_link .= $note_link_temp;
							}
							else
							$note_link .= '?utm_source=pushengage&utm_medium=push_notification&utm_campaign=pushengage';
							
							
							if(empty($appdata['site_name']))
							$appdata['site_name'] = $pushengage_settings['site_name'];
						
						//echo "<pre>".$note_text.'<br>'.$note_link.'<br>'.$appdata['site_name'].$send_note;print_r($segments);die;
							
							$result = Api_class::send_notification( $note_text, $note_link, $app_key, $appdata['site_name'], $segments, $image_url, $adv_options );
						}
					}
				}
			}
		}
		
		public static function filter_string( $string ) 
		{
			$string = str_replace( '&#8220;', '&quot;', $string );
			$string = str_replace( '&#8221;', '&quot;', $string );
			$string = str_replace( '&#8216;', '&#39;', $string );
			$string = str_replace( '&#8217;', '&#39;', $string );
			$string = str_replace( '&#8211;', '-', $string );
			$string = str_replace( '&#8212;', '-', $string );
			$string = str_replace( '&#8242;', '&#39;', $string );
			$string = str_replace( '&#8230;', '...', $string );
			$string = str_replace( '&prime;', '&#39;', $string );

			return html_entity_decode( $string, ENT_QUOTES );
		}
		
		public static function chekAPIKey()
		{
			$pushengage_settings = self::pushengage_settings();
			$app_key = $pushengage_settings['appKey'];
			if($app_key)
			return true;
			else
			return false;
		}
		
		public function register_session()
		{
			if(!session_id())
			{								
				session_start();
			}				
		}
	}
?>
