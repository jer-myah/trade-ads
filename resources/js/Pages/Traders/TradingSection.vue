<template>
    <Layout>        
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Trading Section
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Trading Section
                    </p>
                </div>

                <div class="flex pt-3">
                    <div><button class="mx-2 focus:outline-none p-2 bg-blue-300">10 d</button></div>
                    <div><button class="focus:outline-none p-2 bg-yellow-300">2 m</button></div>
                    <div><button class="mx-2 focus:outline-none p-2 bg-green-300">3 s</button></div>
                </div>

                <div>
                    <button class="border text-gray-500 px-3 py-2 focus:outline-none">Main Balance</button><button class="border border-l-0 text-gray-500 px-3 py-2 focus:outline-none">0.00</button>
                    <button class="ml-2 border text-gray-500 px-3 py-2 focus:outline-none">Trading Balance</button><button class="border border-l-0 text-gray-500 px-3 py-2 focus:outline-none">0.00</button>
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
import Button from '@/Components/Button.vue'

export default {
  components: { Button },
    layout: Layout,
    setup() {
        
    },
    props: {
        available_links: Object,
    }
}
</script>