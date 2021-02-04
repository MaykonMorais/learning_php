<?php $this->layout("base"); ?>

<?= (new \Source\Core\Session())->flash(); ?>    

<?php foreach ($list as $user): ?>
  <article>
    <h1><?= "{$user->first_name} {$user->last_name}"; ?></h1>
    <p><?= $user->email; ?></p>
    <a href="?id=<?= $user->id; ?>" title="Editar">Editar</a>
  </article>
<?php endforeach;?>