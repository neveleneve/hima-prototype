<template>
  <div class="min-h-screen bg-gray-50">
    <nav class="bg-white border-b p-4 flex justify-between">
      <div class="font-bold text-xl">MyProject</div>
      <div class="space-x-4">
        <slot name="nav-links" />
      </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6">
      <slot />
    </main>
  </div>
</template>