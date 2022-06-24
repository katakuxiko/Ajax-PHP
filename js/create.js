let pdf = false;

	$('input[name="pdf"]').change(function(e){
		pdf = e.target.files[0];
	});

$('.create-btn').click((event) => {
	event.preventDefault();
	$(`input`).removeClass('err');
	console.log('------',"btn login")

	let title=$('input[name="title"]').val(),
		description=$('input[name="description"]').val(),
		text=$('textarea[name="text"]').val();
	console.log('------',title,description,text,pdf)
	let formData = new FormData();
	formData.append('title',title);
	formData.append('description',description);
	formData.append('text',text);
	formData.append('pdf',pdf);

	console.log(formData);

	$.ajax({
		url: '../inc/create.php',
		type: 'POST',
		dataType: 'JSON',
		processData: false,
		contentType: false,
		cache: false,
		data: formData,
		success (data){
			if (data.status){
				$('.errorR').text(data.createSuccses);
				location.reload();
			}else{
				if(data.type === 1){
					data.fields.forEach(function(e){
						$(`input[name="${e}"]`).addClass('err');
					});
				}
				$('.errorR').text(data.createSuccses);
				header('Location: ../pages/create.php');}
			
		}
	})
	
	})

