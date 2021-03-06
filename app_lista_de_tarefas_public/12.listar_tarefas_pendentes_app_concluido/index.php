<?php
	$acao = 'recuperar';
	require "tarefa_controller.php";

	

?>


<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script>
		function editar(id, txt_tarefa){
				//criar form de edição
				let form = document.createElement('form')
				form.action = 'tarefa_controller.php?acao=atualizar'
				form.method = 'post'
				form.className = 'row'

				//criar input pra entrada do texto
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefa'
				inputTarefa.className = 'col-9 form-control'
				inputTarefa.value = txt_tarefa

				//criar input hidden pra guardar o id da tarefa
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id

				//criar botão
				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'col-3 btn btn-info'
				button.innerHTML = 'Atualizar'

				//incluir o input, button e hidden input no form
				form.appendChild(inputTarefa)
				form.appendChild(button)
				form.appendChild(inputId)
				//console.log(form)
				//alert(id)

				//selecionar a div tarefa
				let tarefa = document.getElementById('tarefa_'+ id)

				//limpar o texto da div pra inclusão do form
				tarefa.innerHTML = ''

				//incluir form na pagina
				tarefa.insertBefore(form, tarefa[0])

				//alert(txt_tarefa)

			}

			function remover(id){
				location.href = 'index.php?acao=remover&id=' + id
			}

			function marcarRealizada(id){
				location.href = 'index.php?acao=marcarRealizada&id=' + id
			}


		</script>
	
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								<? foreach($tarefas as $indice => $valor) {
									if ($valor->status == 'pendente') { ?>
							<div class="row mb-3 d-flex align-items-center tarefa">
								<div class="col-sm-9" id="tarefa_<?= $valor->id ?>" >
									<?= ucfirst($valor->tarefa)  ?> (<?= ucfirst($valor->status)  ?>)
								</div>
								<div class="col-sm-3 mt-2 d-flex justify-content-between">
									<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $valor->id ?>)"></i>
									<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $valor->id ?>, '<?= $valor->tarefa ?>')"></i>
									<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $valor->id ?>)" ></i> 
								</div>
							</div>
		
								<? } } ?>	


						
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>