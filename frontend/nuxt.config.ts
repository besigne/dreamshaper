import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  runtimeConfig:{
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE,
    },
  },
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],
  vite: {
    plugins: [
      tailwindcss(),
    ],
  },
});
