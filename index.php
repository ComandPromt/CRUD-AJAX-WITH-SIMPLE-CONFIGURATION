<!doctype html>

<html>

	<head>
	
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<title>Ajax Insert || Update || Delete</title>
		
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			
	</head>
	
	<body>

		<?php
		
		include_once('config.php');
				
		$user_fun = new Userfunction();
		
		$tablas=array('materiales','colores','clientes');
		
		?>
	
		<select id="verTabla" onchange="ver(this.value);">
	
		<?php
		
		for($i=0;$i<count($tablas);$i++){
			
			print '<option id="'.$tablas[$i].'" value="'.$tablas[$i].'">'.$tablas[$i].'
	
			</option>';
		
		}
	
		?>
	
		</select>
		
		<div class="container-fluid">
		
			<div class="container">
				
				<div class="row m-3 text-center">
				
					<div class="col-lg-12">
	
						<h1 class="box-title">Ajax Insert || Update || Delete</h1>
	
					</div>
	
				</div>
	
				<div  class="row justify-content-center">
	
					<div class="col-lg-6">
	
						<button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#exampleModalCenter" >Add Record</button>	
	
					</div>
	
					<div class="col-lg-6">
	
						<input type="text" id="search" class="form-control" placeholder="Search Now">
	
					</div>
	
				</div>
	
				<div class="row mt-5" id="tbl_rec">
			
				</div>
	
			</div>
	
		</div>
		
		<!-- Insert Design Modal -->
			
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		
			<div class="modal-dialog modal-dialog-centered" role="document">
		
				<div class="modal-content">
		
					<div class="modal-header">
		
						<h5 class="modal-title" id="exampleModalCenterTitle">Add New Record</h5>
		
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		
							<span aria-hidden="true">&times;</span>
		
						</button>
		
					</div>
		
					<form method="POST" id="ins_rec">
			
						<div class="modal-body">
			
							<?php  
			
							$tabla=$_GET['pag'];
							
							$valores=$user_fun->verColumnas($tabla);
							
							$conteo=count($valores);
							
							$conteo-=1;
							
							print '<input type="hidden" value="'.$conteo.'" id="conteo_insert"></input>'; 
							
							for($i=0;$i<count($valores);$i++){
							
								if($valores[$i]!='ID'){
									
									print '		  	<div class="form-group">
										
											<label id="valor_insert_'.$i.'">'.$valores[$i].'</label>
											
											<input type="text" class="form-control" name="'.$valores[$i].'" id="insert_'.$i.'">
											
											<span class="error-msg" id="umsg_1"></span>
										
										</div>';
										
								}
								
							
							}
											
							?>
							
						</div>
					
						<div class="modal-footer">
			
							<button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
						
							<button type="submit" class="btn btn-primary" >Add Record</button>
						
						</div>
					
					</form>
			
				</div>
			
			</div>
		
		</div>
			
		<!-- End Insert Modal -->
				
		<!-- Update Design Modal -->
			
		<div class="modal fade" id="updateModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		
			<div class="modal-dialog modal-dialog-centered" role="document">
		
				<div class="modal-content">
		
					<div class="modal-header">
		
						<h5 class="modal-title" id="updateModalCenterTitle">Update Record</h5>
		
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		
							<span aria-hidden="true">&times;</span>
		
						</button>
		
					</div>
		
					<form method="POST" id="updata">
			
						<div class="modal-body">
			
							<?php
				
							print '<input type="hidden" value="'.$conteo.'" id="conteo"></input>'; 
		
							for($i=0;$i<count($valores);$i++){
							
								if($valores[$i]!='ID'){
									
									print '<div class="form-group">
										
											<label id="valor_upd_'.$i.'">'.$valores[$i].'</label>
											
											<input type="text" class="form-control" name="'.$valores[$i].'" id="upd_'.$i.'"/>
											
											<span class="error-msg" id="umsg_1"></span>
										
										</div>';
										
								}
								
							
							}
		
						?>
					
							<div class="form-group">
		
								<span class="success-msg" id="umsg_6"></span>
						
							</div>
					
						</div>
			
						<div class="modal-footer">
			
							<button type="button" class="btn btn-secondary" data-dismiss="modal" id="up_cancle">Cancel</button>
				
							<button type="submit" class="btn btn-primary">Update Record</button>
				
						</div>
			
					</form>	
			
				</div>
			
			</div>
		
		</div>	
			
		<!-- End Update Design Modal -->
			
		<!-- Delete Design Modal -->
			
		<div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
		
		<div class="modal-dialog modal-dialog-centered" role="document">
		
			<div class="modal-content">
			
			<div class="modal-header">
			
				<h5 class="modal-title" id="deleteModalCenterTitle">Are You Sure Delete This Record ?</h5>
		
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				
				<span aria-hidden="true">&times;</span>
				
				</button>
				
			</div>
			
			<div class="modal-body">
			
				<p>If You Click On Delete Button Record Will Be Deleted. We Don't have Backup So Be Carefull.</p>
				
			</div>
			
			<div class="modal-footer">
			
				<button type="button" class="btn btn-secondary" id="de_cancle" data-dismiss="modal">Cancle</button>
				
				<button type="button" class="btn btn-primary" id="deleterec">Delete Now</button>
				
			</div>
			
			</div>
			
		</div>
		
		</div>	
			
		<!-- End Delete Design Modal -->
			
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" type="text/javascript"></script>
		
		<script type="text/javascript">
		
			try{
				
				$("#"+getQueryVariable('pag')).attr('selected','selected');
			
			}
			
			catch (error) {
			}
			
			function getQueryVariable(variable) {
				
				// Estoy asumiendo que query es window.location.search.substring(1);
				
				var query = window.location.search.substring(1);
			
				return query.substring(query.indexOf("=")+1,query.lenght);
			
			}
			
			function ver(valor){
				
				var respuesta=0;
				
				var resultado="";
				
				var pagina=window.location.toString();
			
				if(pagina.indexOf("index.php")==-1){
					
					resultado=window.location+"index.php?pag="+valor;
			
				}
				
				else{
					
					resultado=pagina.substring(0,pagina.indexOf("index.php"));
					
					resultado+="index.php?pag="+valor;
					
				}
				
				document.cookie = "ver="+valor; 
				
				window.location.href =resultado;
			
			}
			
			$(document).ready(function (){
				
				var indiceTabla=0;
				
				$('#tbl_rec').load('record.php');
			
				$('#search').keyup(function (){
					
					var search_data = $(this).val();
					
					$('#tbl_rec').load('record.php', {keyword:search_data});
					
				});
			
				//insert Record
			
				$('#ins_rec').on("submit", function(e){
					
					var contador = document.getElementById('conteo_insert').value;
					
					var valores = [];
					
					var cabeceras = [];
					
					var indice=1;
			
					for(var i=0;i<contador;i++){
			
						cabeceras[i]=document.getElementById('valor_insert_'+indice).innerText;
			
						valores[i]=document.getElementById('insert_'+indice).value;
						
						indice++;
						
						
					}
					
					
					$.ajax({
					
						url:"insprocess.php",
						type:"POST",
						data:{valores : valores,celdas:cabeceras,tabla:getQueryVariable('pag')}
						
					});
					
					
				});
			
				$(document).on("click", "button.editdata", function(){
					
					var datos=new Array();
					
					indiceTabla=$(this).attr('id');
				
					$.ajax({
						
						url:"verDatos.php",
						type:"POST",
						data:{id : indiceTabla,tabla:getQueryVariable('pag')},
						
						success:function(msg){
						
							var respuesta=JSON.parse(msg);
						
						
							var indice=1;
						
							for(var i=0;i<respuesta.length-2;i++){
						
								if(document.getElementById('upd_'+indice)!=null){
						
									document.getElementById('upd_'+indice).value=respuesta[i];
							
								}
							
								indice++;	
								
							}
							
						}
				
					});
			
				});
			
				//Update Record
			
				$('#updata').on("submit", function(e){
			
					var contador = document.getElementById('conteo').value;
			
					var cabeceras = [];
			
					var valores = [];
			
					contador++;
			
					var indice=0;
			
					for(var i=1;i<contador;i++){
			
						if(document.getElementById('valor_upd_'+i).innerText!=null){
							
							cabeceras[indice]=document.getElementById('valor_upd_'+i).innerText;
								
							valores[indice]=document.getElementById('upd_'+i).value;
							
							indice++;
							
						}
										
					}
			
					$.ajax({
					
						url:"updateprocess.php",
						type:"POST",
						data:{valores : valores,celdas:cabeceras,tabla:getQueryVariable('pag'),id:indiceTabla}
							
					});
			
				});
			
				//delete record
			
				var deleteId;
			
				$(document).on("click", "button.deletedata", function(){
			
					deleteId=$(this).attr('id');
				
					deleteId=deleteId.substring(deleteId.indexOf('del_')+4,deleteId.lenght);
			
				});
			
				$('#deleterec').click(function (){
				
					$.ajax({
					
						url:"deleteprocess.php",
						type:"POST",
						data:{tabla:getQueryVariable('pag'),id : deleteId},
							
					});
					
					location.reload();
					
				});
			
			});
		
		</script>

	</body>

</html>