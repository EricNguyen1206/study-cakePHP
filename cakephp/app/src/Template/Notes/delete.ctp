<h1 class="text-4xl font-bold mb-6 text-gray-800">Confirm Delete</h1>

<p class="mb-4 text-lg text-gray-700">Are you sure you want to delete the note titled "<strong><?= h($note->title); ?></strong>"?</p>

<!-- Delete Form -->
<?= $this->Form->create(null, ['url' => ['action' => 'delete', $note->id], 'class' => 'bg-white shadow-lg rounded-lg p-6']) ?>
<div class="flex justify-between">
    <?= $this->Html->link('No, Go Back', ['action' => 'index'], ['class' => 'bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-md transition duration-200']) ?>
    <?= $this->Form->button('Yes, Delete', ['class' => 'bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200']) ?>
</div>
<?= $this->Form->end() ?>