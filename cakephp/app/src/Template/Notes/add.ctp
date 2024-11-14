<h1 class="text-3xl font-semibold mb-6">Edit Note</h1>

<?= $this->Form->create($note, ['class' => 'bg-white shadow-lg rounded-lg p-6']) ?>

<!-- Title Field -->
<div class="form-group mb-5">
    <?= $this->Form->control('title', [
        'label' => 'Title',
        'class' => 'border border-gray-300 rounded-md p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500',
        'required' => true
    ]) ?>
</div>

<!-- Description Field -->
<div class="form-group mb-5">
    <?= $this->Form->control('description', [
        'label' => 'Description',
        'type' => 'textarea',
        'class' => 'border border-gray-300 rounded-md p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500',
        'rows' => 4
    ]) ?>
</div>

<!-- Submit Button -->
<div class="flex justify-between">
    <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'ml-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md transition duration-200']) ?>
    <?= $this->Form->button('Create Note', ['class' => 'bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200']) ?>
</div>

<?= $this->Form->end() ?>