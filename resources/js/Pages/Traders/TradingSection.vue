<template>
    <Layout>
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
                                                    {{ trading_link.num_sale }}
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
                                                <a :href="'/purchase-trader-adslink/'+link" @click="amount = trading_link.unit_sale, link = trading_link.link, show_purchase = true">
                                                    <button-small class="rounded-md">
                                                        Purchase
                                                    </button-small>
                                                </a>
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
        }
    },
    props: {
        link: Object,
        trading_links: Object,
        trader: Object,
    },
    setup(props) {
        const countDown = reactive({
            inSeconds: 0,
        });
        
        setInterval(() => {
            countDown.inSeconds = moment.duration((moment(props.link.created_at).add(props.link.total_hours, 'h')).diff(moment())).seconds();
            // if(props.link.total_hours <= 0){

            // }
        }, 1000);

        return { countDown  }
    }
}
</script>