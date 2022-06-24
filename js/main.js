//auth 

$('.login-btn').click((event) => {
	event.preventDefault();
	$(`input`).removeClass('err');
	console.log('------',"btn login")
	let login=$('input[name="login"]').val(),
	 	password=$('input[name="password"]').val();

	$.ajax({
		url: 'inc/sign_in.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			login: login,
			password: password
		},
		success (data){
			if (data.status){
				document.location.href = '/Practik/Practik/pages/profile.php'
			}else{
				if(data.type == 1){
					data.fields.forEach(function(e){
						$(`input[name="${e}"]`).addClass('err');
					});
				}
			$('.error').text(data.message);}
		}
	})
	
	})

	

	//registr 
	let icon = false;

	$('input[name="icon"]').change(function(e){
		icon = e.target.files[0];
	});
$('.registration-btn').click((event) => {
	event.preventDefault();
	$(`input`).removeClass('err');
	console.log('------',"btn login")

	let r_login=$('input[name="r_login"]').val(),
		username=$('input[name="username"]').val(),
		//icon=$('input[name="icon"]').val(),
		re_password=$('input[name="re_password"]').val(),
	 	r_password=$('input[name="r_password"]').val();

	let formData = new FormData();
	formData.append('r_login',r_login);
	formData.append('username',username);
	formData.append('r_password',r_password);
	formData.append('re_password',re_password);
	formData.append('icon',icon);

	console.log(formData)

	$.ajax({
		url: 'inc/sign_up.php',
		type: 'POST',
		dataType: 'JSON',
		processData: false,
		contentType: false,
		cache: false,
		data: formData,
		success (data){
			if (data.status){
				document.location.href ='/Practik/Practik/index.php';
				$('.succses').text(data.message);
			}else{
				if(data.type === 1){
					data.fields.forEach(function(e){
						$(`input[name="${e}"]`).addClass('err');
					});
				}
			$('.errorR').text(data.message);}
		}
	})
	
	})

//create post

