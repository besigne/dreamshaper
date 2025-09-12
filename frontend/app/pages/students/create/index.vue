<script setup lang="ts">
import { ref } from "vue";
import { useFetch, useRuntimeConfig } from "#app";

const config = useRuntimeConfig();

const form = ref({
  name: "",
  email: "",
  cpf: "",
});

const error = ref<string | null>(null);

async function submitForm() {
  try {
    error.value = null;
    console.log(form.value.title);
    const { data } = await useFetch(`${config.public.apiBase}/students`, {
      method: "POST",
      body: {
        name: form.value.name,
        email: form.value.email,
        cpf: form.value.cpf,
      },
    });
  } catch (err) {
    error.value = "Failed to submit form.";
    console.error(err);
  }
}

function formatCPF(e: Event) {
  let value = (e.target as HTMLInputElement).value;
  value = value.replace(/\D/g, "");
  value = value.replace(/(\d{3})(\d)/, "$1.$2");
  value = value.replace(/(\d{3})(\d)/, "$1.$2");
  value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
  form.value.cpf = value;
}
</script>

<template>
  <form
    @submit.prevent="submitForm"
    class="max-w-lg w-full mx-auto p-4 m-4 rounded shadow space-y-4"
  >
    <p>Novo Estudante</p>
    <div>
      <label class="block font-medium mb-1">Nome</label>
      <input v-model="form.name" type="text" class="w-full border rounded px-2 py-1" />
    </div>

    <div>
      <label class="block font-medium mb-1">Email</label>
      <input
        v-model="form.email"
        type="email"
        class="w-full border rounded px-2 py-1"
      />
    </div>

    <div>
      <label class="block font-medium mb-1">CPF</label>
      <input
        v-model="form.cpf"
        type="text"
        inputmode="numeric"
        maxlength="14"
        @input="formatCPF"
        class="w-full border rounded px-2 py-1"
      />
    </div>

    <p v-if="error" class="text-red-500">{{ error }}</p>

    <button
      type="submit"
      class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50"
    >
      Cadastrar Estudante
    </button>
  </form>
</template>
