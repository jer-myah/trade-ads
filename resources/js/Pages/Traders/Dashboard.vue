<template>
        <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.success }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

    <Layout>
        <div class="container">
            <h2 class="pl-5 font-semibold text-xl text-gray-800 leading-tight">
                Dashboard 
            </h2>
        </div>

        
        <div class="flex items-center">
            <div class="container max-w-6xl px-5 mx-auto my-8">
                <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-4">
                    
                    <div class="p-5 bg-green-100 rounded shadow-sm">                        
                        <div class="flex flex-col items-center pt-1">
                            <div class="text-base text-gray-400 ">Total Links</div>
                            <div class="text-2xl font-bold text-gray-900 ">{{ total_links }}</div>
                        </div>
                    </div>

                    <div class="p-5 bg-red-100 rounded shadow-sm">
                        <div class="flex flex-col items-center pt-1">
                            <div class="text-base text-gray-400 ">Total Amount</div>
                            <div class="text-2xl font-bold text-gray-900 ">752</div>                            
                        </div>
                    </div>
                    <div class="p-5 bg-pink-100 rounded shadow-sm">                        
                        <div class="flex flex-col items-center pt-1">
                            <div class="text-base text-gray-400 ">Abstracts</div>
                            <div class="text-2xl font-bold text-gray-900 ">1375</div>                            
                        </div>
                    </div>
                    <div class="p-5 bg-indigo-100 rounded shadow-sm">
                        <div class="flex flex-col items-center pt-1">
                            <div class="text-base text-gray-400 ">Registrations</div>
                            <div class="text-2xl font-bold text-gray-900 ">1375</div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
    import Layout from '@/Layouts/Trader'

    export default {
        components: {
            Layout,
        },

        props: {
            auth: Object,
            errors: Object,
            total_links: Object,
        },

        data() {
            return{ 
                toast: true
            }
        }
    }
</script>








