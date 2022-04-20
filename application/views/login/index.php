<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title ?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/public/assets/css/main.css" />
   
</head>
<body>

  <div class="conteiner">

    <div class="content">
        
        <div class="registration-cssave">
            <form action="/login" method="post">
                <h3 class="text-center">Форма входа</h3>
                <div class="form-group">
                    <input class="form-control item" type="text" name="name"  id="username" placeholder="Логин" required>
                </div>
                <div class="form-group">
                    <input class="form-control item" type="password" name="pass"  id="password" placeholder="Пароль" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block create-account" type="submit">Вход в аккаунт</button>
                </div>
            </form>
        </div>

    </div>

    <div class="footer"></div>
  </div>
</body> 

 <script src="/public/assets/js/main.js"></script>
</html>