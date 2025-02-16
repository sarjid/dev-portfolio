<script setup>
import { ref } from "vue";
import { Head,Link } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";
import VCodeBlock from "@wdns/vue-code-block";
import { Pagination, Autoplay } from "swiper/modules";
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
const modules = ref([Pagination, Autoplay]);

const code = ref(` const coder = {
    name: "Habil",
    skills: [
        "PHP", "Laravel", "Vue.js", "Vue Router",
        "Vuex", "Pinia", "Nuxt.js", "Inertia.js"
      ],া
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

const props = defineProps({
  hero: Object,
  services: Object,
  teams: Object,
  reviews: Object,
});


const downloadCv = () => {
//   window.open(route('download.cv'), '_blank');
  window.open(route('download.cv'));
}
</script>

<template>
  <Head title="Home" />
  <WebsiteLayout>

        <!-- HERO SECTION START -->
    <section class="hero-section d-flex align-items-center position-relative" id="intro">
      <img
        alt="Hero"
        width="1572"
        height="795"
        class="position-absolute hero-section-img"
        src="/frontend/img/hero.svg"
      />
      <div class="intro_text">
        <svg viewBox="0 0 1320 300">
          <text x="50%" Y="50%" text-anchor="middle">HI</text>
        </svg>
      </div>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="hero-content-box">
              <span class="hero-sub-title"
                >Iam <span style="color: #16f2b3">{{ hero.name }}</span></span
              >
              <h1 class="hero-title">
                {{ hero.title }}
              </h1>

              <div class="hero-image-box d-md-none text-center" v-show="hero.code_snippet">
                <VCodeBlock
                  :code="hero.code_snippet"
                  :copy-button="false"
                  :copy-icons="false"
                  :browser-window="true"
                  highlightjs
                  lang="typescript"
                  theme="neon-bunny-carrot"
                />
              </div>

              <p class="lead">
               {{ hero.description }}
              </p>
              <div class="button-box d-flex flex-wrap align-items-center">
                <a @click.prevent="downloadCv" class="btn tj-btn-secondary"
                  >Download CV <i class="flaticon-download"></i
                ></a>
                <ul class="ul-reset social-icons" v-if="hero.social_links">
                  <li v-for="(hsocial,index) in hero.social_links" :key="index">
                    <a :href="hsocial.url" target="_blank" v-show="hsocial.url">
                        <i :class="hsocial.icon"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 d-none d-md-block">
            <div class="hero-image-box text-center">
              <VCodeBlock
               :code="hero.code_snippet"
                :copy-button="false"
                :copy-icons="false"
                :browser-window="true"
                highlightjs
                lang="typescript"
                theme="neon-bunny-carrot"
              />
              <!-- <img src="frontend/img/hero/me.png" alt="" /> -->
            </div>
          </div>
        </div>

        <div class="funfact-area" id="about-section">
          <div class="row">
            <div class="col-12 col-lg-7">
              <div class="order-2 lg:order-1">
                <p class="who-iam mb-5">Who I am?</p>
                <p class="text-gray-200 text-sm lg:text-lg my-description" v-show="hero.my_description">
                  {{ hero.my_description }}
                </p>
              </div>
            </div>
            <div class="col-12 col-lg-5">
              <div class="flex justify-center order-1 lg:order-2">
                <div class="hero-image-box text-center" v-show="hero.my_image">
                  <img
                    alt="sarjid-islam"
                    width="280"
                    height="280"
                    class="rounded-lg transition-all duration-1000 grayscale hover:grayscale-0 hover:scale-110 cursor-pointer"
                    style="color: transparent"
                    :src="$filters.makeImagePath(hero.my_image)"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- HERO SECTION END -->

    <!-- EDUCATION SECTION START -->
    <section class="resume-section" id="education-section">
      <div class="container">
        <div class="row ">
          <div class="section-header">
            <h2 class="section-title text-center">
              <i class="flaticon-graduation-cap"></i> Education
            </h2>
          </div>
          <div class="col-md-7">
            <img src="/frontend/img/education.png" class="img-fluid" alt="" />
          </div>

          <div class="col-md-5">
            <div class="resume-widget">
              <div class="resume-item">
                  <div class="time">2016 - 2020</div>
                  <h3 class="resume-title">Diploma in Computer Engineering</h3>
                  <div class="institute">Rajshahi Polytechnic Institute</div>
              </div>

              <div class="resume-item">
                <div class="time">2016 - 2020</div>
                <h3 class="resume-title">Diploma in Computer Engineering</h3>
                <div class="institute">Rajshahi Polytechnic Institute</div>
              </div>

              <div class="resume-item">
                <div class="time">2011-2016</div>
                <h3 class="resume-title">Secondary School Certificate</h3>
                <div class="institute">Rasulpur B.L High School</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- EDUCATION SECTION END -->


    <!-- SKILLS SECTION START -->
    <section class="skills-section" id="skills-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-header text-center">
              <h2 class="section-title">My Skills</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div
              class="skills-widget d-flex flex-wrap justify-content-center align-items-center">
              <!-- <Vue3Marquee :pauseOnHover="true"> -->

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/skills-1.svg" alt="" />
                    </div>
                    <div class="number">HTML</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/skills-2.svg" alt="" />
                    </div>
                    <div class="number">CSS3</div>
                  </div>
                </div>
                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/skills-3.svg" alt="" />
                    </div>
                    <div class="number">Javascript</div>
                  </div>
                </div>
                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/vue.svg" alt="" />
                    </div>
                    <div class="number">Vuejs</div>
                  </div>
                </div>
                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/nuxt.svg" alt="" />
                    </div>
                    <div class="number">Nuxtjs</div>
                  </div>
                  <!-- <p>ReactJS</p> -->
                </div>
                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/pinia.svg" alt="" />
                    </div>
                    <div class="number">Pinia</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/vite.svg" alt="" />
                    </div>
                    <div class="number">Vite</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/php.svg" alt="" />
                    </div>
                    <div class="number">Php</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/laravel.svg" alt="" />
                    </div>
                    <div class="number">Laravel</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/mysql.svg" alt="" />
                    </div>
                    <div class="number">MySQL</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/bootstrap.svg" alt="" />
                    </div>
                    <div class="number">Bootstrap</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/tailwind.svg" alt="" />
                    </div>
                    <div class="number">Tailwind</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/git.svg" alt="" />
                    </div>
                    <div class="number">Git</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/inertia.svg" alt="" />
                    </div>
                    <div class="number">Inertia</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/jquery.svg" alt="" />
                    </div>
                    <div class="number">Jquery</div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="skill-inner">
                    <div class="icon-box">
                      <img src="frontend/img/icons/postman.svg" alt="" />
                    </div>
                    <div class="number">Postman</div>
                  </div>
                </div>
              <!-- </Vue3Marquee> -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- SKILLS SECTION END -->


     <!-- EXPERIENCE SECTION START -->
     <section class="resume-section" id="resume-section">
      <div class="container">
        <div class="row">
          <div class="section-header">
            <h2 class="section-title text-center">
                <i class="flaticon-recommendation"></i> Experience
            </h2>
          </div>
          <div class="col-md-6">
            <img src="/frontend/img/experience.png" class="img-fluid" alt="" />
          </div>
          <div class="col-md-6">
            <div class="resume-widget">
              <div class="resume-item">
                  <div class="time">2016 - 2020</div>
                  <h3 class="resume-title">Diploma in Computer Engineering</h3>
                  <div class="institute">Rajshahi Polytechnic Institute</div>
              </div>

              <div class="resume-item">
                <div class="time">2016 - 2020</div>
                <h3 class="resume-title">Diploma in Computer Engineering</h3>
                <div class="institute">Rajshahi Polytechnic Institute</div>
              </div>

              <div class="resume-item">
                <div class="time">2011-2016</div>
                <h3 class="resume-title">Secondary School Certificate</h3>
                <div class="institute">Rasulpur B.L High School</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- EXPERIENCE SECTION END -->



    <!-- start: Service Popup -->
    <div
      id="service-wrapper"
      class="popup_content_area zoom-anim-dialog mfp-hide"
      data-lenis-prevent
    >
      <div class="popup_modal_img">
        <img src="/frontend/img/services/modal-img.jpg" alt="" />
      </div>

      <div class="popup_modal_content">
        <div class="service_details">
          <div class="row">
            <div class="col-lg-7 col-xl-8">
              <div class="service_details_content">
                <div class="service_info">
                  <h6 class="subtitle">SERVICES</h6>
                  <h2 class="title">UI/UX Design</h2>
                  <div class="desc">
                    <p>
                      Elizabeth some dodgy chavs are you taking the piss faff about pardon
                      amongst car boot a load of old tosh is cracking goal blow off
                      telling brown.
                    </p>

                    <p>
                      Brolly show off show off pick your nose and blow off well A bit of
                      how’s your father tomfoolery blimey, me old mucker starkers Queen’s
                      English dropped a clanger bite your arm spiffing good time burke Why
                      chancer. Hotpot bum bag cracking goal young delinquent naff bugger
                      cup of chars bender loo it’s all gone to pot the nancy cheeky.
                    </p>

                    <p>
                      At public school cras bog some dodgy chav Richard Why argy bargy
                      vagabon William bender matie boy, off his nut chancer Jeffrey up the
                      kyver say mufty you mug ummm telling pear shaped Oxford owt to do
                      with me do one so said are you taking his.
                    </p>
                  </div>

                  <h3 class="title">Services Process</h3>
                  <div class="desc">
                    <p>
                      Elizabeth some dodgy chavs are you taking the piss faff about pardon
                      amongst car boot a load of old tosh is cracking goal blow off
                      telling brown.
                    </p>
                  </div>
                  <ul>
                    <li>Reinvent Your Business to Better</li>
                    <li>Pioneering the Internet's First</li>
                    <li>Pioneering the Design World's First</li>
                    <li>Pioneering the Design World's First</li>
                    <li>Pioneering the Design World's First</li>
                    <li>Pioneering the Design World's First</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-xl-4">
              <div class="tj_main_sidebar">
                <div class="sidebar_widget services_list">
                  <div class="widget_title">
                    <h3 class="title">All Services</h3>
                  </div>
                  <ul>
                    <li class="active">
                      <button>
                        <i class="flaticon-design"></i>
                        Branding Design
                      </button>
                    </li>
                    <li>
                      <button>
                        <i class="flaticon-3d-movie"></i>
                        3D Animation
                      </button>
                    </li>
                    <li>
                      <button>
                        <i class="flaticon-ux-design"></i>
                        UI/UX Design
                      </button>
                    </li>
                    <li>
                      <button>
                        <i class="flaticon-web-design"></i>
                        Web Design
                      </button>
                    </li>
                    <li>
                      <button>
                        <i class="flaticon-ui-design"></i>
                        App Design
                      </button>
                    </li>
                  </ul>
                </div>

                <div class="sidebar_widget contact_form">
                  <div class="widget_title">
                    <h3 class="title">Get in Touch</h3>
                  </div>

                  <form action="index.html">
                    <div class="form_group">
                      <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Name"
                        autocomplete="off"
                      />
                    </div>
                    <div class="form_group">
                      <input
                        type="email"
                        name="semail"
                        id="semail"
                        placeholder="Email"
                        autocomplete="off"
                      />
                    </div>
                    <div class="form_group">
                      <textarea
                        name="smessage"
                        id="smessage"
                        placeholder="Your message"
                        autocomplete="off"
                      ></textarea>
                    </div>
                    <div class="form_btn">
                      <button class="btn tj-btn-primary" type="submit">
                        Send Message
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end: Service Popup -->

    <!-- PORTFOLIO SECTION START -->
    <section class="portfolio-section" id="works-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-header text-center">
              <h2 class="section-title">My Recent Projects</h2>
            </div>
          </div>
        </div>

            <!-- <div class="row mb-4">
            <div class="col-md-12">
                <div class="portfolio-filter text-center">
                <div class="button-group filter-button-group">
                    <button class="active">All</button>
                    <button>Laravel</button>
                    <button>Laravel & Vuejs</button>
                    <button>Nuxtjs</button>
                    <div class="active-bg"></div>
                </div>
                </div>
            </div>
            </div> -->

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                    <div class="blog-thumb">
                        <a href="blog-details-light.html">
                        <img src="frontend/img/blog/1.jpg" alt="" />
                        </a>
                        <a href="#" class="category">Tutorial</a>
                    </div>

                    <div class="blog-content">
                        <!-- <div class="blog-meta">
                            <ul class="ul-reset">
                                <li><i class="fa-light fa-calendar-days"></i> Oct 01, 2022</li>
                                <li>
                                <i class="fa-light fa-comments"></i> <a href="#">Comment (0)</a>
                                </li>
                            </ul>
                        </div> -->
                        <h3 class="blog-title">
                        <a href="blog-details-light.html">top 10 ui ux designers</a>
                        </h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                    <div class="blog-thumb">
                        <a href="blog-details-light.html">
                        <img src="frontend/img/blog/2.jpg" alt="" />
                        </a>
                        <a href="#" class="category">TIPS</a>
                    </div>
                    <div class="blog-content">
                        <!-- <div class="blog-meta">
                        <ul class="ul-reset">
                            <li><i class="fa-light fa-calendar-days"></i> Nov 01, 2022</li>
                            <li>
                            <i class="fa-light fa-comments"></i> <a href="#">Comment (0)</a>
                            </li>
                        </ul>
                        </div> -->
                        <h3 class="blog-title">
                        <a href="blog-details-light.html">App Development Guides</a>
                        </h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                    <div class="blog-thumb">
                        <a href="blog-details-light.html">
                        <img src="frontend/img/blog/3.jpg" alt="" />
                        </a>
                        <a href="#" class="category">FREEBIES</a>
                    </div>
                    <div class="blog-content">
                        <!-- <div class="blog-meta">
                        <ul class="ul-reset">
                            <li><i class="fa-light fa-calendar-days"></i> Dec 01, 2022</li>
                            <li>
                            <i class="fa-light fa-comments"></i> <a href="#">Comment (0)</a>
                            </li>
                        </ul>
                        </div> -->
                        <h3 class="blog-title">
                        <a href="blog-details-light.html">learn graphic design free</a>
                        </h3>
                    </div>
                    </div>
                </div>

            </div>


            <div class="d-flex justify-content-center mt-4">
                <button type="button" class="btn tj-btn-primary">
                    Load More
                </button>
            </div>



      </div>
    </section>
    <!-- PORTFOLIO SECTION END -->

    <!-- start: Portfolio Popup -->
    <div
      id="portfolio-wrapper"
      class="popup_content_area zoom-anim-dialog mfp-hide"
      data-lenis-prevent
    >
      <div class="popup_modal_img">
        <img src="/frontend/img/portfolio/modal-img.jpg" alt="" />
      </div>

      <div class="popup_modal_content">
        <div class="portfolio_info">
          <div class="portfolio_info_text">
            <h2 class="title">DStudio</h2>
            <div class="desc">
              <p>
                They are was greater open above shelter lets itself under appear sixth
                open gathering made upon can't own above midst gathering gathered he one
                us saying can't divide.
              </p>
            </div>
            <a href="#" class="btn tj-btn-primary"
              >live preview <i class="fal fa-arrow-right"></i
            ></a>
          </div>
          <div class="portfolio_info_items">
            <div class="info_item">
              <div class="key">Category</div>
              <div class="value">Web Design</div>
            </div>
            <div class="info_item">
              <div class="key">Client</div>
              <div class="value">Artboard Studio</div>
            </div>
            <div class="info_item">
              <div class="key">Start Date</div>
              <div class="value">August 20, 2023</div>
            </div>
            <div class="info_item">
              <div class="key">Designer</div>
              <div class="value"><a href="#">ThemeJunction</a></div>
            </div>
          </div>
        </div>

        <div class="portfolio_gallery owl-carousel">
          <div class="gallery_item">
            <img src="/frontend/img/portfolio-gallery/p-gallery-1.jpg" alt="" />
          </div>
          <div class="gallery_item">
            <img src="/frontend/img/portfolio-gallery/p-gallery-2.jpg" alt="" />
          </div>
          <div class="gallery_item">
            <img src="/frontend/img/portfolio-gallery/p-gallery-3.jpg" alt="" />
          </div>
          <div class="gallery_item">
            <img src="/frontend/img/portfolio-gallery/p-gallery-4.jpg" alt="" />
          </div>
        </div>

        <div class="portfolio_description">
          <h2 class="title">Project Description</h2>
          <div class="desc">
            <p>
              The goal is there are many variations of passages of Lorem Ipsum available,
              but the majority have suffered alteration in some form, by injected humour,
              or randomised words which don't look even slightly believable.
            </p>

            <p>
              There are many variations of passages of Lorem Ipsum available, but the
              majority have suffered alteration in some form, by injected humour, or
              randomised words which don't look even slightly believable. If you are going
              to use a passage of Lorem Ipsum, you need to be sure there isn't anything
              embarrassing hidden in the middle of text.
            </p>
          </div>
        </div>

        <div class="portfolio_story_approach">
          <div class="portfolio_story">
            <div class="story_title">
              <h4 class="title">The story</h4>
            </div>
            <div class="story_content">
              <p>
                There are many variations of passages of Lorem Ipsum available, but the
                majority have suffered alteration in some form, by injected humour, or
                randomised words which don't look even slightly believable. If you are
                going to use a passage of Lorem Ipsum, you need to be sure there isn't
                anything embarrassing hidden in the middle of text. There are many
                variations of passages of Lorem Ipsum available, but the majority have
                suffered alteration in some form, by injected humour, or randomised words
                which don't look even slightly believable. If you are going to use a
                passage of Lorem Ipsum, you need to be sure there isn't anything
                embarrassing hidden in the middle of text.
              </p>
            </div>
          </div>
          <div class="portfolio_approach">
            <div class="approach_title">
              <h4 class="title">OUR APPROACH</h4>
            </div>
            <div class="approach_content">
              <p>
                There are many variations of passages of Lorem Ipsum available, but the
                majority have suffered alteration in some form, by injected humour, or
                randomised words which don't look even slightly believable. If you are
                going to use a passage of Lorem Ipsum, you need to be sure there isn't
                anything embarrassing hidden in the middle of text. There are many
                variations of passages of Lorem Ipsum available, but the majority have
                suffered alteration in some form, by injected humour, or randomised words
                which don't look even slightly believable. If you are going to use a
                passage of Lorem Ipsum, you need to be sure there isn't anything
                embarrassing hidden in the middle of text.
              </p>
            </div>
          </div>
        </div>

        <div class="portfolio_navigation">
          <div class="navigation_item prev-project">
            <a href="#" class="project">
              <i class="fal fa-arrow-left"></i>
              <div class="nav_project">
                <div class="label">Previous Project</div>
                <h3 class="title">Sebastian</h3>
              </div>
            </a>
          </div>

          <div class="navigation_item next-project">
            <a href="#" class="project">
              <div class="nav_project">
                <div class="label">Next Project</div>
                <h3 class="title">Qwillo</h3>
              </div>
              <i class="fal fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- end: Portfolio Popup -->


    <!-- BLOG SECTION STAR -->
    <!-- <section class="blog-section" id="blog-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-header text-center">
              <h2 class="section-title">Recent Blogs</h2>
              <p class="wow fadeInUp">
                We put your ideas and thus your wishes in the form of a unique web project
                that inspires you and you customers.
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="blog-item">
              <div class="blog-thumb">
                <a href="blog-details-light.html">
                  <img src="frontend/img/blog/1.jpg" alt="" />
                </a>
                <a href="#" class="category">Tutorial</a>
              </div>

              <div class="blog-content">
                <div class="blog-meta">
                  <ul class="ul-reset">
                    <li><i class="fa-light fa-calendar-days"></i> Oct 01, 2022</li>
                    <li>
                      <i class="fa-light fa-comments"></i> <a href="#">Comment (0)</a>
                    </li>
                  </ul>
                </div>
                <h3 class="blog-title">
                  <a href="blog-details-light.html">top 10 ui ux designers</a>
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-item">
              <div class="blog-thumb">
                <a href="blog-details-light.html">
                  <img src="frontend/img/blog/2.jpg" alt="" />
                </a>
                <a href="#" class="category">TIPS</a>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <ul class="ul-reset">
                    <li><i class="fa-light fa-calendar-days"></i> Nov 01, 2022</li>
                    <li>
                      <i class="fa-light fa-comments"></i> <a href="#">Comment (0)</a>
                    </li>
                  </ul>
                </div>
                <h3 class="blog-title">
                  <a href="blog-details-light.html">App Development Guides</a>
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-item">
              <div class="blog-thumb">
                <a href="blog-details-light.html">
                  <img src="frontend/img/blog/3.jpg" alt="" />
                </a>
                <a href="#" class="category">FREEBIES</a>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <ul class="ul-reset">
                    <li><i class="fa-light fa-calendar-days"></i> Dec 01, 2022</li>
                    <li>
                      <i class="fa-light fa-comments"></i> <a href="#">Comment (0)</a>
                    </li>
                  </ul>
                </div>
                <h3 class="blog-title">
                  <a href="blog-details-light.html">learn graphic design free</a>
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- BLOG SECTION END -->

    <!-- CONTACT SECTION START -->
    <section class="contact-section" id="contact-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-7 order-2 order-md-1">
            <div class="contact-form-box">
              <div class="section-header">
                <h2 class="section-title">Contact With Me</h2>
                <!-- <p>
                    If you have any questions or concerns, please don't hesitate to contact me. I am open to any work opportunities that align with my skills and interests.
                </p> -->
              </div>

              <div class="tj-contact-form">
                <form id="contact-form">
                  <div class="row gx-3">

                    <div class="col-12">
                        <div class="form_group">
                        <input
                          type="text"
                          name="conEmail"
                          id="conEmail"
                          placeholder="Your name"
                          autocomplete="off"
                        />
                      </div>
                    </div>

                    <div class="col-12">
                        <div class="form_group">
                        <input
                          type="email"
                          name="conEmail"
                          id="conEmail"
                          placeholder="Email address"
                          autocomplete="off"
                        />
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form_group">
                        <textarea
                          name="conMessage"
                          id="conMessage"
                          placeholder="Message"
                        ></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form_btn">
                        <button type="submit" class="btn tj-btn-primary">
                          Send Message
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div
            class="col-lg-5 offset-lg-1 col-md-5 d-flex flex-wrap align-items-center order-1 order-md-2"
          >
            <div class="contact-info-list">
              <ul class="ul-reset">
                <li class="d-flex flex-wrap align-items-center position-relative">
                  <div class="icon-box">
                    <i class="flaticon-phone-call"></i>
                  </div>
                  <div class="text-box">
                    <p>Phone</p>
                    <a href="tel:01722260010">+8801722-260010</a>
                  </div>
                </li>
                <li class="d-flex flex-wrap align-items-center position-relative">
                  <div class="icon-box">
                    <i class="flaticon-mail-inbox-app"></i>
                  </div>
                  <div class="text-box">
                    <p>Email</p>
                    <a href="mailto:sarjid777@gmail.com">sarjid777@gmail.com</a>
                  </div>
                </li>
                <li class="d-flex flex-wrap align-items-center position-relative">
                  <div class="icon-box">
                    <i class="flaticon-location"></i>
                  </div>
                  <div class="text-box">
                    <p>Address</p>
                    <a href="#">Middle Badda, <br />Dhaka, Bangladesh - 1212</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- CONTACT SECTION END -->

    <!-- BEGIN: Contact Form Success Modal Message -->
    <div class="modal contact_modal" id="message_sent" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <span class="modal-title"><strong>Message Sent Successfully</strong></span>
            <button
              type="button"
              class="close"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <p>
              Thank you for contacting us. We will get back to you shortly.<br />Have a
              great day!
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Contact Form Success Modal Message -->

    <!-- BEGIN: Contact Form Fail Modal Message -->
    <div class="modal contact_modal failed" id="message_fail" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <span class="modal-title"><strong>Error</strong></span>
            <button
              type="button"
              class="close"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <p>Oops! Something went wrong, please try again.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Contact Form Fail Modal Message End -->
  </WebsiteLayout>
</template>
