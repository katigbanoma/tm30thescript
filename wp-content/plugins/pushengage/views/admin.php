<?php 

	$optin_settings =$_SESSION['optin_settings_data'];
	
	$site_type =$_SESSION['site_type'];

	$appdata = $_SESSION['appdata'];
	
	$welcome_note_data = $_SESSION['welcome_note_data'];
	
	$userdata = $_SESSION['userdata'];
	
	$timezone = $_SESSION['timezone'];
	
	$gcmdata = $_SESSION['gcmdata'];

	//Intermediate page settings 
	$intermediate_page_settings = $_SESSION['appdata']['optin_settings']['intermediate'];
	if (empty($intermediate_page_settings)) {
	$optin_settings->intermediate=new stdClass();
	$optin_settings->intermediate->page_heading="Click on Allow to get Notifications from '". $appdata['site_name']."'";
	$optin_settings->intermediate->page_tagline="Get Updates from '".$appdata['site_name']."' through push notifications";
	}  

        
	function add_special_char($string_with_special_char)
	{
		return str_replace('"'," &quot;",$string_with_special_char);
	}
	if(isset($optin_settings->desktop->http))
	{
	  $dialogbox_type=$optin_settings->desktop->http->optin_type;
	  $optin_title=add_special_char($optin_settings->desktop->http->optin_title);
	  $optin_allow_button=add_special_char($optin_settings->desktop->http->optin_allow_btn_txt);
	  $optin_close_button=add_special_char($optin_settings->desktop->http->optin_close_btn_txt);
	  $optin_delay_time=$optin_settings->desktop->http->optin_delay;
    $quick_install=$optin_settings->desktop->http->optin_sw_support;
    $optin_segments_http=json_decode($optin_settings->desktop->http->optin_segments);
	}
	else
	{
	  $dialogbox_type=$optin_settings->desktop->optin_type;
	  $optin_title=add_special_char($optin_settings->desktop->optin_title);
	  $optin_allow_button=add_special_char($optin_settings->desktop->optin_allow_btn_txt);
	  $optin_close_button=add_special_char($optin_settings->desktop->optin_close_btn_txt);
	  $optin_delay_time=$optin_settings->desktop->optin_delay;
    $optin_segments_http=json_decode($optin_settings->desktop->http->optin_segments);
	}

	if(isset($optin_settings->desktop->https))
	{
	  $dialogbox_type_https=$optin_settings->desktop->https->optin_type;
	  $optin_title_https=add_special_char($optin_settings->desktop->https->optin_title);
	  $optin_allow_button_https=add_special_char($optin_settings->desktop->https->optin_allow_btn_txt);
	  $optin_close_button_https=add_special_char($optin_settings->desktop->https->optin_close_btn_txt);
	  $optin_delay_time_https=$optin_settings->desktop->https->optin_delay;
    $quick_install=$optin_settings->desktop->https->optin_sw_support;
    $optin_segments_https=json_decode($optin_settings->desktop->https->optin_segments);
	}
	else
	{
	  $dialogbox_type_https=$optin_settings->desktop->optin_type;
	  $optin_title_https=add_special_char($optin_settings->desktop->optin_title);
	  $optin_allow_button_https=add_special_char($optin_settings->desktop->optin_allow_btn_txt);
	  $optin_close_button_https=add_special_char($optin_settings->desktop->optin_close_btn_txt);
	  $optin_delay_time_https=$optin_settings->desktop->optin_delay;
    $optin_segments_https=json_decode($optin_settings->desktop->https->optin_segments);
	}

if(!$menu_active_key){?>
<script type="text/javascript">var $ = jQuery.noConflict();</script>
<?php
		wp_enqueue_style( 'bootstrap', PUSHENGAGE_URL . 'css/bootstrap.css', array(), "", "all" );
			
		wp_enqueue_style( 'style', PUSHENGAGE_URL . 'css/pe-style.css', array(), "", "all" );
		wp_enqueue_script('jquery', PUSHENGAGE_URL . 'js/jquery.min.js');
		wp_enqueue_script('bootstrap', PUSHENGAGE_URL . 'js/bootstrap.min.js');
?>

 <?php

    // selection of tab
    $c_setup = "";
    $c_ins="";
  
    switch ($tab_start) {
    case "instruct" :
      $c_ins="active arrow_box";
        break;
    case "setup":
      $c_setup = "active arrow_box";
        break;
    default:
      $c_ins="active arrow_box";
 }
 ?>
<div class="container pe-container">
	<div class="row">
		<div class="col-sm-12">
	        <div role="tabpanel">

	       
	          <ul class="nav nav-tabs pe-nav-tab" role="tablist">
	            <li role="presentation" class="<?php echo $c_ins; ?>"><a href="#instruction" aria-controls="instruction" role="tab" data-toggle="tab">Instruction</a></li>
	            <li role="presentation" class ="<?php echo $c_setup; ?>"><a href="#setup" aria-controls="setup" role="tab" data-toggle="tab">Setup</a></li>
	          </ul>

	          <div class="tab-content col-sm-12 pe-instruction-content">
	            <div role="tabpanel" class="<?php 
  if($c_ins == "active arrow_box"){
    echo "tab-pane active";
  }
  else{echo "tab-pane";}
?>" id="instruction">
	             <div role="tabpanel" class="tab-pane active">
		    	
		    	<div class="col-sm-12 no-padding">
					<h1 class="pe-header inst-header center-text">HOW TO GET MY API KEY</h1>
		    	</div>

		    	<div class="col-sm-12 pe-inst-step-box">
              
                <div role="tabpanel">

                  <ul class="nav nav-tabs nav-line pe-inst-step-tab" role="tablist">
                    <li role="presentation" class="active"><a href="#step1" aria-controls="step1" role="tab" data-toggle="tab">STEP 1</a></li>
                    <li role="presentation"><a href="#step2" aria-controls="step2" role="tab" data-toggle="tab">STEP 2</a></li>
                    <li role="presentation"><a href="#step3" aria-controls="step3" role="tab" data-toggle="tab">STEP 3</a></li>
                  </ul>

                  <div class="tab-content pe-inst-step-content">
                    <div role="tabpanel" class="tab-pane active" id="step1">
                      <h2 class="pe-inst-step-title">Open your PushEngage <a class="link-decoration" href="https://www.pushengage.com/dashboard/user/login" target="_blank">Dashboard</a> and click on Settings <span class="for-symbol">&#x2192;</span> Get API Key</h2>
                      <img src="<?php echo PUSHENGAGE_PLUGIN_URL."images/ins1.png"?>" alt="instruction image 1"  class="img-responsive">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="step2">
                      <h2 class="pe-inst-step-title">To generate API Key click on Generate new key</h2>
                      <img src="<?php echo PUSHENGAGE_PLUGIN_URL."images/ins2.png"?>" alt="instruction image 2" class="img-responsive">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="step3">
                      <h2 class="pe-inst-step-title">Copy generate API Key, open Setup tab and paste it</h2>
                      <img src="<?php echo PUSHENGAGE_PLUGIN_URL."images/ins3.png"?>" alt="instruction image 3" class="img-responsive">
                    </div>
                  </div>
            
            </div>
            </div>
		    </div>
	            </div>
	            
	             <div role="tabpanel" class="<?php 
  if($c_setup == "active arrow_box"){
    echo "tab-pane active col-sm-12 pe-setup-content";
  }
  else{echo "tab-pane col-sm-12 pe-setup-content";}
?>" id="setup">
	
					<?php if(isset($status) and $status){?>
          <div class="row" style="margin-top: 25px;">
          <div class="col-md-3"></div>
          <div class="alert alert-danger alert-dismissable col-md-6">
        <strong>Danger!</strong> API Key is invalid. Please try again. 
        </div>
        </div>
		<?php }?>
					<form class="text-center" name="login-form" id="login_form" method="post" action="admin.php?page=pushengage-admin">
						
						<h1 class="pe-header inst-header">Login</h1>
					
						<input type="text" name="appid" id="appid" required  placeholder="Enter Your API Key">
							
					
						<div style="padding-top:15px;">
						<input type="submit" name="form_submit" value="Submit" class="button button-primary" style="background: #0565c7;font-size: 15px;">
						
						<div style="padding-top:15px;text-align: left">If you do not have an API Key, then please register at <a href="https://www.pushengage.com/pricing" target="_blank">PushEngage.com</a>, and obtain your key from <a href="https://www.pushengage.com/dashboard/key_generator" target="_blank">dashboard</a> </div>
					</form>
			
		    </div>
	            </div>
	            
	          </div>

	        </div>              


	  	</div>
	</div>

<?php }
else if($_SESSION['check_auth']['block_user'] && strpos($_SESSION['check_auth']['block_user_message'],'our account is currently inactive'))
		{
      include_once("disable_user.php");
		}
