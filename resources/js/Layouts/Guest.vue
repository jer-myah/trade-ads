<template>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <!-- component -->
        <nav class=" bg-white w-full flex relative justify-between items-center mx-auto px-8 h-20">
            <!-- logo -->
            <div class="inline-flex">
                <a href="/">
                    <breeze-application-logo class="h-8 w-16" />                
                </a>
            </div>

            <!-- end logo -->

            <!-- search bar -->
            <div class="hidden sm:block flex-shrink flex-grow-0 justify-start px-2">
                <div class="inline-block">
                    <div class="inline-flex items-center max-w-full">
                        <button class="flex items-center flex-grow-0 flex-shrink pl-2 relative w-60 rounded-full px-1  py-1" type="button">
                            <div class="block flex-grow flex-shrink overflow-hidden">
                                <a href="/how-it-works" class="text-gray-600 focus:outline-none"> How It Works </a>
                            </div>                            
                        </button>
                    </div>
                </div>
            </div>
            <!-- end search bar -->

            <!-- login -->
            <div class="flex-initial">
                <div class="flex justify-end items-center relative">
                
                    <div class="flex mr-4 items-center">
                        <div v-if="show_trader" class="inline-block mr-4">
                            <button @click="show_modal = !show_modal" type="button" class="inline-flex items-center relative py-3 px-5 border rounded-full hover:shadow-lg">
                                Become a Trader
                            </button>
                        </div>
                        <div class="block relative">
                            <button type="button" class="inline-flex items-center relative py-3 px-5 border rounded-full hover:shadow-lg">
                                <a href="/login"> Login </a>
                            </button>
                        </div>
                    </div>

                    <div class="block">
                        <div class="inline relative">
                            <button type="button" class="inline-flex items-center relative py-3 px-5 border rounded-full hover:shadow-lg">
                                <a href="/register"> Register </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end login -->
        </nav>

        <div class="border"></div>

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
                                            <div class="">Trading Registration </div>
                                            <div @click="show_modal = !show_modal" class="p-2 cursor-pointer border border-gray-100 text-red-600">X</div>
                                        </div>
                                    </h3>
                                    <div class="mt-2">
                                        <!-- <div class="w-full min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"> -->
                                            <!-- <div class="w-full space-y-8"> -->
                                                <!-- <div> -->
                                                    <!-- <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow"> -->
                                                    <!-- <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                                                        Register to attend
                                                    </h2> -->
                                                    <!-- <p class="mt-2 text-center text-sm text-gray-600">
                                                        Or
                                                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        start your 14-day free trial
                                                        </a>
                                                    </p> -->
                                                <!-- </div> -->
                                                <form class="w-full mt-8 space-y-6" action="#" method="POST">
                                                    <!-- <input type="hidden" name="remember" value="true"> -->
                                                    <div class="rounded-md shadow-sm">
                                                        <div>
                                                            <label for="first_name" class="sr-only">First Name</label>
                                                            <input id="first_name" name="" type="text" autocomplete="first" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="First Name">
                                                        </div>
                                                        <div class="mt-5">
                                                            <label for="last_name" class="sr-only">Last Name</label>
                                                            <input id="last_name" name="last_name" type="text" autocomplete="last_name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Last Name">
                                                        </div>
                                                        <div class="mt-5">
                                                            <label for="email-address" class="sr-only">Email</label>
                                                            <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Email address">
                                                        </div>
                                                        <div class="mt-5">
                                                            <label for="password" class="sr-only">Password</label>
                                                            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Password">
                                                        </div>
                                                    </div>

                                                    <!-- <div class="flex items-center justify-between">
                                                        <div class="flex items-center">
                                                            <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                                                Remember me
                                                            </label>
                                                        </div>

                                                        <div class="text-sm">
                                                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                Forgot your password?
                                                            </a>
                                                        </div>
                                                    </div> -->

                                                    <div>
                                                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-800 hover:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            <!-- <span class="absolute left-0 inset-y-0 flex items-center pl-3"> -->
                                                                <!-- Heroicon name: solid/lock-closed -->
                                                                <!-- <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                                                </svg> -->
                                                            <!-- </span> -->
                                                                Sign in
                                                        </button>
                                                    </div>
                                                </form>
                                            <!-- </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Submit
                            </button>
                            <button @click="show_modal = !show_modal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>
        </teleport>


        <div class="w-full bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'

    export default {
        components: {
            BreezeApplicationLogo,
        },
        data() {
            return {
                show_modal: false,
                show_trader: false,
            }
        }
    }
</script>
