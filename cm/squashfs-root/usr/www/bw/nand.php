<?php
include_once("header.php");
?>


<div class="row">

<div class="col-sm-6">
	<div class="card">
	<div class="card-header text-light bg-primary">Dump Partitions</div>
	  <div class="card-body">
		
		<div class="col-sm-12">
			<div class="card">
			<div class="card-header text-light bg-primary">Image1</div>
			  <div class="card-body">
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=1')">CM Kernel+Bootscript</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=4')">CM Rootfs</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=5')">GW Rootfs</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=8')">Atom Kernel</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=11')">Atom Rootfs</button>
			  </div>
			</div>
		</div><br>
		
		<div class="col-sm-12">
			<div class="card">
			<div class="card-header text-light bg-primary">Image2</div>
			  <div class="card-body">
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=2')">CM Kernel+Bootscript</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=5')">CM Rootfs</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=6')">GW Rootfs</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=9')">Atom Kernel</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=12')">Atom Rootfs</button>
			  </div>
			</div>
		</div><br>
		
		<div class="col-sm-12">
			<div class="card">
			<div class="card-header text-light bg-primary">NVRAM</div>
			  <div class="card-body">
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=3')">CM NVRAM</button>
				<button class="btn bg-arris text-light" type="button" onclick="window.open('partdl.php?p=10')">Atom NVRAM</button>
			
			  </div>
			</div>
		</div>
		
	  </div>
	</div>
</div>

<div class="col-sm-6">
	<div class="card">
	<div class="card-header text-light bg-primary">Flash Partitions</div>
	  <div class="card-body">
		<div class="alert alert-danger" role="alert">
		  If you do not know what you are doing, DO NOT USE THIS. 😠<br>
		  This <b>will</b> brick your device if misused.<br>
		  <b>This does NOT have any safety measures</b> to avoid flashing invalid images of any kind! 😠
		</div>
		
		<div class="col-sm-12">
			<div class="card">
			<div class="card-header text-light bg-primary">Image1</div>
			  <div class="card-body">
			  
				<form action="flashpart.php?p=1" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload CM Kernel+Bootscript</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				<form action="flashpart.php?p=4" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload CM Rootfs</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				<form action="flashpart.php?p=6" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload GW Rootfs</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				
				<form action="flashpart.php?p=8" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload Atom Kernel</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				
				<form action="flashpart.php?p=11" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload Atom Rootfs</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
			  </div>
			</div>
		</div><br>
		
		<div class="col-sm-12">
			<div class="card">
			<div class="card-header text-light bg-primary">Image2</div>
			  <div class="card-body">
								<form action="flashpart.php?p=2v" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload CM Kernel+Bootscript</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				<form action="flashpart.php?p=5" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload CM Rootfs</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				<form action="flashpart.php?p=7" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload GW Rootfs</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				
				<form action="flashpart.php?p=9" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload Atom Kernel</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				
				<form action="flashpart.php?p=12" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload Atom Rootfs</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
			  </div>
			</div>
		</div><br>
		
		<div class="col-sm-12">
			<div class="card">
			<div class="card-header text-light bg-primary">NVRAM</div>
			  <div class="card-body">
				<form action="flashpart.php?p=3" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload CM NVRAM</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
				
				<form action="flashpart.php?p=10" method="POST" enctype="multipart/form-data">			
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text">Upload Atom NVRAM</span>
						  </div>
						 
						   <div class="custom-file">
							<input type="file" class="custom-file-input" id="flashpart" name="flashpart">
							<label class="custom-file-label text-truncate" for="flashpart">Choose file</label>
						  </div>
						  
						  <div class="input-group-append">
							<button class="btn bg-arris text-light" type="submit" name="Submit">Upload</button>
						  </div>
						</div>
				</form>
			  </div>
			</div>
		</div>
	  </div>
	</div>
</div>
</div>
<?php
include_once("footer.php");
?>