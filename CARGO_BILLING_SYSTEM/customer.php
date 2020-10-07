<!-- files css,js,etc -->
<?php require_once "./includes/files.php"; ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
  </ol>
</nav>



<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
			<div class="card border-info">
			<div class="card-header bg-info text-white"><h5><b>Recently Added Customers</b></h5></div>
			<div class="card-body">
						
			</div>
		</div>
		</div>

<!-- Serach customer -->
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card-header bg-info text-white"><h5><b>Search Customer</b></h5></div>
			<div class="card-body">
				<form>
				  <div class="form-group row">
				    <label for="1stname" class="col-sm-3 col-form-label col-form-label-lg">1st Name</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-lg" id="1stname">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="invoicenum" class="col-sm-3 col-form-label col-form-label-lg">Invoice #</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-lg" id="invoicenum">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="mobilenum" class="col-sm-3 col-form-label col-form-label-lg">Mobile No.</label>
				    <div class="col-sm-9">
				      <input type="email" class="form-control form-control-lg" id="mobilenum">
				    </div>
				  </div>
				   <div class="form-group row">
				    <label for="mobilenum" class="col-sm-3 col-form-label col-form-label-lg"></label>
				    <div class="col-sm-9">
				     <button type="submit" class="btn btn-primary btn-larg btn-block"><b>Search</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
		</div>
	</div>
</div>

