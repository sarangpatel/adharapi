<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>API</title>
</head>
<style>
	.page-padding{
		margin: 2rem;
		padding: 3rem;
	}

	.result-height{
		height:300px !important;
	}
	label.error{
		color:red;
		display:block;
	}

	.ucase{
		text-transform:uppercase;
	}

</style>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="fluid-container page-padding">
	<div class  = "row">
	<div class = "col-md-3">
			<form name = "frmAadhaar" >
				<div class="form-group">
					<label for="exampleFormControlInput1">AAdhaar Number</label>
					<input type="text" class="form-control" name = "aadhaar_num" />
				</div>
				<div class="form-group">
					<button type = "submit" class = "btn btn-primary">Submit</button>
				</div>
			</form>
			<form name = "frmPan"   >
				<div class="form-group">
					<label for="exampleFormControlInput1">PAN Number</label>
					<input type="text" class="form-control ucase" name = "pan_num" />
				</div>
				<div class="form-group">
					<button type = "submit" class = "btn btn-primary">Submit</button>
				</div>
			</form>
	</div>
	<div class = "col-md-9">
		<label>AAdhaar Result:</label>
		<textarea class = "form-control result-height" id = "adhaar-result" rows = "6" ></textarea>
		<div class = "mt-3">&nbsp;</div>
		<label >PAN Result:</label>
		<textarea class = "form-control result-height" id = "pan-result" rows = "6"></textarea>

	</div>
	
</div>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
	$("form[name='frmAadhaar']").validate({
		// Specify validation rules
		rules: {
			aadhaar_num: {
				required: true,
				digits: true,
				minlength:12,
					normalizer: function(value) {
					return $.trim(value);
				}
			}
		},
		submitHandler: function(form) {
			console.log('form aadhaar');
			$(form).find("button[type='submit']").prop('disabled',true);
			$(form).find("button[type='submit']").html("Please wait..." );
			$.ajax({
					url : 'aadhaar-validation.php',
					type: 'POST',
					dataType: 'json',
					data: $(form).serialize()
			})
			.done(function( data, textStatus, jQxhr ){
				$(form).find("button[type='submit']").prop('disabled',false);
				$(form).find("button[type='submit']").html("Submit" );

				$("#adhaar-result").val(data);

			})
			.fail(function( jqXhr, textStatus, errorThrown ){
				$(form).find("button[type='submit']").prop('disabled',false);
				$(form).find("button[type='submit']").html("Submit" );

				console.log('fail', 'message:', textStatus);
			});
			return false;
		}
	});

	$("form[name='frmPan']").validate({
		// Specify validation rules
		rules: {
			pan_num: {
				required: true,
				minlength:10,
				normalizer: function(value) {
					return $.trim(value);
				}
			}
		},
		submitHandler: function(form) {
			console.log('form pan');
			$(form).find("button[type='submit']").prop('disabled',true);
			$(form).find("button[type='submit']").html("Please wait..." );

			$.ajax({
					url : 'pan-validation.php',
					type: 'POST',
					dataType: 'json',
					data: $(form).serialize()
			})
			.done(function( data, textStatus, jQxhr ){
				$(form).find("button[type='submit']").prop('disabled',false);
				$(form).find("button[type='submit']").html("Submit" );

				$("#pan-result").val(data);

			})
			.fail(function( jqXhr, textStatus, errorThrown ){
				$(form).find("button[type='submit']").prop('disabled',false);
				$(form).find("button[type='submit']").html("Submit" );

				console.log('fail', 'message:', textStatus);
			});
			return false;
		}
	});


</script>
</body>
</html>
