<section class="content-header">
	<h1>
		Configurações
		<small>Cadastre os seus dados para configurar o sistema.</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="#"><i class="fa fa-gear"></i> Configurações</a></li>
	</ol>
</section>
<section class="content">
	<?php echo isset($flash['erro']) ? '<div id="div-alerta" class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flash['erro'].'</div>' : ''; ?>
	<?php echo isset($flash['sucesso']) ? '<div id="div-alerta" class="alert alert-success alert-dismissable">
										<i class="fa fa-check"></i>
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flash['sucesso'].'</div>' : ''; ?>

<div class="container">
	<div class="box">
    <div>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#person" aria-controls="person" role="tab" data-toggle="tab">Dados Pessoais</a></li>
			  <li role="presentation"><a href="#company" aria-controls="company" role="tab" data-toggle="tab">Dados da Empresa</a></li>
			  <li role="presentation"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Dados das Redes Sociais</a></li>
			  <li role="presentation"><a href="#password" aria-controls="password" role="tab" data-toggle="tab">Senhas</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  <div role="tabpanel" class="tab-pane fade in active" id="person">
					<form class="form-horizontal" action="/admin/configuration/person" method="post" enctype="multipart/form-data">
					<fieldset>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="name">Nome</label>
					  <div class="col-md-4">
					  <input id="name" name="name" type="text" placeholder="Nome" class="form-control input-md" required="" value="<?= $users->name ?>">

					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="email">E-mail</label>
					  <div class="col-md-4">
					  <input id="email" name="email" type="text" placeholder="E-mail" class="form-control input-md" required="" value="<?= $users->email ?>">
					  </div>
					</div>

					<!-- File Button -->
					<div class="form-group">
					  <!-- <label class="col-md-4 control-label" for="foto">Foto</label>
					  <div class="col-md-4">
					    <input id="foto" name="foto" class="input-file" type="file">
					  </div> -->
						<label class="col-md-4 control-label" for="foto">Foto</label>
						<div class="col-md-4">
							<input id="foto" placeholder="Escolha uma imagem" disabled="disabled" />
							<div class="fileUpload btn btn-flat btn-primary">
									<span>Upload</span>
									<input id="photo" type="file" name="photo" class="upload" />
							</div>
						</div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="cadPerson"></label>
					  <div class="col-md-4">
					    <button id="cadPerson" name="cadPerson" class="btn btn-success pull-right">Salvar</button>
					  </div>
					</div>

					</fieldset>
					</form>
				</div>
			  <div role="tabpanel" class="tab-pane fade" id="company">
					<form class="form-horizontal">
					<fieldset>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="name">Nome</label>
					  <div class="col-md-4">
					  <input id="name" name="name" type="text" placeholder="Nome" class="form-control input-md">
					  <span class="help-block">Nome fantasia da empresa</span>
					  </div>
					</div>

					<!-- File Button -->
					<div class="form-group">
						<!-- <label class="col-md-4 control-label" for="logo">Logo</label>
						<div class="col-md-4">
							<input id="logo" name="logo" class="input-file" type="file">
						</div> -->
						<label class="col-md-4 control-label" for="logo">Logo</label>
						<div class="col-md-4">
							<input id="logo" placeholder="Escolha uma imagem" disabled="disabled" />
							<div class="fileUpload btn btn-flat btn-primary">
									<span>Upload</span>
									<input id="logo" type="file" name="logo" class="upload" />
							</div>
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="email">E-mail</label>
					  <div class="col-md-4">
					  <input id="email" name="email" type="text" placeholder="E-mail" class="form-control input-md">
					  <span class="help-block">Informe o e-mail da empresa caso use um diferente do pessoal</span>
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="address">Endereço</label>
					  <div class="col-md-4">
					  <input id="address" name="address" type="text" placeholder="Endereço" class="form-control input-md">
					  <span class="help-block">Informe um endereço físico da empresa caso tenha</span>
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="number">Número</label>
					  <div class="col-md-4">
					  <input id="number" name="number" type="text" placeholder="Número" class="form-control input-md">

					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="city">Cidade</label>
					  <div class="col-md-4">
					  <input id="city" name="city" type="text" placeholder="Cidade" class="form-control input-md">

					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="state">Estado</label>
					  <div class="col-md-4">
					  <input id="state" name="state" type="text" placeholder="Estado" class="form-control input-md">

					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="cep">CEP</label>
					  <div class="col-md-4">
					  <input id="cep" name="cep" type="text" placeholder="CEP" class="form-control input-md">

					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="phone">Telefone</label>
					  <div class="col-md-4">
					  <input id="phone" name="phone" type="text" placeholder="(55) 1234 - 1234" class="form-control input-md">

					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="textinput">Horário</label>
					  <div class="col-md-4">
					  <input id="textinput" name="textinput" type="text" placeholder="Sexta: 8:00 AM - 18:00 PM" class="form-control input-md">
					  <span class="help-block">Horário de Atendimento - Sexta: 8:00 AM - 18:00 PM</span>
					  </div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="cadCompany"></label>
					  <div class="col-md-4">
					    <button id="cadCompany" name="cadCompany" class="btn btn-success pull-right">Salvar</button>
					  </div>
					</div>

					</fieldset>
					</form>

			  </div>
			  <div role="tabpanel" class="tab-pane fade" id="social">
					<form class="form-horizontal">
					<fieldset>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="facebook"><i class="fa fa-facebook-square fa-2x text-info"></i></label>
					  <div class="col-md-4">
					  <input id="facebook" name="facebook" type="text" placeholder="https://facebook.com/" class="form-control input-md">
					  <span class="help-block">Copie e cole o endereço do seu perfil/empresa da sua rede social.</span>
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="linkedin"><i class="fa fa-linkedin-square fa-2x text-info"></i></label>
					  <div class="col-md-4">
					  <input id="linkedin" name="linkedin" type="text" placeholder="https://www.linkedin.com/in/..." class="form-control input-md">
					  <span class="help-block">Copie e cole o endereço do seu perfil/empresa da sua rede social.</span>
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="twitter"><i class="fa fa-twitter-square fa-2x text-info"></i></label>
					  <div class="col-md-4">
					  <input id="twitter" name="twitter" type="text" placeholder="https://twitter.com/..." class="form-control input-md">
					  <span class="help-block">Copie e cole o endereço do seu perfil/empresa da sua rede social.</span>
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="gplus"><i class="fa fa-google-plus-square fa-2x text-info"></i></label>
					  <div class="col-md-4">
					  <input id="gplus" name="gplus" type="text" placeholder="https://plus.google.com/..." class="form-control input-md">
					  <span class="help-block">Copie e cole o endereço do seu perfil/empresa da sua rede social.</span>
					  </div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="cadSocial"></label>
					  <div class="col-md-4">
					    <button id="cadSocial" name="cadSocial" class="btn btn-success pull-right">Salvar</button>
					  </div>
					</div>

					</fieldset>
					</form>
				</div>
			  <div role="tabpanel" class="tab-pane fade" id="password">
					<form class="form-horizontal">
					<fieldset>
					<!-- Password input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="password">Senha Atual</label>
					  <div class="col-md-4">
					    <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">

					  </div>
					</div>

					<!-- Password input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="newPassword">Nova Senha</label>
					  <div class="col-md-4">
					    <input id="newPassword" name="newPassword" type="password" placeholder="" class="form-control input-md" required="">

					  </div>
					</div>

					<!-- Password input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="confirmPassword">Confirmar Senha</label>
					  <div class="col-md-4">
					    <input id="confirmPassword" name="confirmPassword" type="password" placeholder="" class="form-control input-md" required="">

					  </div>
					</div>

					</fieldset>
					</form>

			  </div>
			</div>
		</div>
  </div><!-- /.box -->
</div>
</section><!-- /.content -->
