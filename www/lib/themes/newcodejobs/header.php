<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$lang = _get("webLang") === "es" ? "es" : "en";
$application = (segment(0, isLang()) === "bookmarks") ? "bookmarks" : "blog";
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>"<?php echo defined("ANGULAR_JS") ? " ng-app" : "";?>>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php echo $this->getMeta(); ?>
	
	<title><?php echo $this->getTitle(); ?></title>
	
	<link href="<?php echo path("blog/rss"); ?>" rel="alternate" type="application/rss+xml" title="RSS <?php echo __("Blog"); ?>" />
	<link href="<?php echo path("bookmarks/rss"); ?>" rel="alternate" type="application/rss+xml" title="RSS <?php echo __("Bookmarks"); ?>" >
	<link href="<?php echo path("codes/rss"); ?>" rel="alternate" type="application/rss+xml" title="RSS <?php echo __("Codes"); ?>" >
	<link href="http://gdata.youtube.com/feeds/api/users/codejobs/uploads" rel="alternate" type="application/rss+xml" title="RSS <?php echo __("Videos"); ?>" >	
	
	<?php	
    	$this->CSS("www/lib/css/default.css", null, false, true);
    	
    	$browser  = browser();
    	$browsers = array("ff", "ie", "sf", "op");

	    if (in_array($browser, $browsers)) {
	    	$this->CSS("$this->themeRoute/css/style_$browser.css", null, false, true);
	    	$this->CSS("$this->themeRoute/css/mediaqueries_$browser.css", null, false, true);
	    } else {
	    	$this->CSS("$this->themeRoute/css/style.css", null, false, true);
	    	$this->CSS("$this->themeRoute/css/mediaqueries.css", null, false, true);
	    }

    	if (segment(0, isLang()) !== "polls") {
    		$this->CSS("polls", "polls", false, true);
    	}
        
		$this->CSS(CORE_PATH ."/vendors/css/frameworks/bootstrap/bootstrap-codejobs.css", null, false, true);
		//$this->CSS(CORE_PATH ."/vendors/css/frameworks/bootstrap/css/bootstrap-responsive.css", null, false, true);

		#$this->CSS(CORE_PATH ."/vendors/css/frameworks/bootstrap/bootstrap.min.css", null, false, true);
		

		if (defined("CODEMIRROR")) {
            $this->CSS("codemirror", null, false, true);
        }

        if (segment(0, isLang()) === "live") {
			$this->CSS("www/lib/scripts/js/tweetscroller/css/utils.css", null, false, true);
			$this->CSS("www/lib/scripts/js/tweetscroller/css/bootstrap-responsive.css", null, false, true);
			$this->CSS("www/lib/scripts/js/tweetscroller/css/tweetscroller.css", null, false, true);
			?>
			<style>
				#top-box ul {
					margin-top: -40px !important;
				}
			</style>
			<?php
		}

		echo $this->getCSS();

		if (segment(0, isLang()) !== "codes" or segment(1, isLang()) !== "add") {
	?>
	<script type="text/javascript" src="<?php echo path("vendors/js/prettify/prettify.js", "zan"); ?>"></script>
	<script>
		addEventListener('load', prettyPrint, false); 
	</script>
    <link href="<?php echo path("vendors/js/prettify/prettify.css", "zan"); ?>" type="text/css" rel="stylesheet" />
	<?php
		}
	?>
	<link rel="shortcut icon" href="<?php echo $this->themePath; ?>/images/favicon.ico">
</head>