else{
	//echo "<pre>";print_r($check_auth);exit;
?>
<style>
 @media (min-width:1024px)
 {
.tooltip-inner {
           max-width: none;
           white-space: nowrap;
       }
 }
 @media (min-width:600px) and (max-width:761px)
 {
  .tooltip-inner {
           max-width: none;
           white-space: nowrap;
       }
 }
 .topstats li{border: 1px solid #eeeeee;
   padding: 15px;
   margin: 0px 0px !important;
  }
  .topstats  li h3{color:#674508}
  .topstats  li span i{color:green !important}
.topstats{padding:0 0px !important}
@media (min-width:660px) and (max-width:1024px)
 {
  .topstats li{border-right: 0px !important;
  }
 }
</style>
	<div class="container-widget">
		
		<?php include_once('header.php');?>
    <?php
    // selection of tab
    $c_gs = "";
    $c_sdb="";
    $c_wn ="";
    $c_is="";
    $c_gcm="";
	
	if($_GET['tab'])
	$tab = $_GET['tab'];

    switch ($tab) {
    case "gSettings" :
      $c_gs="active";
        break;
    case "subDialogbox":
      $c_sdb = "active";
        break;
    case "welcome_notification":
        $c_wn="active";
        break;
    case "insSettings":
        $c_is="active";
        break;
    case "gcmSettings":
        $c_gcm="active";
        break;
    default:
      $c_gs="active";
 }
 ?>
		<!-- tab style implementation-->
	<div class="row">

	 <ul class="nav nav-tabs pe-nav-tab" role ="tablist" >
      <li class="<?php echo $c_gs; ?>" role="presentation" id ="li_gs"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=pushengage-admin&tab=gSettings' ));?>" >General Settings</a></li>
	    <li class="<?php echo $c_sdb; ?>" role="presentation" id ="li_sdb"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=pushengage-admin&tab=subDialogbox' ));?>" >Subscription Dialogbox</a></li>
      <li class="<?php echo $c_wn; ?>" role="presentation" id ="li_wn"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=pushengage-admin&tab=welcome_notification' ));?>" >Welcome Notification Settings</a></li>
	    <li class="<?php echo $c_is; ?>" role="presentation" id ="li_ins"><a  href="<?php echo esc_url_raw( admin_url( 'admin.php?page=pushengage-admin&tab=insSettings' ));?>">Installation Settings</a></li>
	    <li class="<?php echo $c_gcm; ?>" role="presentation" id ="li_gcm"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=pushengage-admin&tab=gcmSettings' ));?>">GCM Settings</a></li>
	  </ul>


<div class="tab-content">
<!-- ***************************************-->
      <!--General settings -->
      <div id="gSettings" class="<?php 
            if($c_gs == "active" )
              { echo" tab-pane fade in active";} 
            else { echo "tab-pane fade";}
            ?>">
        <div class="row">
        <div class="col-md-8 col-lg-8">
          <div class="panel panel-default">
            <div class="form-wrap box box-primary  box-body"  style="width:70%;"> 
              <?php if(isset($_REQUEST['status']) and $_REQUEST['status']){?>
            <div id="message" class="updated notice notice-success is-dismissible" style="margin-bottom:15px;"><p>Settings saved successfully </p></div>
            <?php } ?>
            <div class="box-header with-border">
                <div class="panel-title">General Settings</div>
            </div>
            <form id="not_settings" method="post" action="" class="validate">
            <div class="form-field form-required">
              <label for="tag-name"><strong>API Key</strong></label>
              <input type="text" name="pushengage-apikey" style="width:600px" class="form-control" readonly placeholder="Enter API Key" class="form-control" value="<?php if( $pushengage_settings['appKey'] ) echo $pushengage_settings['appKey']; ?>"/>
            </div>
            <?php if( $pushengage_settings['appKey'] ){?>
            <div class="form-field form-required">
            <table>
              <tr><th align="left">Site Info.</th></tr>
              <tr><td rowspan=4><img src="<?php echo $appdata['site_image'];?>" width="80px;" height="80px;"></td></tr>
              <tr><td  style="padding-left:10px;"><label for="tag-name">Site Name : <?php echo $appdata['site_name'];?></label></td></tr>
              <tr><td  style="padding-left:10px;"><label for="tag-name">Site URL : <?php echo $appdata['site_url'];?></label></td></tr>
            </table>
            </div>
            <?php }?>
            <div class="form-field form-required">
              <label for="tag-name"><strong>Auto Push</strong></label>
              <input type="checkbox" name="pushengage-auto-push" value="1" style="margin:0px !importang;" <?php checked( $pushengage_settings['autoPush'], 1 ); ?>/><?php //disabled( ! empty( $pushengage_settings['all_post_types'] ) ) ?>
              Automatically send a push notification to your subscribers every time you publish a new post.
            </div>
            <div class="form-field">
              <label for="tag-slug"><strong>Allow All Post Types</strong></label>
              <input type="checkbox" name="pushengage-all-post-types" value="1" <?php checked( $pushengage_settings['all_post_types'], 1 ); ?> />
              Allow any post type to trigger a notification must mark "Send Notification" when publishing.
            </div>
            <div class="form-field term-parent-wrap">
              <label for="parent"><strong>Use Custom Images</strong></label>
              <input type="checkbox" name="pushengage-custom-image" value="1" <?php checked( $pushengage_settings['use_featured_image'], 1 ); ?> />
              Use featured image from post as custom image for notifications.
            </div>
            <div class="checkbox">
                  <label>
                  <input type="checkbox" id="utmcheckbox" name="utmcheckbox" onclick="displayUtmdiv()" <?php checked( $pushengage_settings['utmcheckbox'], 1 ); ?> > <strong>Add  UTM Parameters</strong>
                  </label>
            </div>
<!--checkpoint-->
                <div class="utmdiv" style="display:block;" id="utmdiv">
                  <div class="form-group">
                    <label for="utm_source"><strong>UTM Source</strong></label>
                    <input type="text" class="form-control" style="width:550px" id="utm_source" required = "true" pattern="^[A-Za-z0-9_]{1,45}$" title="This field allowed alphabets, numbers and _. And it should not more than 45 characters." maxlength="45" name="utm_source" placeholder="Enter UTM Source here" value="<?php if(isset($pushengage_settings['utm_source'])) echo $pushengage_settings['utm_source']; else echo 'pushengage';?>">
                  UTM Source limit 45 characters
                  </div>
                  <div class="form-group">
                    <label for="utm_medium"><strong>UTM Medium</strong></label>
                    <input type="text" class="form-control" style="width:550px" id="utm_medium" required="true"  pattern="^[A-Za-z0-9_]{1,45}$"  title="This field allowed alphabets, numbers and _. And it should not more than 45 characters." maxlength="73" name="utm_medium" placeholder="Enter UTM Medium here" value="<?php if(isset($pushengage_settings['utm_medium'])) echo $pushengage_settings['utm_medium']; else echo 'push_notification';?>">
                  UTM Medium limit 73 characters
                  </div>
                  <div class="form-group">
                    <label for="utm_campaign"><strong>UTM Campaign</strong></label>
                    <input type="text" class="form-control" style="width:550px" id="utm_campaign"  required = "true"  pattern="^[A-Za-z0-9_]{1,45}$"  title="This field allowed alphabets, numbers and _. And it should not more than 45 characters." maxlength="500" name="utm_campaign" placeholder="Enter Notification URL here" value="<?php if(isset($pushengage_settings['utm_campaign'])) echo $pushengage_settings['utm_campaign']; else echo 'pushengage';?>">
                  UTM Campaign limit 500 characters
                  </div>
                </div>
                <script type="text/javascript">
                      if(!document.getElementById("utmcheckbox").checked)
                      {
                          document.getElementById("utmdiv").style.display = "none";
                          document.getElementById("utm_source").required = false;
                          document.getElementById("utm_medium").required = false;
                          document.getElementById("utm_campaign").required = false;

                      }
                </script>
            <p class="submit"><input type="submit" name="save-settings" id="submit" class="btn btn-primary" value="Save Settings"></p>
            </form>
            </div>
          </div>
        </div>
        <!--End row -->
        </div>

          <script>
          function displayUtmdiv()
          {
            if(document.getElementById("utmcheckbox").checked)
            {
              document.getElementById("utmdiv").style.display = "block";
              document.getElementById("utm_source").required = true;
              document.getElementById("utm_medium").required = true;
              document.getElementById("utm_campaign").required = true;
            }
            else
            {
              document.getElementById("utmdiv").style.display = "none";
              document.getElementById("utm_source").required = false;
              document.getElementById("utm_medium").required = false;
              document.getElementById("utm_campaign").required = false;
            }
          };
          </script>
        <!--End General settings -->
      </div>

  <!-- Subscription Dialog box settings-->
  <div id="subDialogbox" class="<?php 
            if($c_sdb == "active" )
              { echo" tab-pane fade in active";} 
            else { echo "tab-pane fade";}
            ?>"> 
    <div class="row">
    <div class="col-md-12" style="background-color:#f5f5f5;">
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <div class="panel panel-default">
          <div class="panel-title">Subscription Dialogbox Settings</div>
          <?php
           $site_subdomain_for_browser_popup=$appdata['site_subdomain'];

            if (!filter_var($appdata['site_url'], FILTER_VALIDATE_URL) === false) 
            {
              $site_url_for_browser_popup=parse_url($appdata['site_url'], PHP_URL_HOST);
              $ssite_url_for_browser_popup=explode("www.",$site_url_for_browser_popup);
              if(isset($ssite_url_for_browser_popup[1]))
              {
                $site_url_for_browser_popup=$ssite_url_for_browser_popup[1];
              }
            }
            else
            {
              $site_url_for_browser_popup=$appdata['site_url'];
            }     

          ?>
          <div class="panel-body">
            <form role="form" id="create_segment_form" method="post" enctype="multipart/form-data">
              <div class="form-group " >
              <label for="site_name">Site Type</label>
                <div class="material-switch pull-right">
                  <span class="http-text">HTTP</span>
                  <input id="plan-switch" name="plan-switch" type="checkbox" <?php if($site_type['site_type']=='https') echo 'checked';?>/>
                  <label for="plan-switch" class="label-default"></label>
                  <span class="https-text">HTTPS</span>
                </div>
              </div>
              <div class="form-group">
                <label for="site_name">Dialogbox Type</label>
                <select name="optin_type" id="optin_type">
                  <option value="6" <?php if($dialogbox_type=="6") echo "selected";?>>Large Safari Style Box</option>
                  <?php if($sub_data['name'] != 'FREE'){?>
                  <option value="8" <?php if($dialogbox_type=="8") echo "selected";?>>Large Safari Style with Segment</option>
                  <?php }?>
                  <option value="1" <?php if($dialogbox_type=="1") echo "selected";?>>Safari Style Box</option>
                  <option value="3" <?php if($dialogbox_type=="3") echo "selected";?>>Bell </option>
                  <option value="2" <?php if($dialogbox_type=="2") echo "selected";?>>Bottom Placed Bar</option>
                  <option value="4" <?php if($dialogbox_type=="4") echo "selected";?>>Push Single Step Optin</option>
                  <option value="5" <?php if($dialogbox_type=="5") echo "selected";?> id="https-single-step-geo">Location + Push Single Step Optin</option>
                </select>
              </div>
              <div class="form-group quick-install-box" >
              <label for="quick-install">Quick Install <i class="fa fa-question-circle" aria-hidden="true" style="vertical-align: top;" data-toggle="tooltip" title="" data-original-title="If you set Quick Install to yes, you will collect subscription at https://yourdomain.pushengage.com/, and to go live you need to do (1)  add the PushEngage javascript.  If you wan to collecting subscription at your domain, set it to No, But it will require you to (1)  save 2 extra files and (2) add the Pushengage javascript"></i></label>
                <div class="material-switch pull-right">
                  <span class="http-text">No</span>
                  <input id="quick-install-switch" name="optin_sw_support" type="checkbox" <?php if(!$quick_install) echo 'checked' ?>/>
                  <label for="quick-install-switch" class="quick-install" id="quick-install-switch-label"></label>
                  <span class="https-text">Yes</span>
                </div>
              </div>

              <div class="form-group large-safaripopup-withsegment">
                <div id="error-message">You must choose two segments.</div>
                <label for="segments">Choose Segments</label>
                <select name="segments[]" id="segments" multiple size="3">
                  <?php
                        if($site_type['site_type']=='http') 
                        $optin_segments_https = $optin_segments_http;
                        if(!empty($segments_data))
                        { 
                          $segments_str = '';
                          foreach ($segments_data as $segment) {
                            if(in_array($segment['segment_name'], $optin_segments_https))
                            {
                              if($segments_str == '')
                                $segments_str = $segment['segment_name'];
                              else
                                $segments_str .= ','.$segment['segment_name'];
                            } 

                  if($segment['segment_name']){ 
                  ?>
                  <option value="<?php echo $segment['segment_name'];?>" <?php if(in_array($segment['segment_name'], $optin_segments_https)) echo "selected";?>><?php echo $segment['segment_name'];?></option>
                  <?php }}}?>
                </select>
                <style type="text/css">
                  .large-safaripopup-withsegment{
                    display: none;
                  }
                  #error-message{
                    display: none;
                    color: red;
                    margin-bottom: 10px;
                    text-align: left;
                  }
                </style>
                <script type="text/javascript">
                  $('#optin_type').change(function(){
                    if($('#optin_type').val() == 8)
                      $('.large-safaripopup-withsegment').show();
                    else
                      $('.large-safaripopup-withsegment').hide();
                  });

                  $(document).ready(function(){
                    $(document).on("click",'.upd_opt_set',function(e){
                      var segments_count = $('#segments').val().length;
                      if(segments_count > 2  || segments_count < 2)
                        {
                          $('#error-message').show();
                          $('#segments').focus();
                          return false;
                        }
                        else
                        {
                          $('#error-message').hide();
                          return true;
                        }
                    });

                    $(document).on("change",'#segments',function(e){
                      var seg_names = $("#segments").val();
                      //console.log(seg_names);
                      if(seg_names.length > 0)
                      {
                        //console.log(seg_names)
                        //console.log(seg_names.indexOf(','))
                        if(seg_names.length == 1)
                        {
                          //console.log('i am in if')
                          $('.lbl_segment1').html(seg_names[0]);
                          $('.lbl_segment2').html('Segment2');
                        }
                        else
                        {
                          //console.log('i am in else')
                          $('.lbl_segment1').html(seg_names[0]);
                          $('.lbl_segment2').html(seg_names[1]);
                        }
                      }
                      else
                      {
                        $('.lbl_segment1').html('Segment1');
                          $('.lbl_segment2').html('Segment2');
                      }
                    })
                  })
                  //Safaripopup with segment
                </script>
              </div>

              <div class="form-group " >
                <label for="site_name">Optin Delay Time</label>
                <input type="number"  min="1" max="20" step="1"  class="" style="margin-left:10px" id="optin_delay"required maxlength="250" name="optin_delay" placeholder="Enter delay" value="<?php if(isset($optin_delay_time)) echo $optin_delay_time;?>">Seconds
              </div>
              <div class="form-group" id='hide-thanku-https'>
                <label for="site_name" id="optin_title_label">Optin Title</label>
                <input type="text" class="form-control" id="optin_title" required maxlength="250" name="optin_title" placeholder="Enter Option Title here" value="">
              </div>
              <div class="form-group dialogbox-property">
                <label for="site_url">Optin Allow Button Text</label>
                <input type="text" class="form-control" id="optin_allow_btn_txt" required maxlength="500" name="optin_allow_btn_txt" placeholder="Enter Option Allow Button Text here" value="">
              </div>
              <div class="form-group dialogbox-property">
                <label for="site_url">Optin Close Button Text</label>
                <input type="text" class="form-control" id="optin_close_btn_txt" required maxlength="500" name="optin_close_btn_txt" placeholder="Enter Option Close Button here" value="">
              </div>
              <input type="hidden" name="action" value="update_optin_settings">
              <input type="hidden" name="site_id" id="site_id" value="<?php echo $site_id;?>">
              <input type="hidden" name="site_type" id="site_type" value="0">
              <input type="hidden" name="set_site_type" id="set_site_type" value="<?php if($set_site_type=='https') echo 'https'; else  echo 'http';?>">
              <div>
              <button type="submit" class="btn btn-primary  upd_opt_set">Update Optin Settings</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <style>
      /*switch code */  
      .material-switch{
        display:inline-block;
      }
      .material-switch > input[type="checkbox"] {
          display: none;   
      }

      .material-switch > label {
          cursor: pointer;
          height: 0px;
          position: relative; 
          width: 40px;  
      }

      .material-switch > label::before {
          background: rgb(0, 0, 0);
          box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
          border-radius: 8px;
          content: '';
          height: 16px;
          margin-top: -8px;
          position:absolute;
          opacity: 0.3;
          transition: all 0.4s ease-in-out;
          width: 40px;
      }
      .material-switch > label::after {
          background: rgb(255, 255, 255);
          border-radius: 16px;
          box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
          content: '';
          height: 24px;
          left: -4px;
          margin-top: -8px;
          position: absolute;
          top: -4px;
          transition: all 0.3s ease-in-out;
          width: 24px;
      }
      .material-switch > input[type="checkbox"]:checked + label::before {
          background: inherit;
          opacity: 0.5;
      }
      .material-switch > input[type="checkbox"]:checked + label::after {
          background: inherit;
          left: 20px;
      }

      /* Subscription Dialogbox Preview Design*/
      .material-switch .http-text,.material-switch .https-text{font-weight: normal;padding:0 10px;}
      .alert-browser-content-info{padding: 5px 20px 20px 27px}
      .alert-browser-content-info .right{float:right;}
      .alert-browser-content-info .p-b-20{padding-bottom: 15px}
      .alert-browser-notification-loc-popup {
          width: 347px;
          background: #fbfbfb;
          border: 1px solid rgba(69, 58, 58, 0.29);
          box-shadow: 0 0px 0px rgba(47, 46, 46, 0.12), 0 1px 2px rgba(104, 96, 96, 0.24);
      }
      .alert-browser-content-info .notification-loc-allow {
          margin-right: 6px;
          color: #282727;
          font-weight: 600;
          font-family: arial;
          font-size: 13px;
          cursor: pointer;
      }
      .alert-browser-content-info .notification-loc-permission-ok a{border: 1px solid #3e7ef8;
          padding: 3px 19px 3px 19px;
          margin-right: 6px;
          color: black;
          font-weight: 600;
          font-family: arial;
          font-size: 13px;
          cursor: pointer;
          box-shadow: 0 0 1px #b9c2d5;}
          .alert-browser-content-info .notification-loc-permission-ok{margin-top: 12px;
          margin-left: 242px;}
          .alert-browser-content-info .fa-bell{margin-right:10px;}
          .alert-browser-content-info .fa-map-marker{margin-right:13px;font-size:17px;}
          .alert-browser-notification-loc-popup-url{padding: 18px 0 0 13px;
          color: rgba(0, 0, 0, 0.87);
          font-size: 12px;
          margin-bottom: 5px;
          font-family: sans-serif;}
          {margin-top: 12px;
          margin-left: 242px;}

        /*quich install box*/
        label.quick-install{background:#399bff;}

        #second-sub-popup .alert-browser-notification-popup{
          margin-top: 40px;
          margin-left: 17px;
        }

        #second-sub-popup{
          clear: both;
        }
        #second-sub-popup .popup-step{
              position: relative;
            top: 20px;
        }

        /*safri style box*/
        .popup-step{
            background: #399bff;
            width: 30px;
            height: 30px;
            text-align: center;
            display: inline-block;
            line-height: 28px;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50%;
        }
        .popup-step.step-3{
            padding-left: 0px;
            padding-right: 0px;
            float: left;
        }
        #second-sub-popup{
          clear: both;
        }
        #second-sub-popup .popup-step{
              position: relative;
            top: 20px;
        }
        .step-1-text{
          margin-left:10px;
        }
      </style>
      <div class="col-md-6 col-lg-6">
        <div class="panel panel-default">
          <div class="panel-title">
            <div>Preview</div>
          </div>
          <div id="handle-step-1"><span class="popup-step" id="popup-1">1</span><span class="step-1-text">Please see Below</span></div>
          <div class="panel-body https-native-popup" >
            <div class="col-md-6">
              <div id="right_workspace" style="margin-top:10px">
              </div>

              <div id="second-sub-popup">
                 <span class="popup-step step-3" id="popup-2">2</span>
                 <div class='alert-browser-notification-popup arrow_box' id="default-sub-popup">
                    <span class='notification-content-close'>&#10006;</span>
                    <p class='alert-browser-notification-popup-url'><?php echo $site_url_for_browser_popup;?> want to:</p>
                    <p class='alert-browser-notification-popup-show'><img src='<?php echo PUSHENGAGE_PLUGIN_URL;?>/images/bell.png' style='width:18px;margin: 0 8px 0 23px;height: 15px;''></img>Show notifications</p>
                    <p style='text-align:right'><a class='notification-allow'>Allow</a><a class='notification-close'>Block</a></p>
                 </div>

                  <div class='pushengagesweet-alert-optin-4 showpushengagesweetAlert visible' id="http-single-step-optin">
                     <div class='pushengagesweet-alert-optin-4-content'>
                        <h2 id='_pe_optin_settings_optin_title' class='http-single-step-optin-title'></h2>
                        <p class='pushengagesweet-alert-optin-4-poweredby'>powered by PushEngage.com</p>
                     </div>
                     <div class='sa-button-container'>
                        <div class='sa-confirm-button-container'><button class='confirm' >CLOSE</button></div>
                     </div>
                  </div>
              </div>
            </div>
            <!-- <div class="col-md-5" id="right_workspace1">
            </div> -->
            

          </div>
        </div>
      </div>

  </div>
    

    <div class="row" id='intermediate-page-hide'>
      <div class="col-md-6 col-lg-6">
        <div class="panel panel-default">
          <div class="panel-title">Intermediate Page Settings</div>
          
          <div class="panel-body">
            <form role="form" id="create_segment_form" method="post" enctype="multipart/form-data">
              
              <div class="form-group">
                <label for="site_name">Page Heading</label>
                <input type="text" class="form-control" id="page_heading" required maxlength="250" name="page_heading" placeholder="Enter Option Title here" value="<?php if(isset($optin_settings->intermediate->page_heading)) echo $optin_settings->intermediate->page_heading;?>">
              </div>
              <div class="form-group">
                <label for="site_name">Tag Line</label>
                <input type="text" class="form-control" id="page_tagline" required maxlength="250" name="page_tagline" placeholder="Enter Option Title here" value="<?php if(isset($optin_settings->intermediate->page_tagline)) echo $optin_settings->intermediate->page_tagline;?>">
              </div>
              
              <input type="hidden" name="action" value="update_optin_page_settings">
              <input type="hidden" name="site_id" id="site_id" value="<?php echo $site_id;?>">
              <div>
              <button type="submit" class="btn btn-primary">Update Page Settings</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <style type="text/css">
      body{overflow-x:hidden; 
      }
        
