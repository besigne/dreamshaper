<script setup lang="ts"></script>
<template>
  <header>
    <nav role="navigation" class="flex items-center justify-center text-white">
      <div class="flex-item p-2">
        <NuxtLink to="/" aria-label="dashboard"> Dashboard </NuxtLink>
      </div>
      <div class="flex-item p-2">
        <NuxtLink to="/courses" aria-label="courses"> Cursos </NuxtLink>
      </div>
      <div class="flex-item p-2">
        <NuxtLink to="/students" aria-label="students"> Estudantes </NuxtLink>
      </div>
    </nav>
  </header>
</template>
