<template>
    <layout>
        <div class="bg-white">
            
            <main class="my-8">
                <div class="container mx-auto px-6">
                    <div class="md:flex md:items-center">
                        <div class="w-full h-64 md:w-1/2 lg:h-96 ">
                            <!-- <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto " :src="'/storage/'+advert.image" alt=""> -->
                            <img v-if="main" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/storage/'+advert.image" alt="">
                            <img v-if="alt_1" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/storage/'+advert.image_1" alt="">                    
                            <img v-if="alt_2" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/storage/'+advert.image_2" alt="">                    
                            <video v-if="video" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" controls>
                                <source :src="env+'/storage/'+advert.video" type="video/mp4">
                            </video>
                        </div>
                        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                            <h3 class="text-gray-700 uppercase text-lg">{{ advert.title }}</h3>
                            <span class="text-gray-500 mt-3">Price: ${{ advert.amount }}</span>
                            <hr class="my-3">
                            <div class="mt-2">
                                <label class="text-gray-700 text-sm" for="desc">Description:</label>
                                <div class="flex items-center mt-1 text-gray-500"> {{ advert.description }} </div>
                            </div>
                            <div class="mt-2">
                                <label class="text-gray-700 text-sm" for="category">Category:</label>
                                <div class="flex items-center mt-1 text-gray-500"> {{ advert.advert_category.name }} </div>
                            </div>
                            <div class="mt-3">
                                <label class="text-gray-700 text-sm" for="count">Contact:</label>
                                <div class="flex items-center text-gray-500 mt-1"> {{ advert.phone_num }} </div>
                            </div>
                            <div class="flex items-center mt-6">
                                <!-- <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Order Now</button>
                                <button class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button> -->
                                <!-- <a :href="'https://www.facebook.com/sharer/sharer.php?u=https://trade-ads.herokuapp.com/advert-details/'+advert.id+'&display=popup'">Share</a> -->
                            </div>
                        </div>
                        
                    </div>

                    <div class="container flex justify-between gap-4 my-8 overflow-auto">
                        <img v-if="advert.image" @click="alt_1 = false, alt_2 = false, video = false, main = true" class="h-32 w-64 rounded-md object-cover max-w-lg mx-auto cursor-pointer" :src="'/storage/'+advert.image" alt="">                    
                        <img v-if="advert.image_1" @click="main = false, alt_2 = false, video = false, alt_1 = true" class="h-32 w-64 rounded-md object-cover max-w-lg mx-auto cursor-pointer" :src="'/storage/'+advert.image_1" alt="">                    
                        <img v-if="advert.image_2" @click="alt_1 = false, main = false, video = false, alt_2 = true" class="h-32 w-64 rounded-md object-cover max-w-lg mx-auto cursor-pointer" :src="'/storage/'+advert.image_2" alt="">                    
                        <video v-if="advert.video" @click="alt_1 = false, main = false, alt_2 = false, video = true" class="h-32 w-64 rounded-md object-cover max-w-lg mx-auto cursor-pointer" :src="'/storage/'+advert.video" alt="">
                            <source :src="'/storage/'+advert.video" type="video/mp4">
                        </video>                  
                    </div>

                    <div class="mt-16">
                        <h3 class="text-gray-600 text-2xl font-medium">Related Ads</h3>
                        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                            <div v-for="related in relateds" :key="related.id" class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                            <div class="flex items-end justify-end h-56 w-full bg-cover" :style="{backgroundImage:`url(/storage/${related.image})`}"></div>
                            <div class="px-5 py-3">
                                <h3 class="text-gray-700 uppercase">{{ related.title }}</h3>
                                <div class="flex justify-between pt-2">
                                    <span class="text-gray-500 mt-2">Price: &dollar;{{ related.amount }} </span>
                                    <button @click="related_id = related.id, showDetails()" class="py-1 px-3 text-gray-100 rounded-lg bg-brown-300 focus:outline-none">View</button>
                                </div>
                                
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="bg-gray-200">
                <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                    <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Trade Ads</a>
                    <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
                </div>
            </footer>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Layouts/Guest'
import ApplicationLogo from '@/Components/ApplicationLogo'
import InertiaLink from '@/Components/NavLink'

export default {
    // layout: Layout,
    components: {
        Layout,
        ApplicationLogo,
        InertiaLink
    },
    props: {
        advert: Object,
        relateds: Object,
        env: String
    },
    setup() {
        
    },
    data () {
        return {
            related_id: '',            
            main: true,
            alt_1: false,
            alt_2: false,
            video: false,
        }
    },
    methods: {
        showDetails() {
            this.$inertia.get('/advert-details/'+this.related_id)
        }
    }
}
</script>