<template>
    <div>
        <Layout>
            <breeze-validation-error />

            <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
                {{ $page.props.flash.success }}
                <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
            </div>
            <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
                {{ $page.props.flash.warning }}
                <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
            </div>

            <teleport to="#modal" v-if="show_modal">
                <div @click.self="show_modal = false" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"  style="background: rgba(0,0,0,.2);" id="modal-id">
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
                                    Do you really want to delete this category?
                                </p>    
                            </div>
                            <!--footer-->
                            <div class="p-3  mt-2 text-center space-x-4 md:block">
                                <button @click="show_modal = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                                    Cancel
                                </button>
                                <button @click="deleteCategory" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                                    Delete
                                </button>
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
                                All Categories
                            </p>
                        </div>
                        <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                            <button @click="url='/admin/create-category', createCategory()" class="focus:outline-none flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-green-600 bg-white hover:bg-green-50 transition ease-out duration-500 transform hover:scale-110">
                                New Category
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Description
                                        </th>                                    
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="(cat, index) in categories" :key="cat.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                {{ index + 1 }}
                                            </div> 
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ cat.name }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> -->
                                            <span class="text-sm text-gray-500">
                                            {{ cat.description }}
                                            </span>
                                        </td>
                                    
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span v-show="cat.status" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 uppercase">
                                                Enabled
                                            </span>
                                            <span v-show="!cat.status" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 uppercase">
                                                Disabled
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a :href="'/admin/edit-category/' + cat.id" class=""><edit-button>Edit</edit-button></a>
                                            <a v-show="!cat.status" :href="'/admin/enable-category/' + cat.id" class="px-2 sm:px-3"><small-button>Enable</small-button></a>
                                            <a v-show="cat.status" :href="'/admin/disable-category/' + cat.id" class="px-2 sm:px-3"><small-button>Disable</small-button></a>
                                            <a @click="show_modal = true, url = '/admin/delete-category/'+ cat.id" class=""><delete-button>Delete</delete-button></a>
                                        </td>
                                    </tr>

                                    <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </Layout>
    </div>
</template>


<script>
import Layout from '@/Layouts/AdminLayout'
import Label from '@/Components/Label'
import Input from '@/Components/Input'
import BreezeValidationError from '@/Components/ValidationErrors'
import TableLite from "vue3-table-lite";
import EditButton from '@/Components/ButtonEdit';
import DeleteButton from '@/Components/ButtonDelete.vue';
import SmallButton from '@/Components/ButtonSmall.vue'

export default {
    components: {
        Layout,
        Label,
        Input,
        BreezeValidationError,
        TableLite,
        EditButton,
        DeleteButton,
        SmallButton,
    },
    props: {
        categories: Object,
        auth: Object
    },
    data() {
        return {
            show_modal: false,
            url: '',
            toast: true,
        }
    },

    methods: {
        deleteCategory() {
            this.$inertia.get(this.url);
            this.url = '';
            this.show_modal = false;
        },
        createCategory() {
            this.$inertia.get(this.url);
        },
        
    }
}
</script>