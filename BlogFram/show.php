<div id="presentation-chapters">
  <h2 class="col-md-offset-1 col-xs-offset-1"><?= $chapters['titre'] ?></h2>
  <p class="col-md-offset-1 col-xs-offset-1">Par <em><?= $chapters['auteur'] ?></em>, le <?= $chapters['dateAjout']->format('d/m/Y à H\hi') ?></p>
</div>

<div id="texte-chapters" class="col-md-offset-2 col-md-8">
<p><?= nl2br($chapters['contenu']) ?></p>
<?php if ($chapters['dateAjout'] != $chapters['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $chapters['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>
</div>

<h3 id="title-comments" class="col-md-offset-4 col-md-4">Commentaires :</h3>

<div id="comments-part" class="col-md-offset-4 col-md-4">
<?php
if (empty($comments))
{
?>
<p id="petit-comment">Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php
}
?>
<div id="comments">
<?php
foreach ($comments as $comment)
{
?>
  <fieldset>
    <legend>
      Posté par <strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['dateAjout']->format('d/m/Y à H\hi') ?> <a href="/report-<?= $comment['id']?>.html">Signaler</a>
    </legend>
    <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
  </fieldset>
<?php
}
?>
</div>

<div id="comments-form">
<h4>Ajouter un commentaire</h4>
<form action="/commenter-<?= $id ?>.html" method="post">
  <p>
    <?= isset($erreurs) && in_array(\Entity\Comment::INVALID_AUTHOR, $erreurs) ? 'Pseudo invalide.<br />' : '' ?>
    <label>Pseudo</label>
    <input type="text" name="pseudo"/><br />
 
    <?= isset($erreurs) && in_array(\Entity\Comment::INVALID_CONTENT, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
    <label>Contenu</label>
    <textarea name="contenu" rows="7" cols="50"></textarea><br />
    <input type="submit" value="Commenter" />
  </p>
</form>
</div>

</div>