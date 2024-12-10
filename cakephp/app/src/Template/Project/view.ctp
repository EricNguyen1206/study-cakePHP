<div class="container mx-auto p-4">
  <!-- Project Title -->
  <h1 class="text-2xl font-bold mb-4">
    Project: <?= h($project->title) ?>
  </h1>

  <!-- Project Description -->
  <p class="text-gray-700 mb-6">
    <?= h($project->description) ?>
  </p>

  <!-- Notes Section -->
  <h2 class="text-xl font-semibold mb-2">Project Notes</h2>

  <?php if ($notes->isEmpty()): ?>
    <p class="text-gray-500">No notes available for this project.</p>
  <?php else: ?>
    <div class="space-y-4">
      <?php foreach ($notes as $note): ?>
        <div class="border p-4 rounded-lg shadow">
          <h3 class="text-lg font-bold"><?= h($note->title) ?></h3>
          <p class="text-gray-600"><?= nl2br(h($note->description)) ?></p>
          <span class="text-sm text-gray-400">
            Created at: <?= $note->created_at->format('Y-m-d H:i:s') ?>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>