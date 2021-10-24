<template>
    <Layout> 
        <teleport to="#modal" v-if="show_purchase">
            <div @click.self="show_purchase = false" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"  style="background: rgba(0,0,0,.2);" id="modal-id">
                <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                    <!--content-->
                    <div>
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            
                            <h2 class="text-xl font-bold py-4 ">Make Payment</h2>
                            <p class="text-sm text-gray-500 px-8">
                                You will be charged for this. 
                            </p>    
                        </div>
                        <!--footer-->
                        <div class="p-3  mt-2 text-center space-x-4 md:block">
                            <button @click="show_purchase = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                                Cancel
                            </button>
                            <button-small class="rounded-full px-5 py-3">
                                Purchase
                            </button-small>
                        </div>
                    </div>
                </div>
            </div>
        </teleport>

        <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.success }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-600">
                        Sharable Links
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Sharable Links available.
                    </p>
                </div>

                <div>
                    <button class="border text-gray-500 px-3 py-2 focus:outline-none">Main Balance</button><button class="border border-l-0 text-gray-500 px-3 py-2 focus:outline-none"> {{ account.main_balance }} </button>
                    <button class="ml-2 border text-gray-500 px-3 py-2 focus:outline-none">Trading Balance</button><button class="border border-l-0 text-gray-500 px-3 py-2 focus:outline-none"> {{ account.trading_balance }} </button>
                </div>

            </div>

            <div class="border-t border-gray-200 p-5">
                <div class="container mx-auto px-6">
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                        <div v-for="advert in adverts" :key="advert.id" class="w-full max-w-sm mx-auto rounded-md shadow-md">
                            <div class="flex items-end justify-end h-64 w-full">
                                <img :src="'/storage/'+advert.image" object-cover class="h-full w-full">
                            </div>
                            <div class="px-5 py-3">
                                <h3 class="text-gray-700 uppercase">{{ advert.title }}</h3>
                                <div class="flex justify-between pt-2">
                                    <span class="text-gray-500 mt-2">Price: &dollar;{{ advert.amount }} </span>
                                    <button class="py-1 px-3"></button>
                                </div>                            
                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- This example requires Tailwind CSS v2.0+ -->
                <!-- <div class="flex flex-col">
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
                                                Title
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Image
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(advert, index) in adverts" :key="advert.id" class="">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ index + 1 }}
                                                </div> 
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-500">
                                                    {{ advert.title }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 max-w-xs truncate">
                                                <span class="text-sm text-gray-500 truncate">
                                                    {{ advert.description }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500"> <img :src="'storage/'+advert.image" alt="" width="50" class="transition ease-out duration-200 transform hover:scale-150"> </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                                <button-small @click="show_purchase = true">Purchase</button-small>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/Layouts/Trader'
import ButtonSmall from '@/Components/ButtonSmall'
import { Inertia } from '@inertiajs/inertia'

export default {
    layout: Layout,
    components: {
        ButtonSmall,
    },
    data(){
        return {
            toast: true,
            show_purchase: false,
        }
    },
    props: {
        adverts: Object,
        account: Object,
    },
    
}
</script>