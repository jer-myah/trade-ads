<template>
    <breeze-authenticated-layout>
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
                            <div class="text-base text-gray-400 ">Total Adverts</div>
                            <div class="text-2xl font-bold text-gray-900 ">85</div>
                        </div>
                    </div>

                    <div class="p-5 bg-red-100 rounded shadow-sm">
                        <div class="flex flex-col items-center pt-1">
                            <div class="text-base text-gray-400 ">Total Amount</div>
                            <div class="text-2xl font-bold text-gray-900 "> &dollar; 7500</div>                            
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
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

    export default {
        components: {
            BreezeAuthenticatedLayout,
        },

        props: {
            auth: Object,
            errors: Object,
        },
    }
</script>








