<script src="https://apis.google.com/js/api:client.js"></script>
<script>
var googleUser = {};
var startApp = function() {
	gapi.load('auth2', function(){
		// Retrieve the singleton for the GoogleAuth library and set up the client.
		auth2 = gapi.auth2.init({
	    	client_id: '524131984356-mtit57p7h7a12f7ro1gtqbeij8qb3cuv.apps.googleusercontent.com',
	    	cookiepolicy: 'single_host_origin',
	    	// Request scopes in addition to 'profile' and 'email'
	    	//scope: 'additional_scope'
	  	});
                attachSignin(document.getElementById('customBtn'));
           });
};

function attachSignin(element) {
	auth2.attachClickHandler(element, {},
    function(googleUser) {
            $('#loading1').show();
	    $.ajax({
	        type:'Post',
	        url:ajax_url+'home/checkGoogleUser',
	        data:{id: googleUser.getId(), name: googleUser.getBasicProfile().getName(), email: googleUser.getBasicProfile().getEmail()},
	        success: function(resp){
                            console.log(resp);
                          window.location.replace(resp.response.data);
                            
			},
			error:function(user_response){
                                 $('#loading1').hide();
				console.log(user_response);          
			}            
	    }); 
    }, function(error) {
      alert(JSON.stringify(error, undefined, 2));
    });
}

var revokeAllScopes = function() {
  auth2.disconnect();
  window.location.href = ajax_url+'Members/logout';
}
startApp();
</script>