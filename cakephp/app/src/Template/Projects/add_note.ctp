<div class="container mx-auto px-4 py-6">
	<!-- Title -->
	<h1 class="text-2xl font-bold mb-4 text-gray-800">Add Note for Project: <?= h($project->title) ?></h1>

	<!-- Add Note Form -->
	<?= $this->Form->create($note, ['type' => 'file', 'url' => ['action' => 'addNote', $project->id]]) ?>

	<!-- Title Field -->
	<div class="mb-4">
		<?= $this->Form->control('title', [
			'label' => 'Title',
			'class' => 'w-full px-3 py-2 border rounded-md',
			'required' => true
		]); ?>
	</div>

	<!-- Description Field -->
	<div class="mb-4">
		<?= $this->Form->control('description', [
			'label' => 'Description',
			'type' => 'textarea',
			'class' => 'w-full px-3 py-2 border rounded-md',
			'rows' => 4
		]); ?>
	</div>

	<!-- Image Upload Field -->
	<div class="mb-4">
		<?= $this->Form->control('image', [
			'type' => 'file',
			'label' => 'Upload Image',
			'class' => 'w-full px-3 py-2 border rounded-md',
			'accept' => 'image/*'
		]); ?>
	</div>

	<!-- Buttons -->
	<div class="flex items-center space-x-4">
		<?= $this->Form->button('Save', [
			'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'
		]); ?>
		<a href="<?= $this->Url->build(['controller' => 'Projects', 'action' => 'view', $project->id]) ?>"
			class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
			Cancel
		</a>
	</div>

	<?= $this->Form->end() ?>
</div>