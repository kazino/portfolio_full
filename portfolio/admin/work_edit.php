<?php 
include '../lib/includes.php';

/**
 *  La Sauvegarde
 */
if(isset($_POST['name']) && isset($_POST['slug'])){
	checkCsrf();
	$slug = $_POST['slug'];
	// verification si le slug est valide
	if(preg_match('/^[a-z\-0-9]+$/', $slug)){
		$name = $db->quote($_POST['name']);
		$slug = $db->quote($_POST['slug']);
		$category_id = $db->quote($_POST['category_id']);
		$content = $db->quote($_POST['content']);

		/**
		 * SAUVEGARDE DE LA REALISATION
		 */
		if(isset($_GET['id'])){
			$id = $db->quote($_GET['id']);
			$db->query("UPDATE works SET name=$name, slug=$slug, content=$content, category_id=$category_id WHERE id=$id");
		}else{
			$db->query("INSERT INTO works SET name=$name, slug=$slug, content=$content, category_id=$category_id");
			// recupère le dernière ID
			$_GET['id'] = $db->lastInsertId();

		}

		setFlash('La réalisation a bien été ajoutée');

		/**
		 * ENVOIS DES IMAGES
		 */
		
		$work_id = $db->quote($_GET['id']);
		$files = $_FILES['images'];
		$images = array();
		require ('../lib/image.php');
		foreach ($files['tmp_name'] as $k => $v) {
			$image = array(
				'name' => $files['name'][$k],
				'tmp_name' => $files['tmp_name'][$k]
			);
			$extension = pathinfo($image['name'], PATHINFO_EXTENSION);
			if(in_array($extension, array('jpg','png'))){
				$db->query("INSERT INTO images SET work_id = $work_id");
				$image_id = $db->lastInsertId();
				$image_name = $image_id . '.' . $extension;
				move_uploaded_file($image['tmp_name'], IMAGES . '/works/' . $image_name);
				resizeImage(IMAGES . '/works/' . $image_name, 150,150);
				$image_name = $db->quote($image_name);
				$db->query("UPDATE images SET name=$image_name WHERE id=$image_id");
			}
		}
		header('Location:work.php');
		die();
	}else{
		setFlash('Le slug n\'est pas valide', 'danger');
	}	
}

/**
 * On récupère une réalisation
 */
if(isset($_GET['id'])){
	$id = $db->quote($_GET['id']);
	$select = $db->query("SELECT * FROM works WHERE id=$id");
	// si il n'y pas d'enregistrement
	if($select->rowCount() == 0){
		setFlash("il n'y a pas de réalisation avec cet ID", "danger");
		header('Location:work.php');
		die();
	}
	$_POST = $select->fetch();
}

/**
 * Suppression d'une image
 */

if(isset($_GET['delete_image'])){
	checkCsrf();
	$id = $db->quote($_GET['delete_image']);
	$select = $db->query("SELECT name, work_id FROM images WHERE id=$id");
	$image = $select->fetch();
	$images = glob(IMAGES . '/works/' . pathinfo($image['name'], PATHINFO_FILENAME) . '_*x*.*');
	if(is_array($images)){
		foreach($images as $v){
			unlink($v);
		}
	}
	unlink(IMAGES . '/works/' . $image['name']);
	$db->query("DELETE FROM images WHERE id=$id");
	setFlash("L'image a bien été supprimée");
	header('Location:work_edit.php?id=' . $image['work_id']);
	die();
}


/**
 * Mise en avant d'une image
 */

if(isset($_GET['highlight_image'])){
	checkCsrf();
	$work_id = $db->quote($_GET['id']);
	$image_id = $db->quote($_GET['highlight_image']);
	$db->query("UPDATE works SET image_id=$image_id WHERE id=$work_id");
	setFlash("L'image a bien été mise en avant");
	//header('Location:work_edit.php?id=' . $_GET['id']);
	//die();
}


/**
 * On récupère la liste des catégories
 */
$select = $db->query('SELECT id,name FROM categories ORDER BY name ASC');
$categories = $select->fetchAll();
$categories_list = array();
foreach ($categories as $category) {
	$categories_list[$category['id']] = $category['name'];
}


/**
 * On récupère la liste des images
 */
if(isset($_GET['id'])){
	$work_id = $db->quote($_GET['id']);
	$select = $db->query("SELECT id, name FROM images WHERE work_id=$work_id");
	$images = $select->fetchAll();
}else{
	$images = array();
}

include '../partials/admin_header.php';
?>



<h1>Editer une réalisation</h1>

<div class="row">
	<form action="#" method="POST" enctype="multipart/form-data">
		<div class="col-sm-8">
			<div class="form-group">
				<label for="name">Nom de la réalisation</label>
				<?= input('name'); ?>
			</div>

			<div class="form-group">
				<label for="slug">URL de la réalisation</label>
				<?= input('slug'); ?>
			</div>

			<div class="form-group">
				<label for="content">Contenu de la réalisation</label>
				<?= textarea('content'); ?>
			</div>

			<div class="form-group">
				<label for="category_id">Catégorie</label>
				<?= select('category_id', $categories_list); ?>
			</div>


			<?= csrfInput(); ?>

			<button type="submit" class="btn btn-default">Enregistrer</button>

	</div>
	<div class="col-sm-4">
		<?php foreach ($images as $k => $image): ?>
		<p>
			<img src="<?= WEBROOT; ?>src/img/works/<?= $image['name']; ?>" width="180">
			<a href="?delete_image=<?= $image['id']; ?>&<?= csrf(); ?>" class="label label-danger" onclick="return confirm('Sur de ce choix ?');">Supprimer</a>
			<a href="?highlight_image=<?= $image['id']; ?>&id=<?= $_GET['id'] ?>&<?= csrf(); ?>" class="label label-primary">Mettre à la une</a>
		</p>

		<?php endforeach ?>

			<div class="form-group">
				<input type="file" name="images[]">
				<input type="file" name="images[]" class="hidden" id="duplicate">	
			</div>
			<p><a href="#" class="btn btn-info" id="duplicatebtn">Ajouter une image</a></p>
	</div>
	</form>
</div>

	
<?php ob_start(); ?>
<script src="<?= WEBROOT; ?>src/js/tinymce/tinymce.min.js"></script>
<script>
(function($) {
	
	$('#duplicatebtn').click(function(e) {
		e.preventDefault();
		var $clone = $('#duplicate').clone().attr('id', '').removeClass('hidden');
		$('#duplicate').before($clone);
	});
	
})(jQuery);


tinyMCE.init({
        // General options
        mode : "textareas",
});
</script>

<?php $script = ob_get_clean(); ?>

<?php include '../partials/footer.php';?>
	