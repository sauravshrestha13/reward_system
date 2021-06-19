@if (Session::has('success'))
	<div class="alert alert-success" role="alert" style="position: fixed;right: 20px;bottom: 20px;min-width:500px">
		<strong>Success: </strong>{{Session::get('success')}}
	</div>
@endif

@if (Session::has('error'))
	<div class="alert alert-danger" role="alert" style="position: fixed;right: 20px;bottom: 20px;min-width:500px">
		<strong>Success: </strong>{{Session::get('error')}}
	</div>
@endif

<script>
    setTimeout(function(){ $(".alert").not( ".alert-dismissible" ).fadeOut(3000); }, 3000);
</script>