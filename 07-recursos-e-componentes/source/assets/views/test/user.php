<?php $this->layout("base", ["title" => "Editando usuário {$user->first_name}"]); ?>

<?php $this->start("nav"); ?> 
  <a href="./" title="Voltar">Voltar</a>
<?php $this->stop(); ?>

<form action="" method="POST" enctype="multipart/form-data">
  <input type="text" name="firstName" value="<?= $user->first_name ?>">
  <input type="text" name="lastName" value="<?= $user->last_name ?>">
  <input type="text" name="email" value="<?= $user->email ?>">

  <button>Atualizar Usuário</button>
</form>