.browser-mockup {
  border-top: 2em solid rgba(230, 230, 230, 0.7);
  box-shadow: 0 0.1em 1em 0 rgba(0, 0, 0, 0.4);
  position: relative;
  border-radius: 3px 3px 0 0
}

.browser-mockup:before {
  display: block;
  position: absolute;
  content: '';
  top: -1.25em;
  left: 1em;
  width: 0.5em;
  height: 0.5em;
  border-radius: 50%;
  background-color: #f44;
  box-shadow: 0 0 0 2px #f44, 1.5em 0 0 2px #9b3, 3em 0 0 2px #fb5;
}
.browser-mockup > * {
  /*display: block;*/
}
.browser-mockup{
  margin-bottom: 40px;
  margin-left:10px;
}
@media(max-width:742px){
  .browser-mockup{
  margin-top:12px;
  }
}
.browser-mockup .alert-browser-notification-popup{
    left: -18px;
    top: -30px;
}
.browser-mockup .alert-browser-notification-popup-url,.browser-mockup .alert-browser-notification-popup-show{
      text-align: left;
}
.custom-heading{
  font-size: 15px;
    padding-bottom: 5px;
    font-weight: bold;
    background-color: #33577b;
    padding: 10px;
    border-radius: 4px;
    color: white;}
