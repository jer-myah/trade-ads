<template>
    <layout>
        <main class="my-8">
            <div class="container mx-auto px-6">
                <h3 class="text-gray-500 text-2xl font-medium pb-2">Categories</h3>
                <select v-model="selected" class="min-w-max border-green-300 focus:border-green-400 " name="" id="">
                    <option value="All" focus>All</option>
                    <option v-for="cat in cats" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                </select>
                <span @click="searchByCategory()" class="mt-3 ml-2 p-3 shadow-md rounded-md cursor-pointer text-sm text-gray-500">Search</span>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    <div v-for="advert in adverts" :key="advert.id" class="w-full max-w-sm mx-auto rounded-md shadow-md ">
                        <!-- <div class="flex items-end justify-end h-56 w-full bg-cover" :style="{backgroundImage:`url(/storage/${advert.image})`}"> -->
                        <div class="flex items-end justify-end h-64 lg:h-96 w-full">
                            <img :src="'/storage/'+advert.image" alt="" class="h-full w-full object-cover" />
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">{{ advert.title }}</h3>
                            <div class="flex justify-between pt-2">
                                <span class="text-gray-500 mt-2">Price: &dollar;{{ advert.amount }} </span>
                                <button @click="advert_id = advert.id, showDetails()" class="py-1 px-3 text-gray-100 rounded-lg bg-brown-300 focus:outline-none">View</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="flex rounded-md mt-8">
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 border-r-0 ml-0 rounded-l hover:bg-blue-500 hover:text-white"><span>Previous</span></a>
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 border-r-0 hover:bg-blue-500 hover:text-white"><span>1</span></a>
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 border-r-0 hover:bg-blue-500 hover:text-white"><span>2</span></a>
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 border-r-0 hover:bg-blue-500 hover:text-white"><span>3</span></a>
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 rounded-r hover:bg-blue-500 hover:text-white"><span>Next</span></a>
                    </div>
                </div>
            </div>
        </main>

        <section class="container my-32">
            <div class="mx-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div v-for="vid in ads_videos" :key="vid.id"> 
                    <video controls>
                        <source :src="env+'/storage/'+vid.video" type="video/mp4">
                    </video>
                    <div>{{ vid.title }}</div>
                </div>
            </div>
        </section>

    </layout>
</template>

<style scoped>
</style>

<script>
import Layout from '@/Layouts/Guest'
import ApplicationLogo from '@/Components/ApplicationLogo'
import InertiaLink from '@/Components/NavLink'
    export default {

        components: {
            Layout,
            ApplicationLogo,
            InertiaLink
        },

        props: {
            auth: Object,
            canLogin: Boolean,
            canRegister: Boolean,
            errors: Object,
            laravelVersion: String,
            phpVersion: String,
            adverts: Object,
            cats: Object,
            ads_videos: Object,
            env: String
        },

        data () {
            return {
                advert_id: '',
                selected: '',
                // form: this.$inertia.form({
                //     category_id: ''
                // })
            }
        },

        methods: {
            showDetails() {
                this.$inertia.get('/advert-details/'+this.advert_id)
            },

            searchByCategory() {
                this.$inertia.get('/adverts-by-category/'+this.selected)                
            }
        }

    }
</script>
