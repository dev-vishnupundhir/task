<div id="fb-root"></div>
<script>
	 
	 window.fbAsyncInit = function() {

		FB.init({
			appId      : '171620140002404',
			cookie     : true,   
			xfbml      : true,  
			version    : 'v2.1' 
		});
	 
		FB.getLoginStatus(function(response) {
			
		}); 
	};
  
	(function(d, s, id){

     var js, fjs = d.getElementsByTagName(s)[0];
 
     if (d.getElementById(id)) {return;}

     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
     
   }(document, 'script', 'facebook-jssdk'));

	 
		 
		function fblogin() {

			FB.login(function(response) {
				if (response.authResponse) {
					FB.api('/me?fields=email,name,picture', function(response) {
						setUserDetails(response);
	                    console.log(response);
					});
				} else {
				  console.log('User cancelled login or did not fully authorize.');
				}
			},{scope: 'email,user_likes'});
		}

   		function setUserDetails(userData){
			$.ajax({
				type:'Post',
				url:ajax_url+'home/checkUser',
				data:userData,
				dataType:'json',
				success:function(user_response){
				console.log(user_response.response.data.redirect_url);
                                   window.location.replace(user_response.response.data.redirect_url);
	                           
				},
				error:function(user_response){
	                                console.log(user_response);          
				}			 
			});   
   		}
	   
	   	function fblogout(){
	       	FB.logout(function(response) {
	       		console.log(response);
	         	deleteuser(); 
	     	});
	   	}

	   	function deleteuser(){
	       $.ajax({
	               type:'Post',
	               url:ajax_url+'home/logout_ajax',
	               dataType:'JSON',
				success:function(user_response){
	                window.location.href =  user_response.redirect_url;
				}
	        });
	 	}
        
    
       
	
  
</script>