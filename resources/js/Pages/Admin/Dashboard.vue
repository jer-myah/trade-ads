<template>
    <admin-layout>
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
                            <div class="text-base text-gray-400 ">Total Users</div>
                            <div class="text-2xl font-bold text-gray-600 ">{{ total_users }}</div>
                        </div>
                    </div>

                    <div class="p-5 bg-red-100 rounded shadow-sm">
                        <div class="flex flex-col items-center pt-1">
                            <div class="text-base text-gray-400 ">Total Traders</div>
                            <div class="text-2xl font-bold text-gray-600 ">{{ total_traders }}</div>                            
                        </div>
                    </div>
                    <div class="p-5 bg-pink-100 rounded shadow-sm">                        
                        <div class="flex flex-col items-center pt-1">
                            <div class="text-base text-gray-400 ">Total Adverts</div>
                            <div class="text-2xl font-bold text-gray-600 ">{{ total_ads }}</div>                            
                        </div>
                    </div>
                    <div class="p-5 bg-indigo-100 rounded shadow-sm">
                        <div class="flex flex-col items-center pt-1">
                            <div class="text-base text-gray-400 ">Total Links</div>
                            <div class="text-2xl font-bold text-gray-600 ">{{ total_links }}</div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        components: {
            AdminLayout,
        },

        props: {
            auth: Object,
            errors: Object,
            total_users: Number,
            total_traders: Number,
            total_ads: Number,
            total_links: Number,
        },
    }
</script>








