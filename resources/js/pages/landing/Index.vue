<script setup lang="ts">
import 'vue3-carousel/carousel.css';
import DasarAuth from '@/layouts/AuthLayout.vue';
import MainLandingPage from '@/layouts/MainLandingPage.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import { Link } from '@inertiajs/vue3';

const images = [
    'https://i0.wp.com/thefield.asla.org/wp-content/uploads/2017/05/3_duke_quad_markhough.jpg?resize=600%2C400&ssl=1',
    'https://architectplanning.stanford.edu/sites/g/files/sbiybj28271/files/styles/breakpoint_2xl_2x/public/media/image/campus_architectural_and_landscape_highlights_actual_page_banner_0.jpg.webp?itok=kfIcqXi5',
    'https://globaladmissionsv2.s3.amazonaws.com/media/school_pictures/103932551-GettyImages.jpg',
    'https://hips.hearstapps.com/toc.h-cdn.co/assets/16/49/2560x1664/gallery-1481213843-gettyimages-1320614-1.jpg?resize=1200:*',
]
</script>
<style scoped>
.slider {
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.slide-bg {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}

::v-deep(.carousel__prev),
::v-deep(.carousel__next) {
    z-index: 99999 !important;
    color: white;
    fill: white;
}

.carousel__pagination-button::after {
    background-color: white !important;
}

.carousel__pagination-button--active::after {
    background-color: white !important;
}
</style>
<template>
    <MainLandingPage>
        <div class="p-16 w-fit h-100"
            style="position: absolute;top: 0 !important;left: 0 !important;z-index:10; pointer-events: none;">
            <div class="mt-20">
                <h1 class="text-xl sm:text-5xl font-semibold text-center text-white">Education is your best investment
                </h1>
                <p class="text-sm sm:text-xl text-start mt-2 text-white">Get the best education ever for your future.
                    The world is in your hand
                </p>
                <Link :href="route('register')" class="pointer-events-auto">
                    <button
                        class="border-2 border-transparent cursor-pointer bg-slate-50 font-bold mt-4 p-2 rounded-md transition duration-300 hover:text-white hover:bg-transparent hover:border-2 hover:border-white"
                        style="z-index: 200 !important;">Register Now</button>
                </Link>
                <span class="text-white font-medium block mt-2">Already have an account?
                    <Link class="underline pointer-events-auto" :href="route('login')">
                    Login here.
                    </Link>
                </span>
            </div>
        </div>
        <div class="h-100 flex flex-col justify-center items-center w-full rounded-lg w-full"
            style="top: 0; position: relative;">
            <Carousel 
                :autoplay="false" 
                :autoplayTimeout="2000" 
                :wrapAround="true" 
                :transition="1000"
                :pauseAutoplayOnHover="true" 
                :mouseDrag="true" 
                :touchDrag="false" class="slider"
            >
                <Slide v-for="(image, index) in images" :key="index">
                    <div class="slide-bg" :style="{ backgroundImage: `url(${image})` }">
                    </div>
                </Slide>
                <template #addons>
                    <Navigation />
                    <Pagination />

                </template>
            </Carousel>
        </div>
        <div class="mt-10 sm:mt-20 w-full sm:flex">
            <div class="w-full h-100 flex justify-center items-center">
                <div class="rounded-lg bg-green-200 w-80 sm:w-168 h-full" 
                :style="{
                    backgroundImage: `url(https://lirp.cdn-website.com/efc89e53/dms3rep/multi/opt/Virtual-Graduation_Sonnys-Place-640w.jpg)`,
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',   // Optional: centers the image
                    backgroundRepeat: 'no-repeat'
                }"
                >
                </div>
            </div>
            <div class="w-full flex flex-col justify-between">
                <div class="px-8 sm:px-0 text-2xl/13 sm:text-5xl/13 font-semibold"><span class="text-gray-400">Start
                        your path
                        today toward</span> knowledge, growth,<span class="text-gray-400"> and a</span> brighter future
                    <span class="text-gray-400">with endless possibilities ahead.</span>
                </div>
                <a href="/#" style="pointer-events: auto;">
                    <button
                        class="text-white border-3 border-transparent cursor-pointer bg-black font-bold mt-4 p-2 rounded-md transition duration-300 hover:text-black hover:bg-white hover:border-black hover:border-3"
                        style="z-index: 200 !important;">Learn more</button>
                </a>
            </div>
        </div>
        <footer class="mt-20 w-full bg-black p-5">
            <div class="flex bg-green justify-center">
                <span class="text-white">
                    Copyright © 2025 Dimas Surya Prayitna
                </span>
            </div>
        </footer>
    </MainLandingPage>
</template>