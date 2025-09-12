<script setup lang="ts">
import StatisticCard from '@/components/StatisticCard.vue';
import VueApexCharts from "vue3-apexcharts";

const config = useRuntimeConfig();

const { data: student, student_pending, student_error } = await useFetch(
  `${config.public.apiBase}/students/count`
);

const { data: course, course_pending, course_error } = await useFetch(
  `${config.public.apiBase}/courses/count`
);

const { data: chart, chart_pending, chart_error } = await useFetch(
  `${config.public.apiBase}/courses/top-ten`
);

const chartOptions = ref({
  chart: { type: "bar", height: 400 },
  plotOptions: { bar: { horizontal: false, columnWidth: "70%" } },
  xaxis: { categories: chart.value.map((c) => c.name) },
  series: [{ name: "Students", data: chart.value.map((c) => c.enrollments_count) }],
  responsive: [
    {
      breakpoint: 640,
      options: {
        chart: { height: 400 },
        plotOptions: { bar: { columnWidth: '50%' } },
      }
    },
    {
      breakpoint: 320,
      options: {
        chart: { height: 500 },
        plotOptions: { bar: { columnWidth: '40%' } },
      }
    },
  ],
});

</script>
<template>
  <div class="flex m-2 p-2">
    <StatisticCard title="Número total de Cursos" :value='course.total_courses' />
    <StatisticCard title="Número total de Estudantes" :value='student.total_students' />
  </div>
  <div class="flex m-2 p-2 w-6/12">
    <div class="p-4 w-full">
      <h2 class="text-xl font-bold mb-4">Top 10 Cursos com mais estudantes</h2>
      <client-only>
      <VueApexCharts
        type="bar"
        height="400"
        :options="chartOptions"
        :series="chartOptions.series"
      />
      </client-only>
    </div>
  </div>
</template>
