<template>
    <div>
        <Layout>
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="mb-8 border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">                            
                            <p class="ml-3 font-medium text-gray-700 truncate">
                                {{ user.first_name }} {{ user.role }}
                            </p>
                            <p class="ml-3 font-medium text-gray-700 truncate">
                                {{ user.last_name }} {{ moment(user.created_at).fromNow() }}
                            </p>
                            <p class="ml-3 font-medium text-gray-700 truncate">
                                {{ user.email }} {{ moment(user.updated_at).format("dddd, MMM Do YYYY") }}
                            </p>
                            <p class="ml-3 font-medium text-gray-700 truncate">
                                {{ user.status }}
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            

        </Layout>
    </div>
</template>

<script>
import Layout from '@/Layouts/AdminLayout';
var moment = require('moment')

export default {
    components: {
        Layout,
    },
    props: ['user'],

    data() {
        return {
            moment: moment,
        }
    },

    methods: {
    
    },

    created() {
        
    },

    computed: {
        
    }

}
</script>