/*browser notification alert*/
.alert-browser-notification-popup{width: 347px;
    height: 117px;
    background: #fbfbfb;
    margin-bottom: 25px;
    border: 1px solid rgba(69, 58, 58, 0.29);
    box-shadow: 0 0px 0px rgba(47, 46, 46, 0.12), 0 1px 2px rgba(104, 96, 96, 0.24);
    margin-left: 50px !important;
}
.alert-browser-notification-popup-url{padding: 18px 0 0 18px;
    color: rgba(0, 0, 0, 0.87);
    font-size: 12px;
    margin-bottom: 5px;
    font-family: sans-serif;}

.alert-browser-notification-popup-show,.alert-browser-location-popup-show{
    color: #282727;
    font-size: 13px;}
.notification-allow{color: black;
    border: 1px solid #3e7ef8;
    padding: 6px 19px 6px 19px;
    margin-right:6px;
      color: black;
    font-weight: 600;
    font-family: arial;
    font-size: 13px;
    cursor: pointer;
    box-shadow: 0 0 1px #b9c2d5;}

.notification-close{color: black;
    border: 1px solid #bbb;
    padding: 6px 19px 6px 19px;
    margin-right:13px;
    color: black;
    font-family: arial;
    font-size: 13px;
    cursor: pointer;
    box-shadow: 0 0 1px #bbb;}

.notification-content-close{
    color: #666262 !important;
    padding: 5px 11px 0 0 !important;
    margin: 0 !important;
    cursor: pointer;
    display: inline;
    float: right;
    font-size: 11px;
    font-weight: 600;
}
.notification-close:hover,.notification-allow:hover{color:black;}

.arrow_box {
  position: relative;
}
.arrow_box:after, .arrow_box:before {
  bottom: 100%;
  left: 50%;
  border: solid rgba(69, 58, 58, 0.29);
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}

.arrow_box:after {
  border-color: rgba(136, 183, 213, 0);
  border-bottom-color: #fbfbfb;
  border-width: 5px;
  margin-left: -163px;
}
.arrow_box:before {
  border-color: rgba(194, 225, 245, 0);
  border-bottom-color: rgba(69, 58, 58, 0.29);
  border-width: 7px;
  margin-left: -165px;
}


      </style>
      <div class="col-md-6 col-lg-6">
        <span class="popup-step step-3" id="popup-3">3</span>
        <div class="col-md-10 col-lg-10 browser-mockup" style="background-color: #fff;text-align: center;padding: 35px;">
          <div class="alert-browser-notification-popup arrow_box">
             <span class="notification-content-close">✖</span>
             <p class="alert-browser-notification-popup-url"><?php echo $site_subdomain_for_browser_popup."."?>pushengage.com want to:</p>
             <p class="alert-browser-notification-popup-show"><img src="<?php echo PUSHENGAGE_PLUGIN_URL.'images/bell.png';?>" style="width:18px;margin: 0 8px 0 23px;height: 15px;">Show notifications</p>
             <p style="text-align:right"><a class="notification-allow">Allow</a><a class="notification-close">Block</a></p>
          </div>

          <img src="<?php echo $appdata['site_image'];?>" style="max-width: 80px;">
          <p style="padding-top: 14px;"><b id="page_heading_view"><?php if(isset($optin_settings->intermediate->page_heading)) echo $optin_settings->intermediate->page_heading;?></b></p>
          <p><small id="page_tagline_view"><?php if(isset($optin_settings->intermediate->page_tagline)) echo $optin_settings->intermediate->page_tagline;?></small></p>
        </div>
      </div>
      </div>
  <!-- End Row -->
  </div>
      
      <div class="row">
      <div class="col-md-12" style="background-color:#f5f5f5;">
        <div class="row">
      <div class="col-md-6">
      <p class="custom-heading"> HTTP SITES ONLY</p>
        <div class="panel panel-default">
          <div class="panel-title">Use Buttons/Links  Code Snippets</div>
          <!-- form start -->                                            
          <div class="panel-body">
<pre>
&lt;button onclick="_pe.openDialogBox();"&gt;
Subscribe
&lt;/button&gt;
</pre>
            <h5><b>Button Preview :</b></h5>
            <button class="btn btn-primary">
            Subscribe
            </button>
            <br/>
            <br/>
<pre>
&lt;a onclick="_pe.openDialogBox();" href="javascript:void(0)"&gt;
Subscribe
&lt;/a&gt;
</pre>
            <h5><b>Link Preview :</b></h5>
            <a onclick="_pe.openDialogBox();" href="javascript:void(0)">
            Subscribe
            </a>
          </div>
        </div>
      </div>
      
      <div class="col-md-6">
      <p class="custom-heading"> HTTPS SITES ONLY</p>
        <div class="panel panel-default">
          <div class="panel-title">Use Buttons/Links  Code Snippets</div>
          <!-- form start -->                                            
          <div class="panel-body">
<pre>
&lt;button onclick="_pe.subscribe();"&gt;
Subscribe
&lt;/button&gt;
</pre>
            <h5><b>Button Preview :</b></h5>
            <button class="btn btn-primary">
            Subscribe
            </button>
            <br/>
            <br/>
<pre>
&lt;a onclick="_pe.subscribe();" href="javascript:void(0)"&gt;
Subscribe
&lt;/a&gt;
</pre>
            <h5><b>Link Preview :</b></h5>
            <a onclick="_pe.subscribe();" href="javascript:void(0)">
            Subscribe
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Row -->
    </div>
    </div>
      <style>

      <!-- Large safari style box -->
<style>
  @media (min-width: 400px)
optin_settings?sid=20:1522
#pushengage_confirm.pe-optin-6 {
    width: 400px;
}
  #pushengage_confirm.pe-optin-6 {
      display: table !important;
      border-radius: 2px;
      overflow: hidden;
      min-height: 200px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
      opacity: 1;
  }
  
  #pushengage_confirm.pe-optin-6 #pe-optin-6-body {
      display: table-cell !important;
      vertical-align: middle !important;
      padding: 20px;
  }
  
  @media(min-width:400px) {
      #pushengage_confirm.pe-optin-6 {
          width: 400px;
      }
  }
  
  @media(max-width:399px) {
      #pushengage_confirm.pe-optin-6 {
          width: 100%;
      }
  }
  
  #pe-optin-6-body #pe-optin-6-action {
      text-align: center;
  }
  
  #pe-optin-6-action #pe-optin-6-cancel-btn-wrapper,
  #pe-optin-6-action #pe-optin-6-allow-btn-wrapper {
      width: 49%;
  }
  
  #pe-optin-6-action #pe-optin-6-cancel-btn-wrapper {
      float: left;
  }
  
  #pe-optin-6-action #pe-optin-6-allow-btn-wrapper {
      float: right;
  }
  
  #pe-optin-6-action .pe-optin-6-cancel-btn,
  #pe-optin-6-action .pe-optin-6-allow-btn {
      display: inline-block;
      padding: 6px 8px;
      border-radius: 3px;
      margin: 20px 0;
      box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.14), 0 1px 7px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -1px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      min-width: 100px;
      text-align: center;
      word-break: break-all;
  }
  
  #pe-optin-6-action .pe-optin-6-cancel-btn:hover,
  #pe-optin-6-action .pe-optin-6-allow-btn:hover {
      opacity: 0.9;
  }

  #pe-optin-6-body #pe-optin-6-powered {
      clear: both;
      text-align: center;
      font-size: 11px;
      color: #565656;
      margin-bottom: -11px;
      padding-top: 6px;
      font-family: arial;
      font-weight: 500;
  }
  
    #pe-optin-6-body #pe-optin-6-site-img {
      display: block;
      margin: 0 auto;
      max-width: 80px;
      max-height: 80px;
      margin-top: 20px;
  }

      .pushengagesweet-alert-optin-4 {
          background-color: white;
          font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
          width: 410px;
          border-radius: 10px;
          text-align: center;
          display: block;
        box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18),0 4px 15px 0 rgba(0,0,0,0.15);
      }
      .pushengagesweet-alert-optin-4-content{
        background-color:#042048;
        background: -webkit-linear-gradient(#042048, #364c6c);
        background: -o-linear-gradient(#042048, #364c6c); 
          background: -moz-linear-gradient(#042048, #364c6c); 
          background: linear-gradient(#042048, #364c6c); 
        padding:15px 0 0 0;
        border-bottom:1px solid #a8b1bb;
        border-radius:11px 11px 0 0;
        }

      .pushengagesweet-alert-optin-4 h2 {
          color: white;
          font-size: 21px;
          text-align: center;
          font-weight: 600;
          text-transform: none;
          position: relative;
          line-height: 31px;
          display: block;
        margin:0px;
        
      }

      .pushengagesweet-alert-optin-4-poweredby{
        font-size:11px;
        text-align:right;
        padding:11px;
        color:white;
        margin: 0;}
      .pushengagesweet-alert-optin-4 button:hover {
             box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18),0 4px 15px 0 rgba(0,0,0,0.15);
          cursor: pointer;
        background:#042048;
      }

      .pushengagesweet-alert-optin-4 button {
          margin-top: 3%;
          background:#364c6c;
          color: #fff;
          margin-bottom: 4%;
          padding: 10px;
          border-radius: 4px;
          width: 140px;
          border: none;
          font-size: 13px;
          box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
          //transition: all .3s ease-out;
          cursor: pointer;
        font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
      }
      .custom-panel-title {
          font-family: 'Montserrat', sans-serif;
          color: #58666e;
          font-size: 13px;
          font-weight: bold;
          text-transform: uppercase;
          padding: 16px 20px;
          
      }
      #https-single-step-popup{display: none}

      </style>

      <script>

      $('label.label-default').click(function(){
        hideSingleStepPopupHH();
      });

      function removeQuotes(stringWithQuotes)
      {
        var newchar = '"';
        return stringWithQuotes.split(' &quot;').join(newchar);
      }

      $(document).ready(function()
      {
        var setSiteType="<?php if($site_type['site_type']=='https') echo 'https'; else  echo 'http';?>";
        if(setSiteType=="https")
        {
          $('#http-single-step-popup,.pushengagesweet-alert-optin-4').slideUp();
            $('#https-single-step-popup').slideDown();
            $('#site_type').val("1");
            $('#set_site_type').val("https");
            httpsPopupSet=1;

            $('#optin_title').val(removeQuotes("<?php echo $optin_title_https?>"));
            $('#optin_allow_btn_txt').val(removeQuotes("<?php echo $optin_allow_button_https?>"));
            $('#optin_close_btn_txt').val(removeQuotes("<?php echo $optin_close_button_https?>"));
            $('#optin_delay').val("<?php echo $optin_delay_time_https?>");
           // $("._statusDDL").val(2).change();
            $("[name=optin_type]").val("<?php echo $dialogbox_type_https?>").change();
          
            $('.quick-install-box').show();
            if($("[name=optin_type]").val()==4)
            {
              $('#hide-thanku-https').slideUp();
              $('.quick-install-box').hide();
            }
            if($("[name=optin_type]").val()==5)
            {
              $('.quick-install-box').hide();
            }

            update_optin_ui();
            $('#intermediate-page-hide').hide();
            $('select option#https-single-step-geo').show();
        }
        else
        {
          $('#https-single-step-popup').slideUp();
          $('#http-single-step-popup,.pushengagesweet-alert-optin-4').slideDown();
          $('#hide-thanku-https').slideDown();
          $('#site_type').val("0");
          $('#set_site_type').val("http");
          httpsPopupSet=0;
          $('#optin_title').val(removeQuotes("<?php echo $optin_title?>"));
          $('#optin_allow_btn_txt').val(removeQuotes("<?php echo $optin_allow_button?>"));
          $('#optin_close_btn_txt').val(removeQuotes("<?php echo $optin_close_button?>"));
          $('#optin_delay').val("<?php echo $optin_delay_time?>");
          $("[name=optin_type]").val("<?php echo $dialogbox_type?>").change();
          update_optin_ui();
          $('#intermediate-page-hide').slideDown();
          $('#intermediate-page-hide').show();
          $('select option#https-single-step-geo').hide();
          $('.quick-install-box').hide();
        }

        });
      var httpsPopupSet=0;
        function hideSingleStepPopupHH()
  {
    if ($('#plan-switch').is(":checked"))
    {
      $('#https-single-step-popup').hide();
      $('#http-single-step-popup,.pushengagesweet-alert-optin-4').slideDown();
      $('#hide-thanku-https').slideDown();
      $('#site_type').val("0");
      $('#set_site_type').val("http");
      httpsPopupSet=0;
      $('#optin_title').val(removeQuotes("<?php echo $optin_title?>"));
      $('#optin_allow_btn_txt').val(removeQuotes("<?php echo $optin_allow_button?>"));
      $('#optin_close_btn_txt').val(removeQuotes("<?php echo $optin_close_button?>"));

      $('#optin-message').val("<?php echo $optin_message?>");
      $('#optin-allow-button-footer').val("<?php echo $optin_allow_button_footer?>");
      $('#optin-close-button-footer').val("<?php echo $optin_close_button_footer?>");
      $('#optin-img-url').val("<?php echo $optin_img_url?>");
      $('#optin-footer-txt').val("<?php echo $optin_footer_txt?>");
      $('#optin-bg').val("<?php echo $optin_bg?>");

      $('#optin_delay').val("<?php echo $optin_delay_time?>");
      $("[name=optin_type]").val("<?php echo $dialogbox_type?>").change();

      update_optin_ui();

      $('#intermediate-page-hide').show();
      $('select option#https-single-step-geo').hide();
      $('.quick-install-box').hide();

      changeOptinColor("<?php echo $optin_bg?>");
      showAndHideIntermediatePopupForQuickInstall();

    }
    else
    {

      $('#http-single-step-popup,.pushengagesweet-alert-optin-4').slideUp();
      $('#https-single-step-popup').show();
      $('#site_type').val("1");
      $('#set_site_type').val("https");
      httpsPopupSet=1;

      $('#optin_title').val(removeQuotes("<?php echo $optin_title_https?>"));
      $('#optin_allow_btn_txt').val(removeQuotes("<?php echo $optin_allow_button_https?>"));
      $('#optin_close_btn_txt').val(removeQuotes("<?php echo $optin_close_button_https?>"));
      $('#optin_delay').val("<?php echo $optin_delay_time_https?>");

       $('#optin-message').val("<?php echo $optin_message_https?>");
      $('#optin-allow-button-footer').val("<?php echo $optin_allow_button_footer_https?>");
      $('#optin-close-button-footer').val("<?php echo $optin_close_button_footer_https?>");
      $('#optin-img-url').val("<?php echo $optin_img_url_https?>");
      $('#optin-footer-txt').val("<?php echo $optin_footer_txt_https?>");
      $('#optin-bg').val("<?php echo $optin_bg_https?>");

     // $("._statusDDL").val(2).change();
      $("[name=optin_type]").val("<?php echo $dialogbox_type_https?>").change();
      $('.quick-install-box').show();
      if($("[name=optin_type]").val()==4)
      {
        $('#hide-thanku-https').slideUp();
        $('.quick-install-box').hide();
      }
      if($("[name=optin_type]").val()==5)
      {
        $('.quick-install-box').hide();
      }


      update_optin_ui();
      $('#intermediate-page-hide').hide();
      $('select option#https-single-step-geo').show();
      showAndHideIntermediatePopupForQuickInstall();

      changeOptinColor("<?php echo $optin_bg_https?>");
      if($("[name=optin_type]").val() == 8)
      $('#quick-install-switch').prop('checked', true);
    }
  }


       function hideIntermediatePage()
      {

        if ($('#plan-switch').is(":checked"))
        {
          $('#intermediate-page-hide').hide();
          
        }
        else
        {
          $('#intermediate-page-hide').show();
        }
          
        showAndHideIntermediatePopupForQuickInstall();
      }

  function PEleft_hide_sidebar(){
    document.querySelector('.PE-optin4-box').style.display = "none";
  }
    
  function PEleft_show_sidebar()
  {
    document.querySelector('.PE-optin4-box').style.display = "block";
  }
  
  var PEswingwell="";
  function PESwingWellSetOption4()
  {
  PEswingwell = setInterval(function(){ startWellSwing() }, 1000);
  }

  function startWellSwing() {
    var elements = document.getElementsByClassName('fa fa-bell PEoption4bell');
    for (var i = 0; i < elements.length; i++) {
      var element = elements[i];
      if(element.className=='fa fa-bell PEoption4bell')
        element.className += ' PEnotioption4-swing';
      else
        element.className='fa fa-bell PEoption4bell';
      }
  }
PESwingWellSetOption4();
  function stopWellSwing() {
    clearInterval(PEswingwell);
  }

var _peapp={
  "app_key":"<?php echo $appdata['site_key'];?>",
  "app_id":"<?php echo $appdata['site_id'];?>",
  "app_name":"<?php echo $appdata['site_name'];?>",
  "app_subdomain":"https://<?php echo $appdata['site_subdomain'];?>.pushengage.com",
  "app_image":"<?php echo $appdata['site_image'];?>",
  "app_poweredby":"<?php  if ($appdata['is_whitelabel']=1) echo 'powered by Pushengage';?>",
  "app_url":"http://www.pushengage.com"
   };
      <?php $settings=(isset($appdata['optin_settings']) && $appdata['optin_settings'])?$appdata['optin_settings']:"''"; ?>
      var _pe_optin_settings=<?php echo $settings;?>;


 var  htmlbody = document.getElementsByTagName("BODY")[0];   

function update_optin_ui_text()
        {
           $("#_pe_optin_settings_optin_title").text($("#optin_title").val());
            _pe_optin_settings.desktop.optin_title=$("#optin_title").val();
              $("#pushengage_allow_btn").text($("#optin_allow_btn_txt").val());
            $("#pushengage_allow_btn").val($("#optin_allow_btn_txt").val());
            _pe_optin_settings.desktop.optin_allow_btn_txt=$("#optin_allow_btn_txt").val();
            $("#pushengage_close_btn").text($("#optin_close_btn_txt").val());
            _pe_optin_settings.desktop.optin_close_btn_txt=$("#optin_close_btn_txt").val();
            $("#page_heading_view").text($("#page_heading").val());
            $("#page_tagline_view").text($("#page_tagline").val());  
        }

        $(document).ready(function(){  
          $("#optin_title").keyup(function(){
            $("#_pe_optin_settings_optin_title").text($("#optin_title").val());
            _pe_optin_settings.desktop.optin_title=$("#optin_title").val();
          });
          $("#optin_allow_btn_txt").keyup(function(){
            $("#pushengage_allow_btn").text($("#optin_allow_btn_txt").val());
            $("#pushengage_allow_btn").val($("#optin_allow_btn_txt").val());
            _pe_optin_settings.desktop.optin_allow_btn_txt=$("#optin_allow_btn_txt").val();
          });
          $("#optin_close_btn_txt").keyup(function(){
            $("#pushengage_close_btn").text($("#optin_close_btn_txt").val());

            _pe_optin_settings.desktop.optin_close_btn_txt=$("#optin_close_btn_txt").val();
          });
          $("#page_heading").keyup(function(){
            $("#page_heading_view").text($("#page_heading").val());            
          });
          $("#page_tagline").keyup(function(){
            $("#page_tagline_view").text($("#page_tagline").val());            
          });
          $("[name=optin_type]").change(function(){
            update_optin_ui_text();
            update_optin_ui();
          });

          update_optin_ui_text();
          update_optin_ui();
         });
        

        function changeOptinColor(optinColor){

        if(optinColor){
          $('.pe-optin-7').css({"background":""+optinColor});
          $('#ls_pushengage_allow_btn,#ls_pushengage_close_btn').css({"border-color":""+optinColor});
        }
        else{
           $('.pe-optin-7,#ls_pushengage_allow_btn,#ls_pushengage_close_btn').removeAttr("style")
        }
      }
     
        function update_optin_ui(){

          if (httpsPopupSet==1)
          {
            $('.quick-install-box').show();
          }

         if($("[name=optin_type]").val()){
          $(".dialogbox-property").show();
          $("#optin_title_label").text("Optin Title");
      
        }

       switch($("[name=optin_type]").val()){

             case "1":
             $("#pushengage_confirm").remove();
              $("#right_workspace").html("<div id='pushengage_confirm' style='display: inline-block;width:410px;top:0px;left:33%;border: 1px solid #D0D0D0;background: #EFEFEF;padding:15px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;box-shadow: 1px 1px 3px #DCDCDC;z-index: 999999;'><div style='float: left;padding: -1px;margin-right: 8px;width:80px;height:80px;' id='pushengage_client_img'><img src='"+_peapp.app_image+"' style='width: 87px;'></div>  <div style='font-family: arial;font-size: 15px;font-weight: 600;color: #4A4A4A;' id='_pe_optin_settings_optin_title'>"+_pe_optin_settings.desktop.optin_title+"</div>  <div style='clear: both;'><div style='float: left;font-family: arial;font-size: 9px;padding-top: 10px;'>"+_peapp.app_poweredby+"</div><div style='float: right;font-family: arial;padding: 1px 19px;font-size: 15px;background-color: #2ecc71;color: #fff;border: 1px solid #7FB797;border-radius: 4px;cursor:pointer;' id='pushengage_allow_btn' >"+_pe_optin_settings.desktop.optin_allow_btn_txt+"</div><div style='float: right;font-family: arial;font-size: 15px;padding: 1px 19px;background-color: #fff;border-radius: 5px;border: 1px solid #D6D1D1;margin-right: 7px;cursor:pointer;' id='pushengage_close_btn'>"+_pe_optin_settings.desktop.optin_close_btn_txt+"</div>  </div>  </div> ");
                hideIntermediatePage();
                $('#hide-thanku-https').show();
                hideLargeSafariBoxExtraInput();
             break;

             case "2":
             $("#pushengage_confirm").remove();
             htmlbody.insertAdjacentHTML( 'beforeend', "<div id='pushengage_confirm' class='optin-3 optin-floatin' style='transition-duration: 1.5s;'><div class='cls-btn' id='pushengage_close_btn'><i class='fa fa-close'></i></div><div class='pe_logo'><img src='"+_peapp.app_image+"'></div><div class='pe_title' id='_pe_optin_settings_optin_title'>"+_pe_optin_settings.desktop.optin_title+"</div><div class='pe_buttons'><input type='button' value='"+_pe_optin_settings.desktop.optin_allow_btn_txt+"' id='pushengage_allow_btn' class='pe_btn-allow allow-btn'></div><div class='pe_branding'><a href='http://www.pushengage.com/' target='_blank'>"+_peapp.app_poweredby+"</a></div></div>");
              hideIntermediatePage();
              $('#hide-thanku-https').show();
              hideLargeSafariBoxExtraInput();
        
             break;
             case "3":
             $("#pushengage_confirm").remove();
             htmlbody.insertAdjacentHTML( 'beforeend', "<div id='pushengage_confirm' class='PE-optin4'><div class='PE-optin4-box PE-arrow_box '><div class='PE-optin4-image' style='padding-top:10px' ><img src='"+_peapp.app_image+"' style='border-radius:50%'></div><div class='PE-optin4-text'><span id='PEnoti-close-pane' onclick='PEleft_hide_sidebar(); PESwingWellSetOption4();'><i class='fa fa-close'></i></span><i id='pushengage_close_btn'></i><div class='PE-title PE-optin4-heading' style='padding-top:10px' id='_pe_optin_settings_optin_title'>"+_pe_optin_settings.desktop.optin_title+"</div></div><div class='PE-optin4-btns'><input type='button' class='PE-push-btn PE-btn-allow'  value='"+_pe_optin_settings.desktop.optin_allow_btn_txt+"'></div><div class='PE-branding'><a href='https://www.pushengage.com' target='_blank'>"+_peapp.app_poweredby+"</a></div></div><div class='PE-optin4-bell' ><i class='fa fa-bell PEoption4bell PEnotioption4-swing'></i></div></div>");
             hideIntermediatePage();
             $('#hide-thanku-https').show();
             hideLargeSafariBoxExtraInput();
          
             break;
             case "4":
             $("#pushengage_confirm").remove();
             $(".dialogbox-property").hide();
             $("#optin_title_label").text("Thank You Text");
           $("#right_workspace").html("<div id='pushengage_confirm'><div id='http-single-step-popup' class='alert-browser-notification-popup arrow_box'><span class='notification-content-close'>&#10006;</span><p class='alert-browser-notification-popup-url'><?php echo $site_subdomain_for_browser_popup."."?>pushengage.com want to:</p><p class='alert-browser-notification-popup-show'><img src='<?php echo PUSHENGAGE_PLUGIN_URL.'images/bell.png'?>'; style='width:18px;margin: 0 8px 0 23px;height: 15px;'></img>Show notifications</p><p style='text-align:right'><a class='notification-allow'>Allow</a><a class='notification-close'>Block</a></p></div></div>");
            


            $('.quick-install-box').hide();

            hideIntermediatePage();
            hideLargeSafariBoxExtraInput();
          
             break;
          
          case "5":
               $("#pushengage_confirm").remove();
               $(".dialogbox-property").hide();
              $("#right_workspace").html("<div id='pushengage_confirm'> <div class='alert-browser-notification-loc-popup arrow_box' id='https-single-step-noti-loc-popup'> <span class='notification-content-close'>&#10006;</span> <div class='alert-browser-notification-loc-popup-url'><?php echo $site_url_for_browser_popup;?> want to:</div><div class='alert-browser-content-info'> <div class='p-b-20'> <span class='alert-browser-location-popup-show'><i class='fa fa-map-marker' aria-hidden='true'></i>Know your location</span> <span class='right'><a class='notification-loc-allow'>Allow</a><i class='fa fa-sort-desc' aria-hidden='true'></i></span> </div><div> <span class='alert-browser-notification-popup-show'><i class='fa fa-bell' aria-hidden='true'></i>Show notifications</span> <span class='right'><a class='notification-loc-allow'>Allow</a><i class='fa fa-sort-desc' aria-hidden='true'></i></span> </div><div class='notification-loc-permission-ok'> <a>OK</a> </div></div></div></div>");
                hideIntermediatePage();
                $('#hide-thanku-https').hide();
                $('.quick-install-box').hide();
                hideLargeSafariBoxExtraInput();
                
             break;   

             case "6":
               $("#pushengage_confirm").remove();
              $("#right_workspace").html("<div id=pushengage_confirm style=background:#fff class=pe-optin-6><div id=pe-optin-6-body><div id=pe-optin-6-title style=font-family:arial;font-size:17px;font-weight:500;color:#232323;line-height:24px>"+_pe_optin_settings.desktop.optin_title+"</div><img src='"+_peapp.app_image+"' alt='site image' id='pe-optin-6-site-img'><div id=pe-optin-6-action><div id=pe-optin-6-cancel-btn-wrapper><div id=pushengage_close_btn style=font-family:arial;font-size:18px;font-weight:500;color:#232323;background:#fff class=pe-optin-6-cancel-btn>"+_pe_optin_settings.desktop.optin_close_btn_txt+"</div></div><div id=pe-optin-6-allow-btn-wrapper><div id=pushengage_allow_btn style=font-family:arial;font-size:18px;font-weight:500;color:#fff;background:#2ecc71 class=pe-optin-6-allow-btn>"+_pe_optin_settings.desktop.optin_allow_btn_txt+"</div></div></div><div id=pe-optin-6-powered>powered by Pushengage</div></div></div>");
                hideIntermediatePage();
                $('#hide-thanku-https').show();
                hideLargeSafariBoxExtraInput();
                break;
    
              case "8":
               $("#pushengage_confirm").remove();
              $("#right_workspace").html("<div id=pushengage_confirm style=background:#fff class=pe-optin-6><div id=pe-optin-6-body><img src='"+_peapp.app_image+"' alt='site image' id='pe-optin-6-site-img' style='margin-bottom: 15px;'><div id=pe-optin-6-title style=font-family:arial;font-size:17px;font-weight:600;color:#232323;line-height:24px>"+_pe_optin_settings.desktop.optin_title+"</div><div class='radio radio-info radio-inline' style='margin-top: 25px; margin-left: 50px;'><input type='radio' id='inlineRadio1' value='option1' name='radioInline' checked><label for='inlineRadio1' style='margin-right: 50px;' class='lbl_segment1'> Segment1 </label><input type='radio' id='inlineRadio2' value='option1' name='radioInline'><label class='lbl_segment2' for='inlineRadio1'> Segment2 </label></div><div id=pe-optin-6-action><div id=pe-optin-6-cancel-btn-wrapper><div id=pushengage_close_btn style=font-family:arial;font-size:18px;font-weight:500;color:#232323;background:#fff class=pe-optin-6-cancel-btn>"+_pe_optin_settings.desktop.optin_close_btn_txt+"</div></div><div id=pe-optin-6-allow-btn-wrapper><div id=pushengage_allow_btn style=font-family:arial;font-size:18px;font-weight:500;color:#fff;background:#2ecc71 class=pe-optin-6-allow-btn>"+_pe_optin_settings.desktop.optin_allow_btn_txt+"</div></div></div><div id=pe-optin-6-powered>powered by Pushengage</div></div></div>");
                hideIntermediatePage();
                $('#hide-thanku-https').show();
                $("#optin_message").removeProp('required');
                $('#quick-install-switch').prop('checked');
                $('#popup-3').text("2");
                $('#second-sub-popup').hide();
                hideLargeSafariBoxExtraInput();
                var seg_names = $("#segments").val();
                      //console.log(seg_names);
                      if(seg_names.length > 0)
                      {
                        //console.log(seg_names)
                        //console.log(seg_names.indexOf(','))
                        if(seg_names.length == 1)
                        {
                          //console.log('i am in if')
                          $('.lbl_segment1').html(seg_names[0]);
                          $('.lbl_segment2').html('Segment2');
                        }
                        else
                        {
                          //console.log('i am in else')
                          $('.lbl_segment1').html(seg_names[0]);
                          $('.lbl_segment2').html(seg_names[1]);
                        }
                      }
                      else
                      {
                        $('.lbl_segment1').html('Segment1');
                          $('.lbl_segment2').html('Segment2');
                      }
                break;
          }
        };
          $("#li_gs,#li_wn, #li_ins, #li_gcm ").click(function(){
              $("#pushengage_confirm").hide();
          });
        
          $("#li_sdb").click(function(){
              $("#pushengage_confirm").show();
          });
         if(!(<?php echo '"'.$tab.'"'; ?>== "subDialogbox")){ $("#gSettings").ready(function(){
            $("#pushengage_confirm").hide();
          });}

      </script>
      <script>

      // large safari style box 1
       function hideLargeSafariBoxExtraInput(){
        $("#optin-message-box :input, #optin-allow-button-footer-box :input, #optin-close-button-footer-box :input, #optin-img-url-box :input, #optin-footer-txt-box :input").prop('required',null);
  $('#optin-message-box,#optin-allow-button-footer-box,#optin-close-button-footer,#optin-img-url-box,#optin-footer-txt-box,#optin-img-enable-box,#optin-bg-box,#optin-close-button-footer-box').hide();
       }

$(document).on('click','#quick-install-switch-label',function(){
   var quickInstallSwitchValue=$('#quick-install-switch').is(":checked");
   var siteTypeValue=$('#set_site_type').val();
  var optinValue=$("[name=optin_type]").val();

  if (siteTypeValue=='https' && optinValue==8)
  return false;

    if(quickInstallSwitchValue){
      if (siteTypeValue==1 && optinValue==8)
      $('#intermediate-page-hide').show();
      else
      $('#intermediate-page-hide').hide();
      $('#popup-3').text("3");
      $('#second-sub-popup').show(); 
    }
    else{
      console.log('i am in else')
      $('#intermediate-page-hide').show();
      $('#popup-3').text("2");
      $('#second-sub-popup').hide();
    }
   
 
});

// Large safari style title change when change to input  

       $('#optin_title').on('input',function(e){
        $('#pe-optin-6-title').text($('#optin_title').val());
      });


function showAndHideIntermediatePopupForQuickInstall(){
  var siteTypeValue=$('#set_site_type').val();
  var optinValue=$("[name=optin_type]").val();
  if(siteTypeValue=="https"){
    var quickInstallSwitchValue=$('#quick-install-switch').is(":checked");
      
      if(quickInstallSwitchValue){
        $('#popup-3').text("2");
        $('#second-sub-popup').hide();
      }

    if(optinValue==4 || optinValue==5){
      optinValue=false;
    }
    else{
      optinValue=true;
    }
    if(quickInstallSwitchValue && optinValue){
      $('#intermediate-page-hide').show();
    }
    else{
      $('#intermediate-page-hide').hide();
    }
  }
  else if(siteTypeValue=="http" && optinValue==4){
    $('#intermediate-page-hide').hide();
  }
  else{
    $('#intermediate-page-hide').show();
  }
  
   
}


$("[name=optin_type]").on('change',function(){
        if($('#set_site_type').val()=="http"){
          switch($("[name=optin_type]").val()){

            case "1":
            case "6":
            case "7":
            $('#handle-step-1').show();
              $('.step-1-text').text("");
              $('#second-sub-popup').hide();
              $('#popup-3').text("2");
              $('#popup-2').css('top','20px');
              
              break;
            case "4":
              $('.step-1-text').text("");
              $('#default-sub-popup').hide();
              $('#popup-2').css('top','-12px')
              $('#second-sub-popup,#http-single-step-optin,#handle-step-1').show();
              $('.http-single-step-optin-title').text($('#optin_title').val());
              break;
            case "3":
            case "2":
             $('#handle-step-1').show();
              $('.step-1-text').text("Please see Bottom");
              $('#second-sub-popup').hide();
              $('#popup-3').text("2");
              $('#popup-2').css('top','20px');

              break;

            
          }
        }
        else{
          switch($("[name=optin_type]").val()){

            case "1":
            case "6":
            case "7":
              $('.step-1-text').text("");
              $('#popup-3').text("3");
              $('#popup-2').css('top','20px');
              $('#http-single-step-optin').hide();
               $('#second-sub-popup,#default-sub-popup,#handle-step-1').show();
              break;
            case "4":
            case "5":

              $('#second-sub-popup,#handle-step-1').hide();
              break;
            case "2":
            case "3":
              $('.step-1-text').text("Please see Bottom");
              $('#popup-3').text("3");
              $('#popup-2').css('top','20px');
              $('#http-single-step-optin').hide();
              $('#second-sub-popup,#default-sub-popup,#handle-step-1').show();
              break;
            case "8":
            if($("[name=optin_type]").val() == 8)
            $('#quick-install-switch').prop('checked', true);
              break;
            
          }
        }

      });
</script>
        <link rel="stylesheet" href="<?php echo PUSHENGAGE_PLUGIN_URL;?>/css/dialog_box.css">
      <!-- End of row -->
      </div>
    <!--End of Subscription Dialogbox setting-->
    </div>
<!-- ***************************************-->

        <!--Welcome Notification settings-->
        <div id = "welcome_notification" class="<?php 
            if($c_wn == "active" )
              { echo" tab-pane fade in active";} 
            else { echo "tab-pane fade";}
            ?>">
            <div class="row">
            <div class="col-md-8 col-lg-8">
              <div class="panel panel-default">
                <div class="panel-title">Welcome Notification</div>
                <div class="panel-body">
                  <form role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="notification_title">Notification Title</label>
                      <input type="text" class="form-control" id="notification_title" value="<?php echo ($welcome_note_data->notification_title)?$welcome_note_data->notification_title:"";?>" required maxlength="45" 
                       name="notification_title"  value="test" placeholder="Enter Notification Title here">
                      Notification title limit 45 characters 
                    </div>
                    <div class="form-group">
                      <label for="notification_message">Notification Message</label>
                      <input type="text" class="form-control" id="notification_message" value="<?php echo ($welcome_note_data->notification_message)?$welcome_note_data->notification_message:"";?>" required maxlength="73" 
                       
                      name="notification_message" placeholder="Enter Notification Message here">
                      Notification message limit 73 characters
                    </div>
                    <div class="form-group">
                      <label for="notification_message">Notification URL</label>
                      <input type="url" class="form-control" id="display_notification_url" required maxlength="500" value="<?php echo ($welcome_note_data->notification_url)?$welcome_note_data->notification_url:"";?>"  name="display_notification_url" placeholder="Enter Notification URL here">
                      <input type="hidden" name="notification_url" id="notification_url" >
                      Example Notification URL : http://www.pushengage.com
                    </div>
                    <input type="hidden" name="welcome_enabled" value="false">              
                   <div class="checkbox checkbox-primary" >
                        <input id="utmcheckbox" name="welcome_enabled" value="true" type="checkbox" <?php if ($welcome_note_data->welcome_enabled==="true")echo "checked='checked'";?> style="margin-left:0px !important;">
                        
                        <label for="utmcheckbox" >
                             Send Welcome Notifications to Subscribers
                        </label>

                    </div>
                    <input type="hidden" name="action" value="save_welcome_notification">             

                    <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                      
                            </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

	   	<!-- installation settings -->
	   	<div id="insSettings" class="<?php 
            if($c_is == "active" )
              { echo" tab-pane fade in active";} 
            else { echo "tab-pane fade";}
            ?>">
	   	<div class="row">
			<div class="col-md-8 col-lg-8">
				<div class="panel panel-default">
					<div class="panel-title">Installation Settings</div>
					<div class="panel-body">
						<form role="form" id="create_segment_form" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="site_name">Site Name</label>
								<input type="text" class="form-control" id="site_name" required maxlength="250" name="site_name" placeholder="Enter Site Name here" value="<?php echo $appdata['site_name'];?>">
							</div>
							<div class="form-group">
								<label for="site_url">Site URL</label>
								<input type="text" class="form-control" id="site_url" required maxlength="500" name="site_url" placeholder="Enter Site URL here" value="<?php echo $appdata['site_url'];?>">
							</div>
							<div class="form-group">
								<label for="site_image">Site Image</label>
								<br/>
								<div class="panel panel-danger" style="display:none">
									<div class="panel-body">
									Preferred Image size  <br/>Width x Height: 192px x 192px
									</div>
								</div>  
								<p>Preferred Image size  <br/>Width x Height: 192px X 192px</p>
								<img  src="<?php if($appdata['site_image']) {echo $appdata['site_image']; } else echo "https://placeholdit.imgix.net/~text?txtsize=19&txt=80X80&w=80&h=80";?>" id="display_site_img" style="max-width:80px;max-height:80px;"><br/>
								<input type="file" id="site_img"  name="site_img" style="display:none;"> 
							</div>
							<div class="form-group">
							  <label for="site_url">Maximum Notifications To Show a User at a Given Time From Your Website</label>
							  <input type="number"  data-container="body" data-toggle="popover" data-placement="right" data-content="FAQ: What is this setting?: We have noticed when a user opens a browser after some gap all his notifications get queued and he is shown all of them. This is often annoying to the users. Hence, we want to offer you a option to configure how many notifications from your site should be shown in such a case.  Setting a lower value means some user may miss older notifications for you, but will keep the experience pleasant" min="1" max="4" step="1"  class="form-control" id="site_url" required maxlength="500" name="max_notifications" placeholder="" value="<?php echo $appdata['max_notifications'];?>">
							</div>
							
							<input type="hidden" name="action" value="update_site_settings">
							<input type="hidden" name="site_id" id="site_id" value="<?php echo $site_id;?>">
							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Update Site Settings</button>
							</div>
						</form>              
					</div>
				</div>
			</div>
			
			<div class="col-md-8 col-lg-8">
				<div class="panel panel-default">
					<div class="panel-title">Profile Settings</div>
					<div class="panel-body">
						<form role="form" id="profile_form" method="post">
							<div class="form-group">
								<label for="site_name">Name:</label>
								<input type="text" class="form-control" id="user_name" required maxlength="250" name="user_name" placeholder="Enter Name here" value="<?php echo $userdata['user_name'];?>">
							</div>
							<div class="form-group">
								<label for="site_url">Email:</label>
								<input type="text" disabled="" class="form-control" id="site_url" required maxlength="500" name="user_email"  value="<?php echo $userdata['user_email'];?>">
							</div>
							<div class="form-group">
								<label for="site_url">Current Password:</label>
								<input type="password" class="form-control" id="site_url"  maxlength="500" name="password" placeholder="Enter Your Current password to change it to new one" >
							</div>
							<div class="form-group">
								<label for="site_url">New Password:</label>
								<input type="password" class="form-control" id="site_url"  maxlength="500" name="new_password" placeholder="Enter Your New password  ">
							</div>
							
							<div class="form-group">
								<label for="timezones">Timezone:</label><br>
								<input type="hidden" name="site_id" value="20">
								<select name="timezones" class="form-control">
									<option value="UM12" <?php if($timezone=='UM12') echo 'selected';?>>(UTC -12:00) Baker/Howland Island</option>
									<option value="UM11" <?php if($timezone=='UM11') echo 'selected';?>>(UTC -11:00) Niue</option>
									<option value="UM10" <?php if($timezone=='UM10') echo 'selected';?>>(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti</option>
									<option value="UM95" <?php if($timezone=='UM95') echo 'selected';?>>(UTC -9:30) Marquesas Islands</option>
									<option value="UM9" <?php if($timezone=='UM9') echo 'selected';?>>(UTC -9:00) Alaska Standard Time, Gambier Islands</option>
									<option value="UM8" <?php if($timezone=='UM8') echo 'selected';?>>(UTC -8:00) Pacific Standard Time, Clipperton Island</option>
									<option value="UM7" <?php if($timezone=='UM7') echo 'selected';?>>(UTC -7:00) Mountain Standard Time</option>
									<option value="UM6" <?php if($timezone=='UM6') echo 'selected';?>>(UTC -6:00) Central Standard Time</option>
									<option value="UM5" <?php if($timezone=='UM5') echo 'selected';?>>(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time</option>
									<option value="UM45" <?php if($timezone=='UM45') echo 'selected';?>>(UTC -4:30) Venezuelan Standard Time</option>
									<option value="UM4" <?php if($timezone=='UM4') echo 'selected';?>>(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time</option>
									<option value="UM35" <?php if($timezone=='UM35') echo 'selected';?>>(UTC -3:30) Newfoundland Standard Time</option>
									<option value="UM3" <?php if($timezone=='UM3') echo 'selected';?>>(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay</option>
									<option value="UM2" <?php if($timezone=='UM2') echo 'selected';?>>(UTC -2:00) South Georgia/South Sandwich Islands</option>
									<option value="UM1" <?php if($timezone=='UM1') echo 'selected';?>>(UTC -1:00) Azores, Cape Verde Islands</option>
									<option value="UTC" <?php if($timezone=='UTC') echo 'selected';?>>(UTC) Greenwich Mean Time, Western European Time</option>
									<option value="UP1" <?php if($timezone=='UP1') echo 'selected';?>>(UTC +1:00) Central European Time, West Africa Time</option>
									<option value="UP2" <?php if($timezone=='UP2') echo 'selected';?>>(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time</option>
									<option value="UP3" <?php if($timezone=='UP3') echo 'selected';?>>(UTC +3:00) Moscow Time, East Africa Time, Arabia Standard Time</option>
									<option value="UP35" <?php if($timezone=='UP35') echo 'selected';?>>(UTC +3:30) Iran Standard Time</option>
									<option value="UP4" <?php if($timezone=='UP4') echo 'selected';?>>(UTC +4:00) Azerbaijan Standard Time, Samara Time</option>
									<option value="UP45" <?php if($timezone=='UP45') echo 'selected';?>>(UTC +4:30) Afghanistan</option>
									<option value="UP5" <?php if($timezone=='UP5') echo 'selected';?>>(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time</option>
									<option value="UP55" <?php if($timezone=='UP55') echo 'selected';?>>(UTC +5:30) Indian Standard Time, Sri Lanka Time</option>
									<option value="UP575" <?php if($timezone=='UP575') echo 'selected';?>>(UTC +5:45) Nepal Time</option>
									<option value="UP6" <?php if($timezone=='UP6') echo 'selected';?>>(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time</option>
									<option value="UP65" <?php if($timezone=='UP65') echo 'selected';?>>(UTC +6:30) Cocos Islands, Myanmar</option>
									<option value="UP7" <?php if($timezone=='UP7') echo 'selected';?>>(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam</option>
									<option value="UP8" <?php if($timezone=='UP8') echo 'selected';?>>(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time</option>
									<option value="UP875" <?php if($timezone=='UP875') echo 'selected';?>>(UTC +8:45) Australian Central Western Standard Time</option>
									<option value="UP9" <?php if($timezone=='UP9') echo 'selected';?>>(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time</option>
									<option value="UP95" <?php if($timezone=='UP95') echo 'selected';?>>(UTC +9:30) Australian Central Standard Time</option>
									<option value="UP10" <?php if($timezone=='UP10') echo 'selected';?>>(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time</option>
									<option value="UP105" <?php if($timezone=='UP505') echo 'selected';?>>(UTC +10:30) Lord Howe Island</option>
									<option value="UP11" <?php if($timezone=='UP11') echo 'selected';?>>(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu</option>
									<option value="UP115" <?php if($timezone=='UP115') echo 'selected';?>>(UTC +11:30) Norfolk Island</option>
									<option value="UP12" <?php if($timezone=='UP12') echo 'selected';?>>(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time</option>
									<option value="UP1275" <?php if($timezone=='UP1275') echo 'selected';?>>(UTC +12:45) Chatham Islands Standard Time</option>
									<option value="UP13" <?php if($timezone=='UP13') echo 'selected';?>>(UTC +13:00) Samoa Time Zone, Phoenix Islands Time, Tonga</option>
									<option value="UP14" <?php if($timezone=='UP14') echo 'selected';?>>(UTC +14:00) Line Islands</option>
								</select>	
							</div>	
							<input type="hidden" name="action" value="update_profile">                  
							<div>
								<button type="submit" class="btn btn-primary">Update Profile</button>
							</div>
						</form>
					</div>
				</div>
			</div>
      <!-- End of row -->	
			</div>
       <script src="https://www.pushengage.com/assets/plugins/jszip/FileSaver.js"></script>

        <script type="text/javascript">
                 
                  function previewImage() {
                      var oFReader = new FileReader();
                      oFReader.readAsDataURL(document.getElementById("site_img").files[0]);
                      oFReader.onload = function (oFREvent) {
                          
                          var img = new Image();
                          img.src = oFREvent.target.result;
                          var width = img.width;
                          var height = img.height;
                          console.log(width,height);
                          if(width>8000 || height>8000 ){
                              jQuery(".panel-danger").slideDown();

                          }
                          else{
                          document.getElementById("display_site_img").src = oFREvent.target.result;
                          jQuery(".panel-danger").slideUp();
                          }
                      };
                  }
                 jQuery(document).ready(function(){
                    jQuery("#site_img_btn").click(function(){

                      jQuery("#site_img").click();
                      return false;
                      });
                    jQuery("#site_img").change(function(){
                      previewImage();
                    
                    });
                 });
            </script>
      <!-- End installation settings -->
	    </div>

	    <!-- gcm settings -->
	   	<div id="gcmSettings" class="<?php 
            if($c_gcm == "active" )
              { echo" tab-pane fade in active";} 
            else { echo "tab-pane fade";}
            ?>">
	   		<div class="row">
				<div class="col-md-8 col-lg-8">
					<div class="panel panel-default">
						<div class="panel-title">GCM Settings</div>
						<div class="panel-body">
							<form role="form" id="create_segment_form" method="post" enctype="multipart/form-data">
								<div class="kode-alert kode-alert-icon alert1-light">
									<i class="fa fa-info"></i>
									NOTE: If you have a HTTPS installation, please download your <a href="<?php echo PUSHENGAGE_SITE_URL.'dashboard/users/site_settings';?>"> Package Files</a> again and reinstall them after updating the GCM Key
								</div>
								<?php if($verify_gcm_result['banner'] || $error_message){?>
								<div class="kode-alert kode-alert-icon alert1-light">
									<i class="fa fa-info"></i>
									<?php if($verify_gcm_result['banner'])echo $verify_gcm_result['banner'];else echo $error_message;?>
								</div>
								<?php } ?>
								<div class="form-group">
									<label for="site_name">GCM Project Key</label>
									<input type="number" class="form-control" id="site_name" required maxlength="250" name="gcm_project_key" placeholder="Enter GCM Project Key here" value="<?php echo ($gcmdata->gcm_project_key)?$gcmdata->gcm_project_key:"";?>" title="GCM project key should be a number">
									<?php //echo form_error('gcm_project_key'); ?>
								</div>
								<div class="form-group">
									<label for="site_url">GCM API Key</label>
									<input type="text" class="form-control" id="site_url"  maxlength="500" name="gcm_api_key" required placeholder="Enter GCM API Key here" value="<?php echo ($gcmdata->gcm_api_key)?$gcmdata->gcm_api_key:"";?>">
									<?php //echo form_error('gcm_api_key'); ?>
								</div>
								<input type="hidden" name="action" value="update_gcm_settings">                  
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Update GCM Settings</button>
									<input type="submit"  name="verify_gcm"  id="verify_gcm" class="btn btn-primary pull-right" value="Verify GCM Settings">
									<p></p>
									<div class="alert alert-success" style="display:none" id="verified" role="alert">
	  									
									</div>
									<div class="alert alert-warning" style="display:none" id="not_verified" role="alert">
	  									
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="panel panel-default">
							<div class="panel-title">What is a GCM Key. How do I get access to my subscribers for Notifications, if I want to migrate to a different software provider?</div>
							<div class="panel-body" style="text-align: justify;">
										In order for us to provide you your subscriber ID&apos;s that have subscribed to your notifications, we would need that you provide us the GCM (Google Cloud Messaging) API Key for Chrome, and Certificate Details for Safari at the time of installation.
										<br>
										Without this information it is not possible for us to provide you the subscriber ID&apos;s. Also, note to export your subscriber ID&apos;s you need to be subscribed to our paid plans.  
										<br>
										If you want to know how to register for a GCM Key, please refer to documentation <a href="http://www.pushengage.com/blog/why-use-gcm-with-push-notifications/" target="_blank">here</a> .
							</div>
						</div>
				</div>
        <!-- End of row -->
			</div>
      <!-- End of gcm settings -->
		</div>
 <!-- End of tab content-->
  </div>
	 <!--End of row-->
	</div>
	<!--End of container widget-->
	
	</div>
<?php } ?>