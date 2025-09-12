<script setup lang="ts">
import { ref } from "vue";
import { useFetch, useRuntimeConfig } from "#app";

const config = useRuntimeConfig();

const form = ref({
  title: "",
  description: "",
  duration_hours: 0,
});

const error = ref<string | null>(null);

async function submitForm() {
  try {
    error.value = null;
    console.log(form.value.title)
    const { data } = await useFetch(`${config.public.apiBase}/courses`, {
      method: "POST",
      body: {
        name: form.value.title,
        description: form.value.description,
        duration_hours: form.value.duration_hours,
      },
    });
  } catch (err) {
    error.value = "Failed to submit form.";
    console.error(err);
  }
}
</script>

<template>
  <form
    @submit.prevent="submitForm"
    class="max-w-lg w-full mx-auto p-4 m-4 rounded shadow space-y-4"
  >
    <p>Novo Curso</p>
    <div>
      <label class="block font-medium mb-1">Título</label>
      <input v-model="form.title" type="text" class="w-full border rounded px-2 py-1" />
    </div>

    <div>
      <label class="block font-medium mb-1">Descrição</label>
      <textarea
        v-model="form.description"
        rows="4"
        class="w-full border rounded px-2 py-1"
      />
    </div>

    <div>
      <label class="block font-medium mb-1">Horas de duração</label>
      <input
        v-model.number="form.duration_hours"
        type="number"
        min="0"
        class="w-full border rounded px-2 py-1 hide-arrows"
      />
    </div>

    <p v-if="error" class="text-red-500">{{ error }}</p>

    <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50">
      Criar novo curso
    </button>
  </form>
</template>
