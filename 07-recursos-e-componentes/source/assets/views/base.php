<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title> <?= $title ;?> </title>
</head>
<body>
  <header>
    <h3 class="trigger accept"><?= $title; ?></h3>
  </header>

  <?php if($this->section("nav")):?>
    <nav class="trigger info"><?= $this->section("nav"); ?></nav>
    
    <?php else: ?>
      <p class="trigger info">Lista de Usuários</p>

  <?php endif;?>
  
  
  <?= $this->section("content"); ?>

</body>
</html>