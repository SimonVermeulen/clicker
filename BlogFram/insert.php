<!DOCTYPE html>
<html>
<head>
<section id="ajouter-chapters">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=3miwn5u5g5p2ialx54r0uiwkn8h1c72el4b9shdzy8vf78t8"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

  <form action="" method="post">
    <p>
      <?= isset($erreurs) && in_array(\Entity\Chapters::INVALID_AUTHOR, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
      <label  class="champs">Auteur</label>
      <input type="text" name="auteur" value="<?= isset($chapters) ? $chapters['auteur'] : $defaultAuthor ?>" /><br />
   
      <?= isset($erreurs) && in_array(\Entity\Chapters::INVALID_TITLE, $erreurs) ? 'Le titre est invalide.<br />' : '' ?>
      <label  class="champs">Titre</label><input type="text" name="titre" value="<?= isset($chapters) ? $chapters['titre'] : '' ?>" /><br />
   
      <?= isset($erreurs) && in_array(\Entity\Chapters::INVALID_CONTENT, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
      <label  class="champs">Contenu</label><textarea rows="8" cols="60" name="contenu"><?= isset($chapters) ? $chapters['contenu'] : '' ?></textarea><br />
  <?php
  if(isset($chapters) && !$chapters->isNew())
  {
  ?>
      <input type="hidden" name="id" value="<?= $chapters['id'] ?>" />
      <input type="submit" value="Modifier" name="modifier" />
  <?php
  }
  else
  {
  ?>
      <input type="submit" value="Ajouter" />
  <?php
  }
  ?>
    </p>
  </form>
</section>