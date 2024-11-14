<h1>Add Note</h1>

<!-- Form for Adding a New Note -->
<div class="notes-form">
    <?= $this->Form->create($note); ?>
    
    <fieldset>
        <legend>Add a New Note</legend>
        
        <?= $this->Form->control('title', ['label' => 'Title']); ?>
        <?= $this->Form->control('description', ['label' => 'Description', 'type' => 'textarea']); ?>
    </fieldset>
    
    <?= $this->Form->button('Save Note'); ?>
    <?= $this->Form->end(); ?>
</div>

<!-- Link to go back to Notes List -->
<p>
    <?= $this->Html->link('Back to Notes List', ['action' => 'index']); ?>
</p>
