<template>
    <div class="h-16 bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">                       

                        <!-- Responsive Navigation Menu for harburger -->
                        <div :class="{'block absolute left-0 top-16': showingNavigationSidebar, 'hidden': ! showingNavigationSidebar}" class="md:hidden">
                            <div class="-md:ml-5 max-h-full">
                                <Sidebar class="" />
                            </div>
                        </div>

                        <!-- Hamburger for sidebar on mobile -->
                        <div class="mr-2 flex items-center md:hidden">
                            <button @click="showingNavigationSidebar = ! showingNavigationSidebar" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationSidebar, 'inline-flex': ! showingNavigationSidebar }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationSidebar, 'inline-flex': showingNavigationSidebar }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <breeze-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </breeze-nav-link>
                        </div>
                    </div>
                    
                    <div class="pt-3">
                        <breeze-responsive-nav-link :href="route('logout')" method="post" as="button" class="w-full flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                            <span class="text-gray-600">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </span>
                            <span>Log Out</span>
                        </breeze-responsive-nav-link>
                    </div>
                </div>
            </div>
        </nav>

    </div>
</template>


<script>
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'
    import BreezeDropdown from '@/Components/Dropdown'
    import BreezeDropdownLink from '@/Components/DropdownLink'
    import BreezeNavLink from '@/Components/NavLink'
    import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink'
    import Sidebar from '@/Components/Traders/Sidebar'

    export default {
        components: {
            BreezeApplicationLogo,
            BreezeDropdown,
            BreezeDropdownLink,
            BreezeNavLink,
            BreezeResponsiveNavLink,
            Sidebar
        },

        data() {
            return {
                showingNavigationDropdown: true,
                showingNavigationSidebar: false,
            }
        },
    }
</script>
