<template>
    <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
        {{ $page.props.flash.success }}
        <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
    </div>
    <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
        {{ $page.props.flash.warning }}
        <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
    </div>

    <teleport to="#modal" v-if="edit_profile">
        <div class="fixed z-50 inset-0 overflow-y-auto transition-opacity duration-1000 ease-out" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">
                            
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    <div class="flex justify-between"> 
                                        <div class="text-gray-600">Update Profile </div>
                                        <svg @click="edit_profile = !edit_profile" class="w-6 h-6 cursor-pointer hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </div>
                                </h3>
                                <div class="mt-2">
                                    <form @submit.prevent="updateProfile" class="w-full my-8 space-y-6" action="#" method="POST">
                                        
                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="" class="text-gray-600">First Name</breeze-label>
                                                <breeze-input type="text"  class="w-full" />
                                            </div>                                            
                                        </div> 

                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="" class="text-gray-600">Last Name</breeze-label>
                                                <breeze-input type="text" class="w-full" />
                                            </div>                                            
                                        </div> 

                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="" class="text-gray-600"> Address</breeze-label>
                                                <breeze-input type="text" class="w-full" />
                                            </div>                                            
                                        </div>

                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="" class="text-gray-600">Organisation Name</breeze-label>
                                                <breeze-input type="text" class="w-full" />
                                            </div>                                            
                                        </div> 

                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="" class="text-gray-600">Organisation Location</breeze-label>
                                                <breeze-input type="text" class="w-full" />
                                            </div>                                            
                                        </div>                                                   

                                        <div>
                                            <breeze-button @click="edit_profile=true">Update Profile</breeze-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </teleport>

    <layout>
        <!-- This example requires Tailwind CSS v2.0+ -->
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
                    <breeze-button v-if="!advert.status" @click="approveAdvert">Approve Advert</breeze-button>
                    <breeze-button class="ml-2" @click="goBack">Back</breeze-button>
                </div>
            
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Title
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ advert.title }} 
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Description
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ advert.description }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Image
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <img :src="'/storage/'+advert.image" style="height:120px">
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Package
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ plan }}
                        </dd>
                    </div> 
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Category
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ cat }}
                        </dd>
                    </div> 
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            User Contact
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ advert.phone_num }}
                        </dd>
                    </div> 
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Date Created
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ moment(advert.created_at).format('DD, MMM YYYY') }}
                        </dd>
                    </div> 
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Expiry Date
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ (moment(advert.created_at).add(advert.link.duration, 'd')).format('DD, MMM YYYY') }}
                        </dd>
                    </div> 
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Advert Status
                        </dt>
                        <dd v-if="advert.status == 1" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            Active
                        </dd>
                        <dd v-else class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            Inactive
                        </dd>
                    </div> 
                    
                    <div v-if="moment.now() > moment(advert.created_at).add(advert.link.duration, 'd')" class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Action
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <a :href="'/admin/deactivate-advert/' + advert.id" class="text-white mx-2"><edit-button>Deactive</edit-button></a>
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
        EditButton
    },
    props: {
        advert: Object,
        plan: Object,
        cat: Object,
    },
    data() {
        return {
            toast: true,
            moment: moment
        }
    },
    
    methods: {
        goBack() {
            this.$inertia.get('/admin/view-adverts');
        },
        approveAdvert() {
            if(this.advert.status == 0){
                this.$inertia.get('/admin/approve-advert/'+this.advert.id)
            }
        }
    },
}
</script>