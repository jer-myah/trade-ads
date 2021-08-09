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
                            <a :href="'/purchase-trader-adslink/'+_link">
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
            <div class="px-4 py-5 sm:px-6 md:flex md:justify-between">
                <div class="">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Trading Section
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Trading Section 
                    </p>
                </div>

                <div class="flex pt-3 sm:py-3 md:py-0">
                    <div><button class="mx-2 focus:outline-none p-2 bg-blue-300 whitespace-nowrap"> {{ (moment.duration((moment(link.created_at).add(link.total_hours, 'h')).diff(moment()))).days() }} d </button></div>
                    <div><button class="focus:outline-none p-2 bg-yellow-300 whitespace-nowrap"> {{ (moment.duration((moment(link.created_at).add(link.total_hours, 'h')).diff(moment()))).hours() }} h</button></div>
                    <div><button class="mx-2 focus:outline-none p-2 bg-green-300 whitespace-nowrap"> {{ (moment.duration((moment(link.created_at).add(link.total_hours, 'h')).diff(moment()))).minutes() }} m</button></div>
                    <div><button class="focus:outline-none p-2 bg-indigo-300 whitespace-nowrap"> {{ countDown.inSeconds }} s</button></div>
                </div>

                <div class="my-3 md:my-0">
                    <button class="border text-gray-500 px-3 py-2 focus:outline-none">Main Balance</button><button class="border border-l-0 text-gray-500 px-3 py-2 focus:outline-none">{{ trader.main_balance }}</button>
                    <button class="md:ml-2 mt-3 md:mt-0 border text-gray-500 px-3 py-2 focus:outline-none">Trading Balance</button><button class="border border-l-0 text-gray-500 px-3 py-2 focus:outline-none"> {{ trader.trading_balance }} </button>
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
                                                No. of Transaction
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount(&dollar;)
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(trading_link, index) in trading_links" :key="trading_link.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ index + 1 }}
                                                </div> 
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-500">
                                                    {{ trading_link.trader_link }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-500">
                                                    {{ trading_link.sale_count }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-500">
                                                    {{ trading_link.unit_sale }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                {{ trading_link.status }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                                <!-- <button-small @click="amount = trading_link.unit_sale, link = trading_link.link, show_purchase = true">Purchase</button-small> -->
                                                <!-- <a :href="'/purchase-trader-adslink/'+trading_link.trader_link" @click="amount = trading_link.unit_sale, link = trading_link.link, show_purchase = true"> -->
                                                    <button-small class="rounded-md" @click="amount = trading_link.unit_sale, _link = trading_link.trader_link, show_purchase = true">
                                                        Purchase
                                                    </button-small>
                                                <!-- </a> -->
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
import Button from '@/Components/Button'
import ButtonSmall from '@/Components/ButtonSmall'
import moment from 'moment'
import { reactive } from 'vue'

export default {
    components: { 
        Button,
        ButtonSmall,
    },
    layout: Layout,
    data() {
        return {
            toast: true,
            moment: moment,
            show_purchase: false,
            amount: 0,
            _link: ''
        }
    },
    props: {
        link: Object,
        trading_links: Object,
        trader: Object,
    },
    setup(props) {
        const countDown = reactive({
            inSeconds: moment.now,
        });
        
        setInterval(() => {            
            countDown.inSeconds = moment.duration((moment(props.link.created_at).add(props.link.total_hours, 'h')).diff(moment())).seconds();
            
        }, 1000);

        return { countDown  }
    },
    
}
</script>