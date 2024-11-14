<h1>Confirm Delete</h1>

<p>Are you sure you want to delete the note titled "<strong><?= h($note->title); ?></strong>"?</p>

<!-- Delete Form -->
<?= $this->Form->create(null, ['url' => ['action' => 'delete', $note->id]]) ?>
    <?= $this->Form->button('Yes, Delete', ['class' => 'button delete-btn']) ?>
<?= $this->Form->end() ?>

<!-- Cancel Button -->
<?= $this->Html->link('No, Go Back', ['action' => 'index'], ['class' => 'button back-btn']) ?>

<!-- Add some styling for buttons -->
<style>
    .button {
        padding: 10px 20px;
        margin: 5px;
        text-decoration: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
    }
    .delete-btn {
        background-color: #e74c3c;
        border: none;
    }
    .back-btn {
        background-color: #3498db;
        border: none;
    }
    .button:hover {
        opacity: 0.9;
    }
</style>
