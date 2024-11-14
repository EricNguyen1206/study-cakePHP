<h1 class="text-2xl font-bold mb-4">Edit Note</h1>

<?= $this->Form->create($note, ['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4']) ?>

<!-- Title Field -->
<div class="form-group mb-4">
    <?= $this->Form->control('title', [
        'label' => 'Title',
        'class' => 'form-control border border-gray-300 rounded-lg p-2 w-full',
        'required' => true
    ]) ?>
</div>

<!-- Description Field -->
<div class="form-group mb-4">
    <?= $this->Form->control('description', [
        'label' => 'Description',
        'type' => 'textarea',
        'class' => 'form-control border border-gray-300 rounded-lg p-2 w-full',
        'rows' => 4
    ]) ?>
</div>

<!-- Submit Button -->
<div class="flex justify-between">
    <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'ml-2 bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded']) ?>
    <?= $this->Form->button('Update Note', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) ?>
</div>

<?= $this->Form->end() ?>