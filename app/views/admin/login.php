<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Painel Administrativo</title>
        <link rel='shortcut icon' href='img/favicon.png' />
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/AdminLTE.css">
	</head>
	<body class="bg-white">
        <div class="form-box" id="login-box">
            <div class="header bg-grey">
                <img src="/img/logo.png" alt="Photo Commerce">
            </div>
            <form action="/logar" class="form" method="post" accept-charset="utf-8">
                <div class="body">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="E-mail"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" class="form-control" placeholder="Senha"/>
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" name="logar" class="btn bg-grey btn-block">Logar-se</button>
                    <!-- <p><a href="#">Esqueci minha senha!</a></p> -->
                </div>
            </form>

            <div class="margin text-center hidden">
                <br/>
                <?php echo isset($erro) ? '<div class="alert-danger"><b>Os seguintes erros foram encontrados:</b><br />'.$erro.'</div>' : ''?>
            </div>
        </div>
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
	</body>
</html>
