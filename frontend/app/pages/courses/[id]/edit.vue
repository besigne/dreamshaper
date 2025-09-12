<script setup lang="ts">
import { useRoute, useRuntimeConfig } from "#imports";
import { ref, reactive, onMounted } from "vue";

const route = useRoute();

const config = useRuntimeConfig();

const form = reactive({
  title: "",
  description: "",
  duration_hours: 0,
});

const loading = ref(true);
const error = ref<string | null>(null);

onMounted(async () => {
  const { data, error: fetchError } = await useFetch(
    `${config.public.apiBase}/courses/${route.params.id}`,
    {
      method: "GET",
    }
  );

  if(fetchError.value) {
    error.value = "Error"
  } else if (data.value) {
    form.title = data.value.name,
    form.description = data.value.description,
    form.duration_hours = data.value.duration_hours
  }

  loading.value = false;
});

async function submitForm() {
  try {
    error.value = null;
    const { data } = await useFetch(`${config.public.apiBase}/courses/${route.params.id}`, {
      method: "PUT",
      body: {
        name: form.title,
        description: form.description,
        duration_hours: form.duration_hours,
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
    <p>Editar Curso</p>
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
      Salvar edição
    </button>
  </form>
</template>
