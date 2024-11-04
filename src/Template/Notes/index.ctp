<div class="bg-background text-foreground min-h-screen p-4">
  <div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-3xl font-bold">My Notes</h1>
      <div class="flex items-center space-x-2">
        <input type="text" placeholder="Search notes..." class="bg-input text-foreground px-3 py-2 !m-0 !rounded-md focus:outline-none" />
        <button class="bg-primary text-primary-foreground px-3 py-2 rounded-md flex">
          Sort
        </button>
      </div>
    </div>
    <?php if (!empty($notes)): ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($notes as $note): ?>
          <div class="bg-card text-card-foreground p-4 rounded-md shadow-md">
            <h2 class="text-lg font-semibold mb-2"><?= h($note['title']) ?></h2>
            <p class="text-sm text-muted-foreground line-clamp-2 text-ellipsis mb-4"><?= h($note['content']) ?></p>
            <div class="w-full flex items-center justify-between">
              <p class=" text-sm text-muted-foreground">Oct 12, 2024, 12:12AM</p>
              <button class="bg-accent text-accent-foreground px-3 py-1 rounded-md">View Details</button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <p>No notes available.</p>
    <?php endif; ?>
  </div>
</div>