<template>
    <teleport to="#modal" v-if="showModal">
        <div @click.self="showModal = false" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"  style="background: rgba(0,0,0,.2);" id="modal-id">
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <form class="" @submit.prevent="requestPayment()">
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">
                        
                        <h2 class="text-xl font-bold py-4 ">Request Payment</h2>
                        <p class="text-sm text-gray-500 px-8">
                            Request payment
                        </p>
                    </div>
                    <Input v-model="request_form.address" class="w-11/12 mx-5 px-4" placeholder="Bitcoin Address" required></Input>
                    <!--footer-->
                    <div class="p-3  mt-2 text-center space-x-4 md:block">
                        <button @click="showModal = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                            Cancel
                        </button>
                        
                        <button class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                            Send
                        </button>                        
                    </div>
                </form>
            </div>
        </div>
    </teleport>

    <teleport to="#modal" v-if="showTransfer">
        <div @click.self="showTransfer = false" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"  style="background: rgba(0,0,0,.2);" id="modal-id">
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div class="">
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">
                        
                        <h2 class="text-xl font-bold pt-4">Transfer</h2>
                        <p class="text-sm text-gray-500 px-8 py-5">
                            Make transfer to another user. 
                        </p> 
                        <!-- <InputError v-if="$page.props.auth.user.account.main_balance < transfer_form.amount" :message="message"></InputError> -->

                        <Input type="email" placeholder="Beneficiary Email Address" v-model="transfer_form.email" class="mt-1 mb-3 block w-full text-gray-600" />
                        
                        <Input type="number" placeholder="Amount" v-model="transfer_form.amount" class="mt-1 block w-full text-gray-600" />
                    </div>
                    <!--footer-->
                    <div class="p-3  mt-2 text-center space-x-4 md:block">
                        <button @click="showTransfer = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                            Cancel
                        </button>
                        <button-small @click="transfer" class="mb-2 md:mb-0 cursor-pointer bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                            Transfer
                        </button-small>
                    </div>
                </div>
            </div>
        </div>
    </teleport> 

    <Layout>
        <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.success }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8 max-h-screen">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-600">
                        Fund Account
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Click the fund account button to fund your account. 
                    </p>
                </div>

                <div>
                    <a href="" data-toggle="modal" data-uid="be51b6162aac11eb" class="blockoPayBtn flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-yellow-600 bg-yellow-100 hover:bg-yellow-200">
                        Fund Account<!-- <img width=160 src="https://blockonomics.co/img/pay_with_bitcoin_medium.png"> -->
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Transaction ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Address
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="(payment, index) in payments" :key="payment.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    {{ index + 1 }}
                                </div> 
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    {{ payment.email }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    {{ payment.txid }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    {{ payment.value }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                {{ payment.status }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap truncate">
                                <span class="text-sm text-gray-500">
                                    {{ payment.address }}
                                </span>
                            </td>
                        </tr>
                    </tbody>                    
                </table>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8 max-h-screen">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-600">
                        Withdrawer
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Make request for withdrawal. Note that you must have shared on social media listed items on sharable link
                    </p>
                </div>

                <div>
                    <button @click="showModal = true" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-yellow-600 bg-yellow-100 hover:bg-yellow-200 focus:outline-none">
                        Request Payment
                    </button>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bitcoin Address
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="(payment, index) in payments" :key="payment.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    {{ index + 1 }}
                                </div> 
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    {{ payment.email }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    {{ payment.txid }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    {{ payment.value }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                {{ payment.status }}
                            </td>
                        </tr>
                    </tbody>                    
                </table>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8 max-h-screen">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-600">
                        Transfer
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Transfer fund to another user from your wallet.
                    </p>
                </div>

                <div>
                    <button @click="showTransfer = true" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-yellow-600 bg-yellow-100 hover:bg-yellow-200 focus:outline-none">
                        Make Transfer
                    </button>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Beneficiary
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="(transfer, index) in transfers" :key="transfer.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    {{ index + 1 }}
                                </div> 
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    {{ transfer.email }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    &dollar;{{ transfer.amount }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">
                                    {{ moment(transfer.created_at).format('DD, MMM YYYY') }}
                                </span>
                            </td>
                        </tr>
                    </tbody>                    
                </table>
            </div>
        </div>

    </Layout>
</template>

<script>
import Layout from '@/Layouts/Trader'
import moment from 'moment'
import Input from '@/Components/Input.vue'
import InputError from '@/Components/InputError.vue'

export default {
    layout: Layout,
    components: {
        Input,
        InputError,
    },
    data() {
        return {
            toast: true,
            moment: moment,
            showModal: false,
            showTransfer: false,
            transfer_form: this.$inertia.form({
                email: '',
                amount: 0.00
            }),
            message: 'You do not sufficient balance for this operation!',
            request_form: this.$inertia.form({
                address: ''
            })
        }
    },
    setup() {
        
    },
    props: {
        available_links: Object,
        user: Object,
        payments: Object,
        transfers: Object,
    },
    methods: {
        transfer(){
            this.$inertia.post('/transfer', this.transfer_form, {
                onSuccess: this.showTransfer = false
            })            
        },

        requestPayment(){
            this.$inertia.post('/request-payment', this.request_form)
        }
    }
}
</script>