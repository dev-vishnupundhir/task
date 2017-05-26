<link rel="stylesheet" href="<?php echo HTTP_ROOT.'css/front/voicestyle.css';?>"/>
<div class="top1">
	<h1>Data calling</h1>
</div>

<div class="container">

	<!--<div id="chromeFileWarning" class="frame big">
		<b style="color: red;">Warning!</b> Protocol "file" used to load page in Chrome.<br>
		Chrome disables access to microphone when loading from disk, which prevents proper functionality.
		<br><br>
		You can allow working local files, if you start Chrome with the flag <i>'--allow-file-access-from-files'</i>:
		<p>
		<b>OS X: </b><i>'$ open -a Google\ Chrome --args --allow-file-access-from-files'</i>
		<br>
		<b>Windows: </b><i>'"C:\>Program Files\Google\Chrome\Application\chrome.exe" --allow-file-access-from-files'</i>
		<br>
		<b>GNU/Linux: </b><i>'$ chrome --allow-file-access-from-files'</i>
	</div>-->

	<div class="clearfix"></div>

	<div class="frame small">
		<div class="inner loginBox">
			<h3 id="login">Sign in</h3>
			<form id="userForm">
				<input id="username" placeholder="USERNAME"><br>
				<input id="password" type="password" placeholder="PASSWORD"><br>
				<button id="loginUser">Login</button>
				<button id="createUser">Create</button>
			</form>
			<div id="userInfo">
				<h3><span id="username"></span></h3>
				<button id="logOut">Logout</button>
			</div>
		</div>

		<div class="inner takeaways">
			<h3>Takeaways</h3>
			<ul>
				<li>Authenticate users and act on success / failures</li>
				<li>How to create user and login automatically</li>
				<li>After page load, look for an earlier session and try to start it</li>
				<li>Place a web-to-web call</li>
				<li>Wire up the incoming stream + start/stop ringback tone as needed</li>
				<li>Receiving a phone call</li>
				<li>Ending a phone call</li>
			</ul>
		</div>
	</div>

	<div class="frame">
		<h3>Web Call</h3>
		<div id="call">
			<form id="newCall">
				<input id="callUserName" placeholder="Username (alice)"><br>
				<button id="call">Call</button>
				<button id="hangup">Hangup</button>
				<button id="answer">Answer</button>
				
				<audio id="incoming" autoplay></audio>
				<audio id="ringback" src="<?php echo HTTP_ROOT.'img/staticImage/ringback.wav';?>" loop></audio>
				<audio id="ringtone" src="<?php echo HTTP_ROOT.'img/staticImage/phone_ring.wav';?>" loop></audio>
			</form>
		</div>
		<div class="clearfix"></div>
		<div id="callLog">
		</div>
		<div class="error">
		</div>
	</div>
</div>
<script src="<?php echo HTTP_ROOT.'js/front/sinch.min.js'; ?>"></script>
<script src="<?php echo HTTP_ROOT.'js/front/WEBsample.js'; ?>"></script>
