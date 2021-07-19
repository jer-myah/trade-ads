<template>
    <div>
        <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.success }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <Layout>
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="mb-8 border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">                            
                            <p class="ml-3 font-medium text-gray-700 truncate">
                                All Packages
                            </p>
                        </div>
                        <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                            <a href="/admin/create-package" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-green-600 bg-white hover:bg-green-50 transition ease-out duration-200 transform hover:scale-110">
                            New Package
                            </a>
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
                                        Price 
                                    </th>                                    
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="(pack, index) in packages" :key="pack.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                {{ index + 1 }}
                                            </div> 
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ pack.name }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> -->
                                            <span class="text-sm text-gray-500">
                                            {{ pack.amount }}
                                            </span>
                                        </td>
                                    
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span v-show="pack.status" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 uppercase">
                                                Enabled
                                            </span>
                                            <span v-show="!pack.status" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 uppercase">
                                                Disabled
                                            </span>
                                        </td>
                                        <td v-show="!pack.status" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a :href="'/admin/edit-package/' + pack.id" class="text-green-800 hover:text-green-900">Edit</a>
                                            <a :href="'/admin/enable-package/' + pack.id" class="text-green-800 hover:text-green-900 mx-6">Enable</a>
                                            <a :href="'/admin/delete-package/' + pack.id" class="text-red-800 hover:text-red-900">Delete</a>
                                        </td>
                                        <td v-show="pack.status" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a :href="'/admin/edit-package/' + pack.id" class="text-green-800 hover:text-green-900">Edit</a>
                                            <a :href="'/admin/disable-package/' + pack.id" class="text-red-800 hover:text-red-900 mx-6">Disable</a>
                                            <a :href="'/admin/delete-package/' + pack.id" class="text-red-800 hover:text-red-900">Delete</a>
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


export default {
    components: {
        Layout,
        Label,
        Input,
    },

    props: ['packages'],

    data() {
        return {
            toast: true
        }
    },

    methods: {
        
    }
}
</script>