<body>	
	<header>
		<div id="fb-root"></div>
		<div id="topbar-wrapper">
			<div id="topbar">
				<nav>
					<ul>
						<li class="current"><a href="#"><?php echo __("Menu")?></a></li>
						<li><a href="<?php echo path(); ?>"><?php echo __("Home"); ?></a></li>
						<li><a href="<?php echo path("codes"); ?>"><?php echo __("Codes"); ?></a></li>
						<!--<li><a href="<?php echo path("jobs"); ?>"><?php echo __("Jobs"); ?></a></li>-->
						<li><a href="<?php echo path("forums"); ?>"><?php echo __("Forums"); ?></a></li>
						<li><a href="http://www.youtube.com/codejobs" target="_blank"><?php echo __("Videos"); ?></a></li>
						<li><a href="<?php echo path("bookmarks"); ?>"><?php echo __("Bookmarks"); ?></a></li>						
						<li>				
					</ul>
				</nav>				

				<div id="top-box-languages" class="toggle">
					<a href="<?php echo path("es"); ?>" title="<?php echo __("Spanish"); ?>" class="flag es-flag"></a>
					<a href="<?php echo path("en"); ?>" title="<?php echo __("English"); ?>" class="flag en-flag"></a>
					<a href="<?php echo path("fr"); ?>" title="<?php echo __("French"); ?>" class="flag fr-flag"></a>
					<a href="<?php echo path("pt"); ?>" title="<?php echo __("Portuguese"); ?>" class="flag pt-flag"></a>
					<a href="<?php echo path("it"); ?>" title="<?php echo __("Italian"); ?>" class="flag it-flag"></a>
				</div>

				<div id="top-box-register" class="toggle">
					<span class="bold"><?php echo __("Are you new on CodeJobs?, Register!"); ?></span><br />

					<form action="<?php echo path("users/register"); ?>" method="post" class="form-register">
						<fieldset>
							<input id="register-name" name="name" class="register-input" type="text" required placeholder="<?php echo __("Full Name"); ?>" /> <br />
							<input id="register-email" name="email" class="register-input" type="email" required placeholder="Email" /> <br />
							<input id="register-password" name="password" class="register-input" type="password" required placeholder="<?php echo __("Password"); ?>" /> <br />
							<input name="register" class="register-submit" type="submit" value="<?php echo __("Register on CodeJobs!"); ?>" />
							<br />
							<a href="<?php echo path("users/service/facebook/login"); ?>" title="<?php echo __("Sign in with Facebook"); ?>"><img src="<?php echo path("www/applications/users/views/images/login/facebook_$lang.png", true); ?>" alt="<?php echo __("Sign in with Facebook"); ?>" class="no-border" /><br /><a href="<?php echo path("users/service/twitter"); ?>" title="<?php echo __("Sign in with Twitter"); ?>"><img src="<?php echo path("www/applications/users/views/images/login/twitter_$lang.png", true); ?>" alt="<?php echo __("Sign in with Twitter"); ?>" class="no-border" /></a>
						</fieldset>
					</form>
				</div>

				<div id="top-box-login" class="toggle">
					<span class="bold"><?php echo __("Do you Have an account?, Login!"); ?></span><br />

					<form action="<?php echo (segment(0, isLang()) !== "users" or segment(1, isLang()) !== "login") ? path("users/login/?return_to=". urlencode(getURL())) : getURL(); ?>" method="post" class="form-login">
						<fieldset>
							<input id="login-username" name="username" class="login-input" type="text" required placeholder="<?php echo __("Username or Email"); ?>" /> <br />
							<input id="login-password" name="password" class="login-input" type="password" required placeholder="<?php echo __("Password"); ?>" /> 
							<br />
							<a href="<?php echo path("users/recover"); ?>"><?php echo __("Forgot your password?"); ?></a>

							<input name="login" class="login-submit" type="submit" value="<?php echo __("Login"); ?>" />		 					
							<br />
							<br />
							<a href="<?php echo path("users/service/facebook/login"); ?>" title="<?php echo __("Sign in with Facebook"); ?>"><img src="<?php echo path("www/applications/users/views/images/login/facebook_$lang.png", true); ?>" alt="<?php echo __("Sign in with Facebook"); ?>" class="no-border" /><br /><a href="<?php echo path("users/service/twitter"); ?>" title="<?php echo __("Sign in with Twitter"); ?>"><img src="<?php echo path("www/applications/users/views/images/login/twitter_$lang.png", true); ?>" alt="<?php echo __("Sign in with Twitter"); ?>" class="no-border" /></a>					
						</fieldset>
					</form>
				</div>

				<div id="top-box-profile" class="toggle">
					<div class="top-box-profile">
						<div style="float: left; width: 90px;">
							<?php
								if (substr(SESSION("ZanUserAvatar"), 0, 4) === "http") {
									$avatar = SESSION("ZanUserAvatar");
								} else {
									$avatar = path("www/lib/files/images/users/". SESSION("ZanUserAvatar"), true);
								}
							?>
							<a href="<?php echo path("users/avatar"); ?>" title="<?php echo __("Edit avatar"); ?>"><img src="<?php echo $avatar ?>" alt="<?php echo SESSION("ZanUser"); ?>" class="dotted" style="max-width: 70px;" /></a>
						</div>

						<div style="float: left; width: 170px; line-height: 15px; margin-left: 10px;">
							<span class="bold"><a href="<?php echo path("users/cv"); ?>"><?php echo SESSION("ZanUserName"); ?></a></span> <br />
							<span class="small grey"><a href="<?php echo path("user/". SESSION("ZanUser")); ?>"><?php echo __("See my profile page"); ?></a></span><br />

							<!--div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>
							
							<span class="small grey"><a href="#"><?php echo __("Direct Messages"); ?></a></span><br />
							<span class="small grey"><a href="#"><?php echo __("Help"); ?></a></span><br /-->

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><a href="<?php echo path("blog/admin"); ?>"><?php echo __("My posts"); ?>: <span id="my_blog"><?php echo (int)SESSION("ZanUserPosts"); ?></span></a></span><br />
							<span class="small grey"><a href="<?php echo path("codes/admin"); ?>"><?php echo __("My codes"); ?>: <span id="my_codes"><?php echo (int)SESSION("ZanUserCodes"); ?></span></a></span><br />
							<span class="small grey"><a href="<?php echo path("bookmarks/admin"); ?>"><?php echo __("My bookmarks"); ?>: <span id="my_bookmarks"><?php echo (int)SESSION("ZanUserBookmarks"); ?></span></a></span><br />
							<span class="small grey"><a href="<?php echo path("jobs/vacancy"); ?>"><?php echo __("My Vacancies"); ?></a></span><br />
							<!--span class="small grey"><strong><?php echo __("My courses"); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __("My points"); ?></strong>: 0</span><br /-->

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><a href="<?php echo path("blog/add"); ?>"><?php echo __("Publish a post"); ?></a></span><br />
							<span class="small grey"><a href="<?php echo path("codes/add"); ?>"><?php echo __("Publish a code"); ?></a></span><br />
							<span class="small grey"><a href="<?php echo path("bookmarks/add"); ?>"><?php echo __("Publish a bookmark"); ?></a></span><br />
							<span class="small grey"><a href="<?php echo path("jobs/add"); ?>"><?php echo __("Publish a job"); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><a href="<?php echo path("users/cv"); ?>"><?php echo __("Account settings"); ?></a></span><br />
							<span class="small grey"><a href="<?php echo path("users/deactivate"); ?>"><?php echo __("Deactivate my account"); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<!--span class="small grey"><a href="#"><?php echo __("Update my Resume"); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div-->

							<?php
								if (SESSION("ZanUserPrivilegeID") <= 2) {
								?>
									<span class="small grey"><a href="<?php echo path("cpanel"); ?>"><?php echo __("Go to CPanel"); ?></a></span><br />
								<?php
								}
							?>

							<span class="small grey"><a href="<?php echo path("users/logout"); ?>"><?php echo __("Logout"); ?></a></span><br />
						</div>

						<div class="clear"></div>
					</div>
				</div>				

				<div id="top-box">
					<ul class="top-box-ul">
						<li class="" style="margin-right:5px;">
							<div class="input-append">
								<select id="search-app" class="info" style="width:115px; margin-top: 3px; margin-right: 5px;">
								  	<option value="blog"><?php echo __("Blog"); ?></option>
								  	<option value="codes"><?php echo __("Codes"); ?></option>
								  	<option value="bookmarks"><?php echo __("Bookmarks"); ?></option>								  	
								</select> 
								
								<form id="search-nav">
							  		<input id="search-term" class="span2" placeholder="<?php echo __("Write your search..."); ?>" type="text" style="margin-top: 3px;">
							  		<input id="search-app-hidden" type="hidden">
							  		<input id="search-term-hidden" type="hidden">
							  		<input type="button" id="search" class="btn btn-inverse" style="margin-top: 2px;" value="<?php echo __("Search"); ?>" />
							  	</form>
							</div> 
						</li>
						<li class="">
							<a id="display-languages" href="#" title="<?php echo __("Language"); ?>">
								<?php echo getLanguage(whichLanguage(), true); ?> <?php echo __("Language"); ?> <span class="arrow-down"></span>
							</a>
						</li>
						<?php
							if (!SESSION("ZanUser")) {
						?>
								<li class="">
									<a id="display-register" href="#" title="<?php echo __("Register!"); ?>">
										<?php echo __("Register!"); ?> <span class="arrow-down"></span>
									</a>
								</li>

								<li class="">
									<a id="display-login" href="#" title="<?php echo __("Login"); ?>">
										<?php echo __("Login"); ?> <span class="arrow-down"></span>
									</a>
								</li>
						<?php
							} else {
						?>
								<li class="">
									<a id="display-profile" href="#" title="<?php echo __("Hi"); ?>">
										<?php echo __("Hi") .', <span style="color: #00a0ff">'. SESSION("ZanUser") .'</span>'; ?> <span class="arrow-down"></span>
									</a>
								</li>
						<?php
							}
						?>
					</ul>
				</div>
			</div>

			<div id="search-results" class="search-results">
				<div id="search-results-wrapper" class="search-results-wrapper"></div>
			</div>

			<div class="clear"></div>
		</div>
		<?php
		if (!defined("HIDE_WRAPPER")) {
		?>
			<div id="wrapper">
				<div id="logo">
					<a href="<?php echo path(); ?>"><img src="<?php echo path("www/lib/themes/newcodejobs/images/logo.png", true); ?>" alt="CodeJobs" class="noborder" /></a>
				</div>
			
				<nav>
					<ul>
						<li><a href="<?php echo path("$application/tag/ajax"); ?>">Ajax</a></li>
						<li><a href="<?php echo path("$application/tag/android"); ?>">Android</a></li>
						<li><a href="<?php echo path("$application/tag/backbone"); ?>">Backbone.js</a></li>
						<li><a href="<?php echo path("$application/tag/codeigniter"); ?>">CodeIgniter</a></li>
						<li><a href="<?php echo path("$application/tag/css3"); ?>">CSS3</a></li>
						<li><a href="<?php echo path("$application/tag/databases"); ?>">Databases</a></li>
						<li><a href="<?php echo path("$application/tag/emarketing"); ?>">eMarketing</a></li>
						<li><a href="<?php echo path("$application/tag/git"); ?>">Git &amp; Github</a></li>
						<li><a href="<?php echo path("$application/tag/html5"); ?>">HTML5</a></li>
						<li><a href="<?php echo path("$application/tag/ios"); ?>">iOS</a></li>
						<li><a href="<?php echo path("$application/tag/java"); ?>">Java</a></li>
						<li><a href="<?php echo path("$application/tag/javascript"); ?>">Javascript</a></li>
						<li><a href="<?php echo path("$application/tag/jquery"); ?>">jQuery</a></li>
						<li><a href="<?php echo path("$application/tag/mongodb"); ?>">MongoDB</a></li>
						<li><a href="<?php echo path("$application/tag/mysql"); ?>">MySQL</a></li>
						<li><a href="<?php echo path("$application/tag/nodejs"); ?>">Node.js</a></li>
						<li><a href="<?php echo path("$application/tag/php"); ?>">PHP</a></li>
						<li><a href="<?php echo path("$application/tag/python"); ?>">Python</a></li>
						<li><a href="<?php echo path("$application/tag/ruby"); ?>">Ruby</a></li>
						<li><a href="<?php echo path("$application/tag/ror"); ?>">RoR</a></li>
						<li><a href="<?php echo path("$application/tag/social-media"); ?>">Social Media</a></li>		
						<li><a href="<?php echo path("$application/tag/zanphp"); ?>">ZanPHP</a></li>
					</ul>
				</nav>

				<div class="clear"></div>
			</div>
		<?php
			}
		?>
	</header>
