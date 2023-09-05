<script setup>
import {computed} from "vue";

const date = computed(() => {
  let objectDate = new Date();
  return  objectDate.getFullYear();
});
</script>

<template>
  <footer class="footer"> &copy; {{ date }}. All Righs Reserved.</footer>
</template>