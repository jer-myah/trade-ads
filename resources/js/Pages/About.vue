<template>
    <layout>

        <div class="w-11/12 mx-auto sm:w-10/12 md:w-8/12 pt-8">
            <div class="px-8 py-5">
                <p class="text-gray-600 font-bold text-center text-xl leading-8 capitalize">
                    How it works
                </p>
            </div>
        </div>

        <div class="w-11/12 mx-auto sm:w-10/12 md:w-8/12">
            <div class="shadow-lg p-8">
                <p class="text-gray-600 text-base leading-8">
                    TradeAds is an online advertising ads trading company, that trades on its clients adverts to attract public views as means of publicity.
                    We have also set aside measures to place our clients ads as a priority and a key factors over our traders to purchase as ads link at five dollar rate with a return of ten dollar per link to trade among them self's, with sharing of ads revenue and other benefits that energies them to partakes in all of our directives to achieve our goal of making your ads seen globally.
                </p>
                <p class="text-gray-600 text-base leading-6 pt-4">
                    <span class="font-bold">NOTE </span>that you can lose your ads link unit at any time link to a trade expires, by purchasing an ads link few minutes to is expired time.
                </p>
            </div>
        </div>

        <!-- component  AD8B63 -->
        <section>
            <div class="py-8">
                <div class="container mx-auto flex flex-col items-start md:flex-row my-12 md:my-24">
                    <div class="flex flex-col w-full sticky md:top-36 lg:w-1/3 mt-2 md:mt-12 px-8">
                        <p class="ml-2 my-5 text-gray-600 font-bold text-xl uppercase tracking-loose">Traders</p>
                        <p class="text-3xl md:text-xl leading-normal md:leading-relaxed mb-2 text-gray-600 capitalize">Top traders</p>
                        <p class="text-sm md:text-base text-gray-600 mb-4">
                            Top traders are first to receive ads link directly from the company, with a high rate of double trade, and some other future benefits of earning from ads revenues and generational earnings on adverts from their referrals.
                        </p>

                        <p class="text-3xl md:text-xl leading-normal md:leading-relaxed mb-2 text-gray-600 capitalize">Voluntary traders</p>
                        <p class="text-sm md:text-base text-gray-600 mb-4">
                            Voluntary traders are users or participants that are invited, via invite email or referral link to quicken the publicity of a familiar ads or to be on a trade. by funding ads link unit, knowing fully well the losses when it comes to expired link.
                        </p>
                        
                        <breeze-button @click="show_modal = !show_modal">Become a Trader</breeze-button>
                    </div>
                    <div class="ml-0 md:ml-12 lg:w-2/3 sticky">
                        <div class="container mx-auto w-full h-full">
                            <div class="relative wrap overflow-hidden p-10 h-full">
                                <div class="border-2-2 border-indigo-500 absolute h-full border" style="right: 50%; border: 2px solid #AD8B63; border-radius: 1%;"></div>
                                <div class="border-2-2 border-indigo-500 absolute h-full border" style="left: 50%; border: 2px solid #AD8B63; border-radius: 1%;"></div>
                                <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                                    <div class="order-1 w-5/12"></div>
                                    <div class="order-1 w-5/12 px-1 py-4">
                                        <!-- <p class="mb-3 text-base text-gray-600">1-6 May, 2021</p> -->
                                        <h4 class="mb-3 font-bold text-md md:text-base text-gray-600 capitalize">Ads Link</h4>
                                        <p class="text-sm md:text-base leading-snug text-gray-500 text-opacity-100">
                                        Ads link are adverts that are automatically attached to a link, for top traders and voluntary traders to trade among themselves.
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-8 flex justify-between items-center w-full right-timeline">
                                    <div class="order-1 w-5/12"></div>
                                    <div class="order-1  w-5/12 px-1 py-4 text-left">
                                        <!-- <p class="mb-3 text-base text-gray-600">6-9 May, 2021</p> -->
                                        <h4 class="mb-3 font-bold text-md md:text-base text-gray-600 capitalize">Invite Email</h4>
                                        <p class="text-sm md:text-base leading-snug text-gray-500 text-opacity-100">
                                            Can be sent to a friend so they could use to search out your ads link from the trade section, to place them under your earnings, It can also be use for adverts invite for 10% earning only for three months active traders.
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                                    <div class="order-1 w-5/12"></div>
                                    <div class="order-1 w-5/12 px-1 py-4 text-right">
                                        <!-- <p class="mb-3 text-base text-gray-600"> 10 May, 2021</p> -->
                                        <h4 class="mb-3 font-bold text-md md:text-base text-gray-600 capitalize">Referral Link</h4>
                                        <p class="text-sm md:text-base leading-snug text-gray-500 text-opacity-100">
                                            Referral link is not mandatory, but qualifies you to a top trader, also with the benefit to double trade per link.
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-8 flex justify-between items-center w-full right-timeline">
                                    <div class="order-1 w-5/12"></div>
                                    <div class="order-1  w-5/12 px-1 py-4">
                                        <!-- <p class="mb-3 text-base text-gray-600">12 May, 2021</p> -->
                                        <h4 class="mb-3 font-bold  text-md md:text-base text-gray-600 text-left capitalize">What is double trading</h4>
                                        <p class="text-sm md:text-base leading-snug text-gray-500 text-opacity-100">
                                            It enables you to trade more than once per link, after your minimum earning on your previous ads link, It only works if each twenty referrals made are active on a trade with you.
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                                    <div class="order-1 w-5/12"></div>
                                    <div class="order-1 w-5/12 px-1 py-4 text-right">
                                        <!-- <p class="mb-3 text-base text-gray-600"> 10 May, 2021</p> -->
                                        <h4 class="mb-3 font-bold text-md md:text-base text-gray-600 capitalize">How links works</h4>
                                        <p class="text-sm md:text-base leading-snug text-gray-500 text-opacity-100">
                                            Every link has expired time, and can accommodate a setting numbers of adverts that falls within range of being active, expiration increases when new ads comes in and it varies by it's packages in series
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-8 flex justify-between items-center w-full right-timeline">
                                    <div class="order-1 w-5/12"></div>
                                    <div class="order-1  w-5/12 px-1 py-4">
                                        <!-- <p class="mb-3 text-base text-gray-600">12 May, 2021</p> -->
                                        <h4 class="mb-3 font-bold  text-md md:text-base text-gray-600 text-left capitalize">What is ads series</h4>
                                        <p class="text-sm md:text-base leading-snug text-gray-500 text-opacity-100">
                                            Ads series are group of hours that a client advert packages is placed, to fit into a trade section. Expiration of link drops by one hour each on increase of minimum withdrawals.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <img class="mx-auto -mt-36 md:-mt-36" src="https://user-images.githubusercontent.com/54521023/116968861-ef21a000-acd2-11eb-95ac-a34b5b490265.png" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </layout>

    <teleport to="#modal" v-if="show_modal">
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                Background overlay, show/hide based on modal state.

                Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!--
                Modal panel, show/hide based on modal state.

                Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">
                            <!-- <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"> -->
                                <!-- Heroicon name: outline/exclamation -->
                                <!-- <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg> -->
                            <!-- </div> -->
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    <div class="flex justify-between"> 
                                        <div class="">Trader Registration </div>
                                        <!-- <div  class="p-2 cursor-pointer border border-gray-100 text-red-600">X</div> -->
                                        <svg @click="show_modal = !show_modal" class="w-6 h-6 cursor-pointer hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </div>
                                </h3>
                                <div class="mt-2">                                    
                                    <form @submit.prevent="registerTrader" class="w-full mt-8 space-y-6" action="#" method="POST">
                                        <!-- <input type="hidden" name="remember" value="true"> -->
                                        <div class="rounded-md shadow-sm">
                                            <div>
                                                <label for="first_name" class="sr-only">First Name</label>
                                                <input id="first_name" type="text" v-model="form.first_name" autocomplete="first_name" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" placeholder="First Name">
                                            </div>

                                            <div class="mt-5">
                                                <label for="last_name" class="sr-only">Last Name</label>
                                                <input id="last_name" type="text" v-model="form.last_name" autocomplete="last_name" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" placeholder="Last Name">
                                            </div>
                                            
                                            <div class="mt-5">
                                                <label for="email-address" class="sr-only">Email</label>
                                                <input id="email-address" v-model="form.email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" placeholder="Email address">
                                            </div>
                                            <div class="mt-5">
                                                <label for="password" class="sr-only">Password</label>
                                                <input id="password" v-model="form.password" type="password" autocomplete="password" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" placeholder="Password">
                                            </div>
                                            <div class="mt-5">
                                                <label for="confirm_password" class="sr-only">Confirm Password</label>
                                                <input id="confirm_password" v-model="form.confirm_password" type="password" autocomplete="confirm_password" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" placeholder="Confirm Password">
                                            </div>
                                            
                                        </div>

                                        <div>
                                            <breeze-button type="submit" class="">
                                                Register
                                            </breeze-button>
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
</template>

<script>
import Layout from '@/Layouts/Guest'
import BreezeButton from '@/Components/Button'
import Swal from 'sweetalert2'

export default {
    components: {
        Layout,
        BreezeButton
    },
    props: {
        auth: Object,
        errors: Object,
    },

    data() {
        return {
            show_modal: false,
            form: this.$inertia.form({
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                confirm_password: '',
                role: 'voluntary-trader',
            })
        }
    },
    methods: {
        registerTrader () {
            if(this.form.password !== this.form.confirm_password){
                Swal.fire('Error', 'Password mismatch', 'error')
            }

            this.form.post('/register', {
                onFinish: () => this.form.reset('password', 'confirm_password'),                
            })

        }
    }
}
</script>