<h1>Edit Note</h1>

<?= $this->Form->create($note) ?>

<!-- Title Field -->
<div class="form-group">
    <?= $this->Form->control('title', [
        'label' => 'Title',
        'class' => 'form-control',
        'required' => true
    ]) ?>
</div>

<!-- Description Field -->
<div class="form-group">
    <?= $this->Form->control('description', [
        'label' => 'Description',
        'type' => 'textarea',
        'class' => 'form-control',
        'rows' => 4
    ]) ?>
</div>

<!-- Submit Button -->
<div class="form-group">
    <?= $this->Form->button('Update Note', ['class' => 'button']) ?>
    <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'button']) ?>
</div>

<?= $this->Form->end() ?>
