<div class="modal fade" id="deleteModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content shadow">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Удалить запись № <?= $value['id'] ?> <br> Под названием: <?= $value['title'] ?></h5><br>
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
				<form class action="?id=<?= $value['id'] ?>" method="post">
					<button type="submit" name="delete_submit" class="btn btn-danger">Удалить</button>
				</form>
			</div>
		</div>
	</div>
</div>