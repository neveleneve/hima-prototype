<script setup>
import GeneralLayout from '@/Layouts/GeneralLayout.vue';
</script>

<template>

  <Head title="Welcome | HIMATEKAPP" />
  <GeneralLayout>
    <template #nav-links>
      <Link href="/login">Login</Link>
    </template>

    <h1 class="text-4xl font-bold">Welcome to the Landing Page</h1>
    <p>This uses the Guest Layout.</p>
  </GeneralLayout>
</template>
