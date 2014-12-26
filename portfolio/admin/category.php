<?php 
include '../lib/includes.php';
include '../partials/admin_header.php';



/**
 * Suppression catégorie
 */

if(isset($_GET['delete'])){
	checkCsrf();
	$id = $db->quote($_GET['delete']);
	$db->query("DELETE FROM categories WHERE id=$id");
	setFlash('La catégorie a bien été supprimée');
	header('Location:category.php');
	die();
}

/**
 *  Recupère les catégories et les affiches
 */
// requete SELECT
$select = $db->query('SELECT id,name,slug FROM categories');
// FetchAll pour tout récup
$categories = $select->FetchAll();

?>


<h1>Les catégories</h1>

<p><a href="category_edit.php" class="btn btn-warning">Ajouter une nouvelle catégorie</a></p>

<table class="table table-striped">
	<!-- Parcourir les enregistrement sous forme d'un tableau -->
	<thead>
		<tr>
			<th>ID</th>
			<th>Nom</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<!-- Parcour le tableau -->
		<?php foreach($categories as $category): ?>
			<tr>
				<td><?= $category['id']; ?></td>
				<td><?= $category['name'];  ?></td>
				<td>
					<a href="category_edit.php?id=<?= $category['id']; ?>" class="btn btn-success">Editer</a>
					<a href="?delete=<?= $category['id']; ?>&<?= csrf(); ?>" class="btn btn-danger" onclick="return confirm('Etes vous sur ?');">Supprimer</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<?php include '../partials/footer.php';?>