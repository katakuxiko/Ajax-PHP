<div class="modal fade main-right col-lg-8" id="deleteModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content shadow">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Запись № <?= $value['id'] ?></h5>
				<h5 class="modal-title" id="exampleModalLabel">Полное содержание статьи <?= $value['title'] ?></h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<h2 class="mt-2">
			
						 <?= $value['text'] ?>
			
				</h2>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>

			</div>
		</div>
	</div>
</div>