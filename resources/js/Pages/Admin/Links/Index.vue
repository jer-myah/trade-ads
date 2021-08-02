<template>
    <div>
        <Layout>
            <breeze-validation-error />

            <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
                {{ $page.props.flash.success }}
                <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
            </div>
            <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
                {{ $page.props.flash.warning }}
                <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
            </div>

            <!-- delete modal -->
            <teleport to="#modal" v-if="show_modal">
                <div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"  style="background: rgba(0,0,0,.2);" id="modal-id">
                    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                        <!--content-->
                        <div class="">
                            <!--body-->
                            <div class="text-center p-5 flex-auto justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <h2 class="text-xl font-bold py-4 ">Are you sure?</h2>
                                <p class="text-sm text-gray-500 px-8">
                                    Do you really want to delete this ads link?
                                </p>    
                            </div>
                            <!--footer-->
                            <div class="p-3  mt-2 text-center space-x-4 md:block">
                                <button @click="show_modal = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                                    Cancel
                                </button>
                                <button @click="deleteLink" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </teleport>

            <!-- share link with traders  -->
            <teleport to="#modal" v-if="share_modal">
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
                                                <div class="text-gray-600">Share Link </div>
                                                <svg @click="share_modal = !share_modal" class="w-6 h-6 cursor-pointer hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </div>
                                        </h3>
                                        <div class="mt-2">
                                            <form @submit.prevent="updateProfile" class="w-full my-8 space-y-6" action="#" method="POST">
                                                
                                                <div class="rounded-md shadow-sm">
                                                    <div class="mt-5">
                                                        <breeze-label for="" class="text-gray-600">Share With</breeze-label>                                                        
                                                        <select v-model="form.shared" class="w-full border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm py-3">
                                                            <option value="top">Top Traders Only</option>
                                                            <option value="voluntary">Voluntary Traders Only</option>
                                                            <option value="both">Both</option>
                                                        </select>    
                                                    </div>                                            
                                                </div> 

                                                <div class="rounded-md shadow-sm">
                                                    <div class="mt-5">
                                                        <breeze-label for="amount" class="text-gray-600">Purchase Amount</breeze-label>
                                                        <breeze-input v-model="form.amount" type="number" class="w-full" />
                                                    </div>                                            
                                                </div> 

                                                <div class="rounded-md shadow-sm" v-if="form.shared == 'top'">
                                                    <div class="mt-5">
                                                        <breeze-label for="" class="text-gray-600"> Top Trader Tradeable Amount </breeze-label>
                                                        <breeze-input v-model="form.top_amount" type="number" class="w-full" />
                                                    </div>                                            
                                                </div>

                                                <div class="rounded-md shadow-sm" v-if="form.shared == 'top'">
                                                    <div class="mt-5">
                                                        <breeze-label for="" class="text-gray-600">Top Trader Tradeable Number of Sale</breeze-label>
                                                        <breeze-input v-model="form.top_sale" type="number" class="w-full" />
                                                    </div>                                            
                                                </div>    

                                                <div class="rounded-md shadow-sm">
                                                    <div class="mt-5">
                                                        <breeze-label for="" class="text-gray-600"> Tradeable Amount </breeze-label>
                                                        <breeze-input v-model="form.vol_amount" type="number" class="w-full" />
                                                    </div>                                            
                                                </div>

                                                <div class="rounded-md shadow-sm">
                                                    <div class="mt-5">
                                                        <breeze-label for="" class="text-gray-600">Tradeable Number of Sale</breeze-label>
                                                        <breeze-input v-model="form.vol_sale" type="number" class="w-full" />
                                                    </div>                                            
                                                </div>                                               

                                                <div class="flex justify-center">
                                                    <breeze-button @click="form.id = '', share_modal = false" class="mr-5">Cancel</breeze-button>
                                                    <breeze-button @click="shareLink">Share</breeze-button>
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

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="mb-8 border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">                            
                            <p class="ml-3 font-medium text-gray-700 truncate">
                                All links
                            </p>
                        </div>
                        <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                            <!-- <button @click="url='/admin/create-category', createCategory()" class="focus:outline-none flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-green-600 bg-white hover:bg-green-50 transition ease-out duration-500 transform hover:scale-110">
                                New Link
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200" v-if="current_link">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ad Link
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Duration
                                        </th> 
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Shared With
                                        </th>                                    
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Advert Title
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                1
                                            </div> 
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ current_link.link }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> -->
                                            <span class="text-sm text-gray-500">
                                            {{ current_link.duration }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 capitalize">{{ current_link.shared_with }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- <div class="text-sm text-gray-500" >{{ current_link.advert.title }} </div> -->
                                        </td> 
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <breeze-button @click="form.id = current_link.id, share_modal = true" >Share</breeze-button>
                                            <a @click="show_modal = true, url = '/admin/delete-link/'+ link.id" class="mx-2">
                                                <button-delete>Delete</button-delete>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    <tr v-for="(link, index) in links" :key="link.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                {{ index + 1 }}
                                            </div> 
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ link.link }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> -->
                                            <span class="text-sm text-gray-500">
                                            {{ link.duration }}
                                            </span>
                                        </td>
                                    
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 uppercase">
                                                Enabled
                                            </span>
                                            <span  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 uppercase">
                                                Disabled
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <breeze-button>Share</breeze-button>
                                            <a @click="show_modal = true, url = '/admin/delete-link/'+ link.id" class="mx-2">
                                                <button-delete>Delete</button-delete>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- More people... -->
                                </tbody>
                            </table>

                            <div v-else class="py-16 text-center shadow-md">
                                <p class="text-gray-400">No Link Available yet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    </div>
</template>


<script>
import Layout from '@/Layouts/AdminLayout'
import BreezeLabel from '@/Components/Label'
import BreezeInput from '@/Components/Input'
import BreezeValidationError from '@/Components/ValidationErrors'
import TableLite from "vue3-table-lite";
import ButtonDelete from '@/Components/ButtonDelete'
import BreezeButton from '@/Components/ButtonSmall'

export default {
    components: {
        Layout,
        BreezeLabel,
        BreezeInput,
        BreezeValidationError,
        TableLite,
        ButtonDelete,
        BreezeButton,
    },
    props: {
        links: Object,
        current_link: Object,
        auth: Object
    },
    data() {
        return {
            show_modal: false,
            share_modal: false,
            url: '',
            toast: true,
            form: this.$inertia.form({
                id: '',
                shared: '',
                amount: '',
                top_amount: '',
                top_sale: '',
                vol_amount: '',
                vol_sale: ''
            })
        }
    },

    methods: {
        shareLink(){
            this.$inertia.post('/admin/share-link', this.form);
            this.form.reset();
            this.share_modal = false;
        }
    }
}
</script>