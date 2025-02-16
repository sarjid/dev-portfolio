<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import VCodeBlock from "@wdns/vue-code-block";
import WebsiteNavbar from "@/Layouts/WebsiteNavbar.vue";
import ColorMode from "@/Components/Website/Theme/ColorMode.vue";
import Menu from "@/Components/Website/Menu.vue";

const code = ref(` const coder = {
    name: "Habil",
    skills: [
        "PHP", "Laravel", "Vue.js", "Vue Router",
        "Vuex", "Pinia", "Nuxt.js", "Inertia.js"
      ],
    hardWorker: true,
    quickLearner: true,
    problemSolver: true,
    hireable() {
        return this.hardWorker &&
        this.problemSolver &&
        this.skills.length >= 5;
    }
};

console.log(\`Hireable: \${coder.hireable() ? "Yes" : "No"}\`);
`);

const page = usePage();

const whiteLogo = computed(() => {
  // return page.props?.settings.filter(setting => setting.key === 'logo');
  const logoSetting = page.props?.settings.find(
    (setting) => setting.key === "logo_white"
  );
  return logoSetting ? logoSetting.value : null;
});

//address
const siteAddress = computed(() => {
  const addressSetting = page.props?.settings.find(
    (setting) => setting.key === "address"
  );
  return addressSetting ? addressSetting.value : null;
});

//email
const siteEmail = computed(() => {
  const emailAddress = page.props?.settings.find((setting) => setting.key === "email");
  return emailAddress ? emailAddress.value : null;
});

//phone
const sitePhone = computed(() => {
  const phoneNo = page.props?.settings.find((setting) => setting.key === "phone");
  return phoneNo ? phoneNo.value : null;
});

const faviconUrl = computed(() => {
  const favIconSetting = page.props?.settings.find(
    (setting) => setting.key === "favicon"
  );
  return favIconSetting ? favIconSetting.value : null;
});

const updateFavicon = () => {
  const link = document.getElementById("dynamic-favicon");
  if (link) {
    link.href = faviconUrl.value;
  }
};

onMounted(() => {
  updateFavicon();
});

const isMenuOpen = ref(false);
const toggleMenu = ()=>{
    isMenuOpen.value = !isMenuOpen.value;
}


</script>

<template>
  <!-- <div class="preloader">
    <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
      <path id="preloaderSvg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
    </svg>

    <div class="preloader-heading">
      <div class="load-text">
        <span>L</span>
        <span>o</span>
        <span>a</span>
        <span>d</span>
        <span>i</span>
        <span>n</span>
        <span>g</span>
      </div>
    </div>
  </div> -->
  <!-- Preloader Area End -->

  <!-- start: Back To Top -->
  <div class="progress-wrap" id="scrollUp">
    <svg
      class="progress-circle svg-content"
      width="100%"
      height="100%"
      viewBox="-1 -1 102 102"
    >
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
  </div>
  <!-- end: Back To Top -->

  <!-- HEADER START -->
  <header class="tj-header-area header-absolute">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex flex-wrap align-items-center">
          <div class="logo-box">
            <Link to="/">
              <img src="frontend/img/logo/logo-dark.png" alt="" />
            </Link>
          </div>
          <div class="header-menu d-none d-lg-block" id="headerMenu" >
            <nav>
              <Menu/>
            </nav>
          </div>
            <div class="mobile-menu d-lg-none mean-container"  :class="{'opened':isMenuOpen}">
                <nav class="mean-nav">
                   <Menu @status="toggleMenu"/>
                </nav>
            </div>
          <div class="header-button">
            <ColorMode />
          </div>
          <div class="menu-bar d-lg-none" :class="{'menu-bar-toggeled':isMenuOpen}">
            <button @click.prevent="toggleMenu">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="site-content" id="content">
        <slot/>
  </main>

  <!-- FOOTER AREA START -->
  <footer class="tj-footer-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <!-- <div class="footer-logo-box">
            <a href="#"><img src="frontend/img/logo/logo-dark.png" alt="" /></a>
          </div> -->
          <!-- <div class="footer-menu">
            <nav>
              <ul>
                <li><a href="about-light.html">About</a></li>
                <li><a href="services-light.html">Services</a></li>
                <li><a href="portfolio-light.html">Portfolios</a></li>
                <li><a href="contact-light.html">Contact</a></li>
              </ul>
            </nav>
          </div> -->
          <div class="copy-text">
            <p>
              &copy; {{ new Date().getFullYear() }} Developer Portfolio by
              <a href="#" target="_blank"> Habil</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- FOOTER AREA END -->

  <!-- Page Content -->
</template>
