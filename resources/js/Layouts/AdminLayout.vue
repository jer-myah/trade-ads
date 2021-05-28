<template>
    <div>      

        <div class="flex h-auto bg-gray-200 font-roboto">
            <div class="hidden md:block min-w-1/5">
                <Sidebar />
            </div>
            

            <div class="w-4/5 flex-1 flex flex-col overflow-hidden">
                <Header />

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">
                        <slot />
                    </div>
                </main>                
            </div>
        </div>

        <div class="">
            <Footer />
        </div>
        
    </div>
</template>

<script>
    import BreezeApplicationLogo from '@/Components/ApplicationLogo' 
    import BreezeDropdown from '@/Components/Dropdown'
    import BreezeDropdownLink from '@/Components/DropdownLink'
    import BreezeNavLink from '@/Components/NavLink'
    import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink'
    import Sidebar from '@/Components/Admin/Sidebar'
    import Header from '@/Components/Admin/Header'
    import Footer from '@/Components/Footer'

    export default {
        components: {
            BreezeApplicationLogo,
            BreezeDropdown,
            BreezeDropdownLink,
            BreezeNavLink,
            BreezeResponsiveNavLink,
            Sidebar,
            Header,
            Footer
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
    }
</script>
