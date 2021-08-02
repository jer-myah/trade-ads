<template>
    <Layout> 
        <teleport to="#modal" v-if="show_purchase">
            <div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"  style="background: rgba(0,0,0,.2);" id="modal-id">
                <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                    <!--content-->
                    <div class="">
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            
                            <h2 class="text-xl font-bold py-4 ">Make Payment</h2>
                            <p class="text-sm text-gray-500 px-8">
                                You will be charged &dollar;{{ amount }} for this. 
                            </p>    
                        </div>
                        <!--footer-->
                        <div class="p-3  mt-2 text-center space-x-4 md:block">
                            <button @click="show_purchase = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                                Cancel
                            </button>
                            <a :href="'/purchase-adslink/'+link">
                                <button-small class="rounded-full px-5 py-3">
                                    Purchase
                                </button-small>
                            </a>
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
                        Available Links
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Links available for trading
                    </p>
                </div>

                <div>
                    <button class="border text-gray-500 px-3 py-2 focus:outline-none">Main Balance</button><button class="border border-l-0 text-gray-500 px-3 py-2 focus:outline-none"> {{ trader.main_balance }} </button>
                    <button class="ml-2 border text-gray-500 px-3 py-2 focus:outline-none">Trading Balance</button><button class="border border-l-0 text-gray-500 px-3 py-2 focus:outline-none"> {{ trader.trading_balance }} </button>
                </div>

            </div>

            <div class="border-t border-gray-200 p-5">
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
                                                Link
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Advert
                                            </th>
                                            <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Time Left
                                            </th> -->
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount(&dollar;)
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(available, index) in available_links" :key="available.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ index + 1 }}
                                                </div> 
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-500">
                                                    {{ available.link }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500"> <img :src="'storage/'+available.advert.image" alt="" width="50"> </div>
                                            </td>
                                            <!-- <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-500">
                                                    {{ (moment.duration((moment(available.created_at).add(available.total_hours, 'h')).diff(moment()))).days() }} Day(s)
                                                    {{ (moment.duration((moment(available.created_at).add(available.total_hours, 'h')).diff(moment()))).hours() }} Hour(s)
                                                </span>
                                            </td> -->
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                &dollar;{{ available.amount }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                                <button-small @click="amount = available.amount, link = available.link, show_purchase = true">Purchase</button-small>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/Layouts/Trader'
import moment from 'moment'
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
            moment: moment,
            show_purchase: false,
            amoount: '',
            link: '',
        }
    },
    setup() {
        
    },
    props: {
        available_links: Object,
        trader: Object,
    },
    methods: {
        
    }
}
</script>