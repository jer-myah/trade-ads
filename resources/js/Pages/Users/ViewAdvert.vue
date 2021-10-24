<template>
    <div>
        <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.success }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <Layout>
            
            <div class="container mx-auto px-6">
                <div class="md:flex md:items-center">
                    <div class="w-full h-64 md:w-1/2 lg:h-96 ">
                        <img v-if="main" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/storage/'+advert.image" alt="">
                        <img v-if="alt_1" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/storage/'+advert.image_1" alt="">                    
                        <img v-if="alt_2" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/storage/'+advert.image_2" alt="">                    
                        <video v-if="video" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" controls autplay>
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
                        <div class="mt-2">
                            <label class="text-gray-700 text-sm" for="package">Package:</label>
                            <div class="flex items-center mt-1 text-gray-500"> {{ advert.advert_package.name }} </div>
                        </div>
                        <div class="mt-3">
                            <label class="text-gray-700 text-sm" for="count">Contact:</label>
                            <div class="flex items-center text-gray-500 mt-1"> {{ advert.phone_num }} </div>
                        </div>
                        <div class="flex items-center mt-6">
                            <a :href="'/user/edit-advert/'+advert.id" class="py-2 px-4 tracking-wider bg-brown-300 hover:bg-brown-500 font-semibold text-gray-500 hover:text-gray-200 rounded-lg transistion duration-200">Edit</a>
                        </div>
                    </div>
                </div>

                <div class="container flex justify-between gap-4 my-8">
                    <img v-if="advert.image" @click="alt_1 = false, alt_2 = false, video = false, main = true" class="h-32 w-64 rounded-md object-cover max-w-lg mx-auto cursor-pointer" :src="'/storage/'+advert.image" alt="">                    
                    <img v-if="advert.image_1" @click="main = false, alt_2 = false, video = false, alt_1 = true" class="h-32 w-64 rounded-md object-cover max-w-lg mx-auto cursor-pointer" :src="'/storage/'+advert.image_1" alt="">                    
                    <img v-if="advert.image_2" @click="alt_1 = false, main = false, video = false, alt_2 = true" class="h-32 w-64 rounded-md object-cover max-w-lg mx-auto cursor-pointer" :src="'/storage/'+advert.image_2" alt="">                    
                    <video v-if="advert.video" @click="alt_1 = false, main = false, alt_2 = false, video = true" class="h-32 w-64 rounded-md object-cover max-w-lg mx-auto cursor-pointer" :src="'/storage/'+advert.video" alt="">
                        <source :src="'/storage/'+advert.video" type="video/mp4">
                    </video>                  
                </div>
            </div>

        </Layout>
    </div>
</template>

<script>
import Layout from '@/Layouts/Authenticated'

export default {
    components: {
        Layout,
    }, 
    props: {
        advert: Object,
        env: String,
    },
    data (){
        return {
            toast: true,
            main: true,
            alt_1: false,
            alt_2: false,
            video: false
        }
    }
}
</script>
