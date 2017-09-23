<?php

	class Api_class
	{	
		public static function remote_request( $remote_data ) 
		{
			$remote_url = 'https://api.pushengage.com/apiv1/' . $remote_data['action'];
			//$remote_url = 'http://localhost/pushengage/apiv1/' . $remote_data['action'];

			$headers = array(
				'api_key'		=> $remote_data['api_key'],
				"Content-Type"	=> 'application/x-www-form-urlencoded',
			);

			//Adding source for api calls
			$remote_data['remoteContent']['source'] = 'Wordpress';
			$remote_array = array(
				'method'    => $remote_data['method'],
				'headers'   => $headers,
				'body'      => $remote_data['remoteContent'],
			);

			$response = wp_remote_request( esc_url_raw( $remote_url ), $remote_array );
			
			return $response;
		}
	
		public static function decode_request( $remote_data ) 
		{
			$xfer = self::remote_request( $remote_data );
			$nxfer = wp_remote_retrieve_body( $xfer );
			$lxfer = json_decode( $nxfer, true );
			return $lxfer;
		}
		
		public static function getSiteinfo($appid)
		{		
			$request_data = array("api_key"=>$appid,
								  "action"=>'info?type=siteinfo',
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$site_data = self::decode_request($request_data);
			//echo "<pre>";print_r($site_data);exit;
			return $site_data;
		}
		
		public static function getUserinfo($appid, $site_id)
		{		
			$request_data = array("api_key"=>$appid,
								  "action"=>'users?type=userinfo&site_id='.$site_id,
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$user_data = self::decode_request($request_data);
			//echo "<pre>".$site_id;print_r($user_data);exit;
			return $user_data;
		}
		
		public static function getGCMSettings($appid, $site_id)
		{		
			$request_data = array("api_key"=>$appid,
								  "action"=>'users?type=gcm_settings&site_id='.$site_id,
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$gcm_data = self::decode_request($request_data);
			$gcm_data =json_decode($gcm_data[0]['option_value']);
			//echo "<pre>".$site_id;print_r($gcm_data);exit;
			return $gcm_data;
		}
		
		public static function getWelcomeNotification($appid, $site_id)
		{		
			$request_data = array("api_key"=>$appid,
								  "action"=>'users?type=get_welcome_notification&site_id='.$site_id,
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$welcome_note_data = self::decode_request($request_data);
			$welcome_note_data =json_decode($welcome_note_data[0]['option_value']);
			//echo "<pre>".$site_id;print_r($gcm_data);exit;
			return $welcome_note_data;
		}
		
		public static function updateGCMSettings($appid, $site_id, $data)
		{		
			$remote_array = $data;
			$remote_array['site_id'] = $site_id;
			$remote_array['type'] = 'update_gcm';
			
			$request_data = array("api_key"=>$appid,
								  "action"=>'users',
								  "method"=>"POST",
								  "remoteContent"=>$remote_array,
								 );
			//echo "<pre>";print_r($request_data);exit;
			$gcm_data = self::decode_request($request_data);
			
			return $gcm_data;
		}
		
		public static function updateWelcomeNotification($appid, $data)
		{		
			$remote_array = $data;
			
			$request_data = array("api_key"=>$appid,
								  "action"=>'users',
								  "method"=>"POST",
								  "remoteContent"=>$remote_array,
								 );
			//echo "<pre>";print_r($request_data);exit;
			$gcm_data = self::decode_request($request_data);
			
			return $gcm_data;
		}
		
		public static function verifyGCM($appid, $data)
		{		
			$remote_array = $data;
			
			$request_data = array("api_key"=>$appid,
								  "action"=>'users',
								  "method"=>"POST",
								  "remoteContent"=>$remote_array,
								 );
			
			$verify_gcm_result = self::decode_request($request_data);
			//echo "<pre>";print_r($verify_gcm_result);exit;
			return $verify_gcm_result;
		}
		
		public static function updateSiteSettings($appid, $data)
		{		
			$remote_array = $data;
			
			$request_data = array("api_key"=>$appid,
								  "action"=>'users',
								  "method"=>"POST",
								  "remoteContent"=>$remote_array,
								 );
			$result = self::decode_request($request_data);
			
			return $result;
		}
		
		public static function updateProfileSettings($appid, $data)
		{		
			$remote_array = $data;
			
			$request_data = array("api_key"=>$appid,
								  "action"=>'users',
								  "method"=>"POST",
								  "remoteContent"=>$remote_array,
								 );
			
			$result = self::decode_request($request_data);
			//echo "<pre>";print_r($result);exit;
			return $result;
		}
		
		public static function getOptinSettings($appid, $site_id)
		{		
			$remote_array = "";
			
			$request_data = array("api_key"=>$appid,
								  "action"=>'users?type=get_optin_settings&site_id='.$site_id,
								  "method"=>"GET",
								  "remoteContent"=>$remote_array,
								 );
			
			$result = self::decode_request($request_data);
			//echo "<pre>";print_r($result);exit;
			return $result;
		}
		
		public static function updateOptinSettings($appid, $data)
		{		
			$remote_array = $data;
			
			$request_data = array("api_key"=>$appid,
								  "action"=>'users',
								  "method"=>"POST",
								  "remoteContent"=>$remote_array,
								 );
			//echo "<pre>";print_r($request_data);exit;
			$result = self::decode_request($request_data);
			//
			return $result;
		}
		
		public static function getTimezoneInfo($appid, $site_id)
		{		
			$request_data = array("api_key"=>$appid,
								  "action"=>'users?type=getTimezone&site_id='.$site_id,
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$gcm_data = self::decode_request($request_data);
			//echo "<pre>".$site_id;print_r($gcm_data);exit;
			return $gcm_data;
		}
		
		public static function getSegments($appid)
		{		
			$request_data = array("api_key"=>$appid,
								  "action"=>'segments',
								  "method"=>"GET",
								  "remoteContent"=>"",
								);
			$segment_data = self::decode_request($request_data);
			//echo "<pre>";print_r($segment_data);echo "</pre>";exit;
			return $segment_data;
		}
		
		public static function send_notification( $note_text, $note_link, $app_key, $note_title, $segments=false, $image_url=false, $adv_options=false ) 
		{
			
			$request_data = array();
			$remoteContent = array();
			if ($note_title )
			$remoteContent['notification_title'] = self::filter_string($note_title);
		
			if ($note_text )
			$remoteContent['notification_message'] = self::filter_string($note_text);
		
			if ( $note_link ){
				$remoteContent['notification_url'] = $note_link;
			}
			if ( $segments ) {
				$remoteContent['include_segments'] = $segments;
			}
			if ( $image_url ) {
				$remoteContent['image_url'] = $image_url;
			}
			
			if ( $adv_options['segments'] ) {
				$remoteContent['include_segments'] = $adv_options['segments'];
			}
			
			if ( $adv_options['require_interaction'] ) {
				$remoteContent['require_interaction'] = $adv_options['require_interaction'];
			}
			else
			{
				$remoteContent['require_interaction'] = '0';
			}
			
			if ( $adv_options['notification_type'] ) {
				$remoteContent['notification_type'] = $adv_options['notification_type'];
			}
			
			if ( $adv_options['notification_expiry'] ) {
				$remoteContent['notification_expiry'] = $adv_options['notification_expiry'];
			}
			
			if ( $adv_options['valid_from'] ) {
				$remoteContent['valid_from_utc'] = $adv_options['valid_from'];
			}

			//echo "<pre>".$remoteContent['notification_message'].'<br>'.$note_link.'<br>'.$remoteContent['notification_title'];print_r($segments);
			$request_data['action'] = "notifications"; 
			$request_data['method'] = "POST";
			$request_data['api_key'] = $app_key;
			$request_data['remoteContent'] = $remoteContent;
			//echo "<pre>";print_r($adv_options);print_r($request_data);exit;
			$response = self::decode_request( $request_data );
			//print_r($response);die;
			return $response;
		}
		
		public static function getSubcriptionPlans($appid, $plan_id=false)
		{
			if($plan_id)
			$plan_id = '&plan_id='.$plan_id;
		
			$request_data = array("api_key"=>$appid,
								  "action"=>'users?type=get_subscription_plans'.$plan_id,
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$sub_plans_data = self::decode_request($request_data);
			return $sub_plans_data;
		}
		
		public static function verifyUser($appid)
		{
			$request_data = array("api_key"=>$appid,
								  "action"=>'info?type=verify_user',
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$verify_usr_info = self::decode_request($request_data);
			return $verify_usr_info;
		}
		
		public static function removeSpecialCharacters($string)
		{
		   return preg_replace('/[^A-Za-z0-9\- ]/', '', $string); // Removes special chars.
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

		public static function getSiteType($appid)
		{
			$request_data = array("api_key"=>$appid,
								  "action"=>'users?type=get_pe_options',
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$getSiteType = self::decode_request($request_data);
			return $getSiteType;
		}
		public static function updateSiteType($appid,$data)
		{
			$request_data = array("api_key"=>$appid,
								  "action"=>'users',
								  "method"=>"POST",
								  "remoteContent"=>$data,
								 );
			$getSiteType = self::decode_request($request_data);
			return $getSiteType;
		}

		//active subscriber from node
		public static function getActiveSubscriberFromNode($appid)
		{
			$request_data = array("api_key"=>$appid,
								  "action"=>'users?type=get_active_subscriber_count_from_node',
								  "method"=>"GET",
								  "remoteContent"=>"",
								 );
			$active_subscriber_count_from_node = self::decode_request($request_data);
			return $active_subscriber_count_from_node;
		}
	}
?>