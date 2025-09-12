<script setup lang="ts">
import { ref, watch } from "vue";
import { useFetch, useRuntimeConfig } from "#app";
import { useRoute } from "vue-router";

const config = useRuntimeConfig();

const students = ref({
  data: [],
  current_page: 1,
  last_page: 1,
});

async function fetchPage(page = 1) {
  const { data, error } = await useFetch(`${config.public.apiBase}/students`, {
    method: "GET",
    query: { page: page },
  });

  if (data.value) {
    students.value.data = data.value.data;
    students.value.current_page = data.value.current_page;
    students.value.last_page = data.value.last_page;
  }
}

function nextPage() {
  if (students.value.current_page < students.value.last_page) {
    fetchPage(students.value.current_page + 1);
  }
}

function prevPage() {
  if (students.value.current_page <= students.value.last_page) {
    fetchPage(students.value.current_page - 1);
  }
}

watch(() => {
  () => route.fullPath
  fetchPage(1);
});
</script>

<template>
 <div class="space-y-4 max-w-6xl mx-auto shadow-sm p-4 w-full mt-5">
    <p><b>Lista de Estudantes</b></p>
    <ul class="divide-y divide-gray-200">
      <li
        v-for="student in students.data"
        :key="student.id"
        class="flex justify-between items-center border-b py-2 px-4 p-4 hover:bg-gray-50"
      >
        <NuxtLink :to="`/students/${student.id}/edit`">
          <span> {{ student.name }} </span>
        </NuxtLink>
      </li>
    </ul>

    <div class="flex justify-center space-x-2 mt-4">
      <div class="w-10/12">
        <button
          @click="prevPage"
          :disabled="students.current_page === 1"
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
        >
          Anterior
        </button>

        <span class="px-3 py-1">
          {{ students.current_page }} / {{ students.last_page }}
        </span>
        <button
          @click="nextPage"
          :disabled="students.current_page === students.last_page"
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
        >
          Próxima
        </button>
      </div>
      <NuxtLink :to="`/students/create`">
        <button
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
        >
          Criar novo Aluno
        </button>
      </NuxtLink>
    </div>
  </div>
</template>
