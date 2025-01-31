<script setup>
import { onMounted, ref, watch } from "vue";
const colorMode = ref(localStorage.getItem("theme") || "light");

onMounted(() => {
  applyMode(colorMode.value);
});

const applyMode = (mode) => {
  if (mode === "dark") {
    document.body.classList.remove("light-mode");
  } else {
    document.body.classList.add("light-mode");
  }
};

const toggleMode = () => {
  colorMode.value = colorMode.value === "dark" ? "light" : "dark";
};

watch(colorMode, (newMode) => {
  applyMode(newMode);
  localStorage.setItem("theme", newMode);
});
</script>

<template>
  <button
    @click="toggleMode"
    class="btn tj-btn-primary btn bg-gradient-secondary text-white d-flex align-items-center px-2 py-1"
    style="width: 45px; height: 30px; transition: all 0.3s"
    onmouseover="this.parentElement.style.right='0'"
    onmouseout="this.parentElement.style.right='-50px'"
  >
    <!-- {{ colorMode }} -->

    <template v-if="colorMode === 'light'">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="m-1"
        viewBox="0 0 512 512"
      >
        <path
          d="M160 136c0-30.62 4.51-61.61 16-88C99.57 81.27 48 159.32 48 248c0 119.29 96.71 216 216 216 88.68 0 166.73-51.57 200-128-26.39 11.49-57.38 16-88 16-119.29 0-216-96.71-216-216z"
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="40"
        ></path>
      </svg>
      <!-- <span class="fs-10 d-block dark:hidden">Dark</span> -->
    </template>
    <template v-else>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="m-1"
        viewBox="0 0 512 512"
      >
        <path
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-miterlimit="10"
          stroke-width="40"
          d="M256 48v48M256 416v48M403.08 108.92l-33.94 33.94M142.86 369.14l-33.94 33.94M464 256h-48M96 256H48M403.08 403.08l-33.94-33.94M142.86 142.86l-33.94-33.94"
        ></path>
        <circle
          cx="256"
          cy="256"
          r="80"
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-miterlimit="10"
          stroke-width="40"
        ></circle>
      </svg>
      <!-- <span class="fs-10 d-block">Light</span> -->
    </template>
  </button>
</template>
