<div class="container mx-auto mt-10">
  <h1 class="text-2xl font-bold mb-4">Update Note</h1>

  <?= $this->Form->create($note, ['type' => 'file', 'class' => 'space-y-4']) ?>

  <!-- Field Title -->
  <div>
    <?= $this->Form->control('title', [
      'label' => 'Title',
      'class' => 'w-full px-3 py-2 border rounded-md',
      'required' => true
    ]) ?>
  </div>

  <!-- Field Description -->
  <div>
    <?= $this->Form->control('description', [
      'label' => 'Description',
      'type' => 'textarea',
      'class' => 'w-full px-3 py-2 border rounded-md',
      'rows' => 4
    ]) ?>
  </div>

  <!-- Field Image -->
  <div>
    <label class="block mb-2">Image</label>
    <?= $this->Form->control('image', [
      'type' => 'file',
      'label' => 'Upload Image',
      'class' => 'w-full px-3 py-2 border rounded-md',
      'accept' => 'image/*'
    ]); ?>
    <?php if (!empty($note->image)): ?>
      <img src="<?= h($note->image) ?>" alt="Note Image" class="mt-2 w-32 h-32">
    <?php endif; ?>
  </div>

  <!-- Buttons -->
  <div class="flex items-center space-x-4 mt-6">
    <?= $this->Form->button('Save', [
      'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'
    ]); ?>

    <?= $this->Html->link(__('Back'), 'javascript:history.back()', ['class' => 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded']) ?>
  </div>

  <?= $this->Form->end() ?>
</div>