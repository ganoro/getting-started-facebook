<?php 
$product = 'phpcloud.com';
$app_id = '242654465805791';
$channel_url = 'http://royganor.my.phpcloud.com/facebook-login/channel.php'; 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <title><?= $product ?></title>
  <meta property="fb:app_id" content="<?= $app_id ?>"> 
<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      //Replace appId with your own
      FB.init({appId: '<?= $app_id ?>', channelUrl: '<?= $channel_url ?>', status: true, cookie: true,
               xfbml: true});
      FB.Canvas.setAutoGrow();
    };
    (function() {
      var e = document.createElement('script'); e.async = true;
      e.src = document.location.protocol +
        '//connect.facebook.net/en_US/all.js';
      document.getElementById('fb-root').appendChild(e);
    }());
  </script>

  <div id="header">
    <div id="container">
      <div id="logo"></div>
    </div>
  </div>
  <div id="content">
    <div id="container">
      <div id="right-sidebar">
        <h1>Getting Started with Your Facebook App on <?=$product?></h1>
        <div class="facebook-plugin">
          <fb:like></fb:like>
        </div>
       	
       	<h2>Introduction</h2>
       	<div id="paragraph-content">
	       	This guide is for Facebook developers who are interested in creating apps on <?= $product ?>.<br/><br/>
	        It assumes no previous knowledge of <?=$product?>, and will walk through every part of the process: creating an app and a <?=$product?> account, setting up local development tools, and deploying changes to your Facebook app.<br/><br/>
	        <div id='address'>
	        1. <a href='#account'>Create an account on <?= $product ?></a><br/>
	        2. <a href='#app'>Create an app on Facebook</a><br/>
	        3. <a href='#devenv'>Setting up development environment</a><br/>
	        4. <a href='#deploy'>Deploy a sample Facebook app to <?= $product ?></a><br/>
	        5. <a href='#push'>Push updates to your Facebook app</a><br/>
	        </div>
       	</div>

       	<h2><a id='account'>Create an Account on <?= $product ?></a></h2>
       	<div id="paragraph-content">
	       	<div style="font-style: italic;">(If you’ve already created a <?= $product ?> account, you can skip to the next section)</div><br/>
	        When you <a href='https://my.phpcloud.com/user/login'>log into <?= $product ?></a> for the first time, you are presented with a screen that has a big blue button, "Start Now".<br/>
	        First, what you are about to create is a "Container". Containers can contain multiple applications and all share a database.
	        Fill in the desired container name, specify the password and click the "Create Container" button.<br/><br/><img alt="Create container" src="new_container.png" width="579" height="222"/><br/>
	        It usually takes about 30 seconds to create a new container. While you are waiting, go ahead and download your access key in the proper format (PEM or PPK).<br/>
        </div>
        
        <h2><a id='app'>Create an App on Facebook</a></h2>
       	<div id="paragraph-content">
	       	Start by going to <a href='https://developers.facebook.com/apps'>Facebook Developers</a> and clicking 'Create New App' in the upper-right corner<br/> <img alt="Create New App" src="create_app.png"></img><br/>
	       	You’ll be presented with this dialog:<br/><br/><img alt="Create New App" src="new_app_d.png"></img><br/>
	       	Enter anything you wish for the app display name and namespace, check the terms box, then click Continue.<br/>
	       	Fill out the captcha in the subsequent dialog and click Submit. After a brief delay you’ll be taken to your Facebook app settings page.<br/>
	       	Fill in the following fields:<br/>
	       	1. App Domain (optional), using my.phpcloud.com will allow you to authenticate users via the Facebook API under your domain.<br/>
	       	2. Website, Site URL: URL for your site, this is your main Web site (not the application .<br/>
	       	3. App on Facebook, Canvas URL: this is the URL that will be pulled from the iframe of the Facebook app.<br/>
	       	4. App on Facebook, Secure Canvas URL: the https version of your app.<br/>
	       	<br/>
	       	The Faceebook App id will be used later on when we deploy the sample application to your container.  
	       	<br/><br/><img alt="Basic Settings" src="basic_settings.png">
       	</div>
       	
       	<h2><a id='devenv'>Setting up development environment</a></h2>
       	<div id="paragraph-content">
	    	To manage and edit your app, you’ll need the <a href='zend-sdk.googlecode.com'>Zend SDK</a> command-line or Eclipse-based tool which also work with the Git revision control system. 
	    	<a href='http://code.google.com/p/zend-sdk/downloads/list'>Download</a> and <a href='http://code.google.com/p/zend-sdk/wiki/InstallSDK'>install</a> the SDK for your OS.<br/><br/>
	    	Once installed, you’ll have access to the <?= $product ?> command from your terminal (use cmd.exe on Windows). Log in using the email address and password for your <?= $product ?> account.<br/><br/>
	    	<div id="pre-content">
		    	<pre style="margin: 0; line-height: 100%">/tools% zend add target -d username:password<br/>Target https://your-container.my.phpcloud.com was added successfully, with id 0</pre>
			</div>
			<br/>The target id  will be used later on when we deploy the facebook app to the target.<br/>
			If you want to learn how to do the same process with Eclipse, refer to <a href='http://code.google.com/p/zend-sdk/wiki/ZendSdkEclipsePlugin'>this user guide</a>.
			<br/>
       	</div>
       	
       	<h2><a id='deploy'>Deploy a sample Facebook app to <?= $product ?></a></h2>
       	<div id="paragraph-content">
			With your <?= $product ?> account and Zend SDK set up, you can start by deploying the application to your container.<br/><br/>
			<div id="pre-content">
		    	<pre style="margin: 0; line-height: 100%">/tools% zend deploy application -r git://github.com/ganoro/facebook-sample-app.git \<br/>  -t <i>&lt;your container id&gt;</i> -m APPID=<i>&lt;your Facebook App id&gt;</i><br/>
Cloning into facebook-sample-app...
remote: Counting objects: 23
remote: Compressing objects: 100% (18/18)
Receiving objects:      100% (23/23)
Resolving deltas:       100% (2/2)
Updating references:    100% (1/1)
The remote name used to keep track of the cloned repository is: origin
Creating facebook-sample-app-1.0.0.zpk deployment package...: 100% (6/6)
Sending package...:     100% (4970/4970)
Application facebook-sample-app (id 31) is deployed to ... 
		    	</pre>
			</div>
			<br/>
			Your Facebook application is ready under your namespace:<br/>
			<img alt="Facebook App" src="app-ready.png">
       	</div>
       	
       	<h2><a id='push'>Push updates to your Facebook app</a></h2>
       	<div id="paragraph-content">
       		We’ll start by grabbing a copy of your app’s sourcecode from Git. Zend SDK provides simple command line tool for this.<br/><br/>
       		<div id="pre-content">
		    	<pre style="margin: 0; line-height: 100%">% zend clone project -r https://<i>&lt;container-name&gt;</i>@<i>&lt;container-name&gt;</i>.my.phpcloud.com/git/facebook-sample-app.git<br/><br/>
Cloning into facebook-sample-app...
Password:
remote: Counting objects: 4
remote: Compressing objects: 100% (3/3)
Receiving objects:      100% (4/4)
Updating references:    100% (1/1)
The remote name used to keep track of the phpCloud repository is: phpcloud
				</pre>
			</div>
			<br/>
			Log in using your <?= $product ?> account password.<br/><br/>
			cd into the directory created by the Zend (git) clone project operation, which will be named the same thing as the app (e.g. facebook-sample-app).
			Let’s tweak something small in the app and push it back up to <?= $product ?>.
			For example, find the line of HTML which shows the title banner (in the app/index.php line 38)<br/><br/>
       		<div id="pre-content">
		    	<pre style="margin: 0; line-height: 100%">&lt;div id="logo"&gt;winefriends&lt;/div&gt;</pre>
			</div>
	    	<br/>
	    	Use your favorite text editor to change this line to:<br/><br/>
       		<div id="pre-content">
		    	<pre style="margin: 0; line-height: 100%">&lt;div id="logo"&gt;My First Facebook App on <?= $product ?>&lt;/div&gt;</pre>
			</div><br/>
	    	Save the file, then use your terminal to commit and push the change:<br/><br/>
       		<div id="pre-content">
		    	<pre style="margin: 0; line-height: 100%">% zend push application
Password:
Counting objects:       6
Finding sources:        100% (6/6)
Getting sizes:          120% (6/5)
Compressing objects:    100% (5/5)
Writing objects:        100% (6/6)
Remote name: refs/heads/master, status: OK
Remote name: refs/heads/master, result: FAST_FORWARD		    	
		    	</pre>
			</div>
			<br/>
	    	Reload the app in your browser. You should see the modified title banner.<br/>
	    	Congratulations, you’re now a Facebook app developer! You can now go to work on your application. <br/><br/>
       	</div>
       	
        <h2>Comments</h2>
		<fb:comments href="http://my.phpcloud.com" height="700px"></fb:comments>
      </div>
    </div>
  </div> 
<div id="footer">
  <div id="container">
  </div>
</div> 
</body>
</html>
