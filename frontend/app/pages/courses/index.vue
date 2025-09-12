<script setup lang="ts">
import { ref, watch } from "vue";
import { useFetch, useRuntimeConfig } from "#app";
import { useRoute } from "vue-router"

const config = useRuntimeConfig();
const route = useRoute();

const courses = ref({
  data: [],
  current_page: 1,
  last_page: 1,
});

const showDeleteModal = ref(false);
const itemToDelete = ref<number | null>(null);

async function fetchPage(page = 1) {
  const { data, error } = await useFetch(`${config.public.apiBase}/courses`, {
    method: "GET",
    query: { page: page },
  });

  if (data.value) {
    courses.value.data = data.value.data;
    courses.value.current_page = data.value.current_page;
    courses.value.last_page = data.value.last_page;
  }
}

function confirmDelete(id: number) {
  itemToDelete.value = id;
  showDeleteModal.value = true;
}

async function deleteItem() {
  if (itemToDelete.value === null) return;

  
  await useFetch(`${config.public.apiBase}/courses/${itemToDelete.value}`, {
    method: "DELETE",
  });
  
  showDeleteModal.value = false;
  itemToDelete.value = null;
  await fetchPage(items.value.current_page);
  return;
}

function nextPage() {
  if (courses.value.current_page < courses.value.last_page) {
    fetchPage(courses.value.current_page + 1);
  }
}

function prevPage() {
  if (courses.value.current_page <= courses.value.last_page) {
    fetchPage(courses.value.current_page - 1);
  }
}

watch(() => {
  () => route.fullPath
  fetchPage(1);
});
</script>

<template>
  <div class="space-y-4 max-w-6xl mx-auto shadow-sm p-4 w-full mt-5">
    <p><b>Lista de Cursos</b></p>
    <ul class="divide-y divide-gray-200">
      <li
        v-for="course in courses.data"
        :key="course.id"
        class="flex justify-between items-center border-b py-2 px-4 p-4 hover:bg-gray-50"
      >
        <NuxtLink :to="`/courses/${course.id}/edit`">
          <span> {{ course.name }} </span>
        </NuxtLink>
        <button
          @click="confirmDelete(course.id)"
          class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded"
        >
          Delete
        </button>
      </li>
    </ul>

    <div class="flex justify-center space-x-2 mt-4">
      <div class="w-10/12">
        <button
          @click="prevPage"
          :disabled="courses.current_page === 1"
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
        >
          Anterior
        </button>

        <span class="px-3 py-1">
          {{ courses.current_page }} / {{ courses.last_page }}
        </span>
        <button
          @click="nextPage"
          :disabled="courses.current_page === courses.last_page"
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
        >
          Próxima
        </button>
      </div>
      <NuxtLink :to="`/courses/create`">
        <button
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
        >
          Criar novo curso
        </button>
      </NuxtLink>
    </div>
  </div>

  <!-- Delete Modal -->
  <div
    v-if="showDeleteModal"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
  >
    <div class="bg-white p-6 rounded shadow-lg">
      <p>Are you sure you want to delete this course?</p>
      <div class="mt-4 flex justify-end gap-2">
        <button @click="showDeleteModal = false">Cancel</button>
        <button @click="deleteItem" class="text-white bg-red-500 px-4 py-2 rounded">
          Delete
        </button>
      </div>
    </div>
  </div>
</template>
