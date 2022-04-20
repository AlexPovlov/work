<!DOCTYPE html>
<html>
<head>
<title><?php echo $title ?></title>
<meta charset="utf-8">
<link rel="stylesheet" href="/public/assets/css/main.css" />
   
</head>
<body>
  <div class="conteiner">
    <div class="header">
      <div class="navigation">
        <a class="navbtm" href="/login">вход </a>
        <a class="navbtm" href="/logout">выход</a>
      </div>
    </div>
    <div class="content">
  
    <?php echo $content ?>
    </div>
    <div class="footer"></div>
  </div>
</body> 

<script src="/public/assets/js/main.js"></script>
</html>