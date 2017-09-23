=== PushEngage Browser Push Notifications Plugin===
Contributors: prakrishna2004, itsmeravitejak 
Tags: browser notifications, chrome notifications, chrome push notifications, notifications, push notifications, web notifications, website push notifications, chrome, chrome push, desktop notification, desktop notifications, firefox, firefox push, gcm, fcm, izooto, pushcrew, goroost, mobile notification, mobile notifications, notification, notifications, notify, onesignal, push, push messages, push notification, push notifications, roost, safari, safari push, web push
Requires at least: 4.1.5
Tested up to: 4.7
Stable tag: 1.4.5
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
PushEngage is a plugin to enable Browser Push Notifications for Desktop and Mobile users on Chrome, and Firefox. You can implement in 10 mins.
== Description ==
<a href="https://www.pushengage.com" target="_blank">PushEngage</a> is a leading platform for Browser Push notifications for Wordpress blogs and website, trusted by 6000+ websites in 115+ countries.  This plugin allows websites to send web push notifications to their site visitors and engage with them. These notifications reach the visitors even when they are not on your website. Current version of plugin supports Chrome and Firefox notifications.

If your website runs on Wordpress, you can use our Plugin to get automatic notifications at time of publishing a new post. No need to leave the Wordpress dashboard and send notifications from Wordpress directly. Our dashboard and install process is very easy, and it makes it easy for a Wordpress blog to go live with PushEngage. You need to just add your API key, and in case of HTTPS blogs download and save 2 files from our dashboard.

Here is our list of detailed features
•	Multiple Browser support:  PushEngage Currently Supports Firefox (version 44+) and Chrome (version 42+), on Desktop and Mobile.
•	Implement Push Notifications in 5 Minutes: PushEngage enables Push without requiring your website to implement HTTPS. Add the javascript code to your site and go live in 5 minutes.
•	HTTPS and HTTP Support : If you have an HTTP website, you can add the 2 line code from our dashboard. If you have an HTTPS website, then , you can add the 2 line code, and add 2 files at the /root of your domain. You can add the code through a tool like Google Tag Manager as well.
•	Single Step Optin for HTTP sites: We have a unique Single Step Optin if you are a HTTP site, which can give you much higher opt-in rates as compared to other options to collect subscribers for your HTTP site.
•	Multi Site & Multi User Login with Access Control: You can manage multiple websites and add different people from your team in a single PushEngage account. You will have option to control Access to different Screens for each of the team member you add.
•	Multi Action Notifications: Now you can have multiple call to actions in each notification, which can target users. You can use custom image for each call to action.
•	High Click Through Rates than Email:  Browser push notifications, can deliver 3 to 10x higher click rate over email. See our aggregate data chart on the side.
•	REST and JavaScript API: The API’s offer full flexibility to send notifications to an individual user, or set of users, based on actions on your website. You can also enrich the user profile in PushEngage, with your internal customer profile information and create targeted notifications.
•	Custom Segments and Geo Segmentation: Using Custom Segments you can personalize your messages, based on geography and where they signup from, or using your own segments.
•	Schedule Your Notifications: Schedule Your notifications so you don’t have send notifications during you weekend, or on vacation. Schedule your notifications to your audience when they are more likely to Click. Now you can also do recurring scheduling, and send notifications Week, every Month, or any fixed interval.
•	Automatic Notifications With RSS Feed: If you run a content site, and have a RSS, now you can fully automate sending Push Notifications. Just add your RSS feed, and we will automatically send notifications when you publish new content.
•	Multi Language Support: We are live in 115+ countries and support all the languages that can be captured in UTF-8 characters.
•	Reduce Unsubscribes by Old Notification Capping:  If your subscriber is on vacation or logins into the browser after a long gap, don’t flood him with notifications from your website. Use Frequency capping to cap the old notifications shown to your push subscriber, to reduce unsubscribes.
•	Engage Mobile Audience Without Mobile App:  Mobile Browsers support push notifications, so now you can re-engage with your audience and increase your repeat visitors to the mobile website. Now you dont need an mobile app to engage users in browser.
•	Re-Engage With Users Anywhere: Reach your when users when they are not on your website. Increase repeat users to your site using browser push notifications. These are delivered to user real-time, in the browser.

Free Plan supports upto 2500+ subscribers with no limit on sending.   For any questions, please get in touch with us at <a href="mailto:care@pushengage.com">care@pushengage.com</a>

== Installation ==
1. Upload PushEngage plugin folder into the "/wp-content/plugins/" directory.
2. Install the plugin through the "Plugins" menu in WordPress.
3. Activate the plugin through the "Plugins" menu in WordPress.
4. HTTPS / SSL users should follw below instructions to install PushEngage Notifications Plug-in. 
   i) HTTPS users should download installation files from their Dashboard under Settings -> Installation Settings.
  ii) Download the Package file containing manifest.json and service-worker.js
 iii) Place the manifest.json and service-worker.js file in root folder i.e. at https://www.example.com/manifest.json
   

== Frequently Asked Questions ==
1. How can I look into the product features and dashboard that you have?

Please register with a new account here and you will receive an email with login to your dashboard.

2. Can PushEngage be implemented on http websites?

Yes, PushEngage can be implemented on a HTTP website, and that is one of the advantage of using our product, that you don’t need to have a HTTPS version of your website. We will implement this using our Https certificate and the domain your push will be hosted will be https://yourdomain.pushengage.com

3. Can PushEngage be implemented on https websites, with a url structure https://push.mydomain.com ?

Yes, we can implement if you have your own Https domain and want to have your notifications come from your domain name.

4. After I have 2500 subscribers in my free account, what will happen to my account?

