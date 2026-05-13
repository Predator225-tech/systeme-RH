<h1>Liste des produits</h1>

<?php if (! empty($produits)) : ?>
<ul>
	<?php foreach ($produits as $produit) : ?>
	<li><?= esc($produit['nom']) ?> - <?= esc($produit['prix']) ?> EUR</li>
	<?php endforeach; ?>
</ul>
<?php else : ?>
<p>Aucun produit trouve.</p>
<?php endif; ?>