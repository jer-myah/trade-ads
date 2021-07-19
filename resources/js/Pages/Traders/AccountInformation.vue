<template>
    <Layout>
        <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.success }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Advert Information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Detail Information for advert 
                    </p>
                </div>

                <div>
                    <edit-button >Create Link</edit-button>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Title
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            title 
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Description
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            description 
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Image
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            image 
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Organization Location
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            id 
                        </dd>
                    </div> 
                </dl>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/Layouts/Trader'

export default {
    layout: Layout,
    data() {
        return {
            toast: true
        }
    },
    setup() {
        
    },
    props: {
        available_links: Object,
    }
}
</script>