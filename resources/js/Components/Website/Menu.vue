<script setup>
import { ref,onMounted } from 'vue';
const emit = defineEmits(['status']);

const scrollToSection = (sectionId) => {
  const section = document.getElementById(sectionId);
  if (section) {
   emit('status');
    window.scrollTo({
      top: section.offsetTop - 50, // Adjust if you have a fixed header
      behavior: "smooth",
    });
  }
};

onMounted(() => {
  const links = document.querySelectorAll("nav a");
  window.addEventListener("scroll", () => {
    let scrollPosition = window.scrollY + 100;
    links.forEach((link) => {
      const section = document.getElementById(link.getAttribute("href")?.substring(1));
      if (section && section.offsetTop <= scrollPosition && section.offsetTop + section.offsetHeight > scrollPosition) {
        links.forEach((l) => l.classList.remove("active"));
        link.classList.add("active");
      }
    });
  });
});
</script>


<template>
  <nav>
    <ul>
      <li><a href="#" @click.prevent="scrollToSection('about-section')">About</a></li>
      <li>
        <a href="#" @click.prevent="scrollToSection('education-section')">Education</a>
      </li>
      <li><a href="#" @click.prevent="scrollToSection('skills-section')">Skills</a></li>
      <li><a href="#" @click.prevent="scrollToSection('works-section')">Projects</a></li>
      <li><a href="#" @click.prevent="scrollToSection('contact-section')">Contact</a></li>
    </ul>
  </nav>
</template>
