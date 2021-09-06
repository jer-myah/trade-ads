<template>
    <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
        {{ $page.props.flash.success }}
        <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
    </div>
    <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
        {{ $page.props.flash.warning }}
        <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
    </div>    

    <layout>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        User Information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Detail Information for user 
                    </p>
                </div>

                <div>
                    <!-- <breeze-button v-if="!advert.status" @click="approveAdvert"></breeze-button> -->
                    <breeze-button class="ml-2" @click="goBack">Back</breeze-button>
                </div>
            
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Full Name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ user.first_name }} {{ user.last_name }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Email 
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ user.email }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Date of Registration
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ moment(user.created_at).format("DD, MMM YYYY") }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Role
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 uppercase">
                            {{ user.role }}
                        </dd>
                    </div> 
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Country
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ user.country }}
                        </dd>
                    </div> 
                    
                </dl>
            </div>
        </div>


    </layout>
</template>

<script>
import Layout from '@/Layouts/AdminLayout'
import BreezeButton from '@/Components/Button'
import EditButton from '@/Components/ButtonEdit'
import BreezeInput from '@/Components/Input'
import BreezeLabel from '@/Components/Label'
import moment from 'moment'

export default {
    components: {
        Layout,
        BreezeInput,
        BreezeButton,
        BreezeLabel,
        EditButton,
        
    },
    props: {
        user: Object
    },
    data() {
        return {
            toast: true,
            moment: moment,
        }
    },
    
    methods: {
        goBack() {
            this.$inertia.get('/admin/view-users');
        },
        
    },
}
</script>