Once you reach a subscriber number of 2500, you will need to upgrade to paid plan to keep sending notifications.

5. How do I get access to my subscribers for Notifications, as I may need them if I want to migrate to a different software provider?

In order for us to provide you your subscriber ID’s that have subscribed to your notifications, we would need that you provide us the GCM (Google Cloud Messaging) API Key for Chrome, and Certificate Details for Safari at the time of installation. Without this information it is not possible for us to provide you the subscriber ID’s. Also, note to export your subscriber ID’s you need to be subscribed to our paid plans. If you want to know how to register for a GCM Key, please refer to documentation here .

6. I have a large list of email subscribers for my site. Is there a way to tie this list to the subscribers through Push Notification on the website.

The Chrome PushManager only gives us an opaque end-point for each of the subscriber i.e. a key like “APA91bHPffi8zclbIBDcToXN_LEpT6iA87pgR”. We do not have the ability to directly map this to a email of an user. 
However, if have the ability to determine the email or any other of your internal mapping of the user at the time of subscription, we provide you the ability to store that information along with the key.

7. If I have more questions who should I ask?

Please send us your query through Contact Us page, or email to us at care@pushengage.com


== Screenshots ==
1. Dashboard page you can see notifications and subscribers information.
2. Send a new notification
3. List of sent notifications
4. Create a new segment
5. General settings for notifications
6. Subscription dailogbox settings
7. GCM Settings
8. Welcome notification settings

== Changelog ==
= 1.0 =
* Initial release.
= 1.1 =
* Fixed some minor issues
= 1.2 =
* Fixes for CSS issue, Major revamp to all dashboards
= 1.2.1 =
* Fixed CSS issue. Incorporated advanced options for new notification section(Segments, Scheduled, User Interarction and Expiry)
= 1.2.2 =
* Resolved HTTPS issue and fixed minor issues.
= 1.2.3 =
* Fixed notification issue in New Post section.
= 1.2.4 =
* Fixed notification issue while saving the post as draft.
= 1.2.5 =
* HTTPS installation issues fixed.
= 1.2.6 =
* Updated dashboard page user interface. 
= 1.2.7 =
* Fixed issue in save draft checkbox display issue.
= 1.2.8 =
* Fixed display send notification checkbox issue in scheduled notification section.
= 1.2.9 =
* Updated require interaction functionality while creating notification.
= 1.3.0 =
* Require interaction of a notification option is now available in general settings.
= 1.3.1 =
* Fixed issue while posting printing an array.
= 1.3.2 =
* Support for wordpress version 4.7
= 1.3.3 =
* Fixed special characters issue while sending the notification.
= 1.3.4 =
* UTM parameter settings are incorporated in general settings.
= 1.3.5 =
* Updated plug-in description and tags
= 1.3.6 =
* Improved page speed and API response.
= 1.3.7 =
* Updated new plugin design and functionality. 
= 1.3.8 =
* Fixed auto push functionality in general settings section. 
= 1.3.9 =
* Fixed issue in scheduled notification with segments. 
= 1.4.0 =
* Fixed wordpress compatibility issues.
= 1.4.1 =
* Fixed slow page loading issue.
= 1.4.2 =
* Fixed notification title issue while sending post notification.
= 1.4.3 =
* Fixed issues with subscription dailogbox.
= 1.4.4 =
* Fixed issues in general settings.
= 1.4.5 =
* Incorporated large safari popup with segments, large safari popup and quick install option in subsciption dialogbox tab.
== Upgrade Notice ==
= 1.4.5 =
* Incorporated large safari popup with segments, large safari popup and quick install option in subsciption dialogbox tab.
= 1.4.4 =
* Fixed issues in general settings.
= 1.4.3 =
* Fixed issues with subscription dailogbox.
= 1.4.2 =
* Fixed notification title issue while sending post notification.
= 1.4.1 =
* Fixed slow page loading issue.
= 1.4.0 =
* Fixed wordpress compatibility issues.
= 1.3.9 =
* Fixed issue in scheduled notification with segments.
= 1.3.8 =
* Fixed auto push functionality in general settings section. 
= 1.3.7 =
* Updated new plugin design and functionality. 
= 1.3.6 =
* Improved page speed and API response.
= 1.3.5 =
* Updated plug-in description and tags
= 1.3.4 =
* UTM parameter settings are incorporated in general settings.
= 1.3.3 =
* Fixed special characters issue while sending the notification.
= 1.3.1 =
* Fixed issue while posting printing an array.
= 1.3.2 =
* Support for wordpress version 4.7
= 1.3.0 =
* Require interaction of a notification option is now available in general settings.
= 1.2.9 =
* Updated require interaction functionality while creating notification.
= 1.2.8 =
* Fixed display send notification checkbox issue in scheduled notification section.
= 1.2.7 =
* Fixed issue in save draft checkbox display issue.
= 1.2.6 =
* Updated dashboard page user interface. 
= 1.2.5 =
* HTTPS installation issues fixed.
= 1.2.4 =
Fixed notification issue while saving the post as draft.
= 1.2.3 =
Fixed notification issue in New Post section.
= 1.2.2 =
Resolved HTTPS issue and fixed minor issues.
= 1.2.1 =
Fixed CSS issue. Incorporated advanced options for new notification section(Segments, Scheduled, User Interarction and Expiry)
= 1.2 =
This version upgrades the dashboard with several new features.  Also, fixed a CSS Bug. Recommend to upgrade immediately.
= 1.1 =
This version fixes some minor issues in plugin. Upgrade immediately.
= 1.0 =
This version fixes a security related bug. Upgrade immediately.