<template>
    <teleport to="#modal" v-if="edit_profile">
        <div @click.self="edit_profile = false" class="fixed z-50 inset-0 overflow-y-auto transition-opacity duration-1000 ease-out" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">
                            
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    <div class="flex justify-between"> 
                                        <div class="text-gray-600">Update Profile </div>
                                        <svg @click="edit_profile = !edit_profile" class="w-6 h-6 cursor-pointer hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </div>
                                </h3>
                                <div class="mt-2">
                                    <form @submit.prevent="updateProfile" class="w-full my-8 space-y-6" action="#" method="POST">
                                        
                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="first_name" class="text-gray-600">First Name</breeze-label>
                                                <breeze-input type="text" v-model="edit_form.first_name"  class="w-full" />
                                            </div>                                            
                                        </div> 

                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="last_name" class="text-gray-600">Last Name</breeze-label>
                                                <breeze-input type="text" v-model="edit_form.last_name" class="w-full" />
                                            </div>                                            
                                        </div> 

                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="email" class="text-gray-600">Email Address</breeze-label>
                                                <breeze-input type="text" v-model="edit_form.email" class="w-full" />
                                            </div>                                            
                                        </div>

                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="organization_name" class="text-gray-600">Organisation Name</breeze-label>
                                                <breeze-input type="text" v-model="edit_form.organization_name" class="w-full" />
                                            </div>                                            
                                        </div> 

                                        <div class="rounded-md shadow-sm">
                                            <div class="mt-5">
                                                <breeze-label for="organization_location" class="text-gray-600">Organisation Location</breeze-label>
                                                <breeze-input type="text" v-model="edit_form.organization_location" class="w-full" />
                                            </div>                                            
                                        </div>                                                   

                                        <div>
                                            <breeze-button @click="edit_profile=true">Update Profile</breeze-button>
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

    <layout>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Personal Information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Registration Information
                    </p>
                </div>

                <div>
                    <edit-button 
                    @click="edit_form.first_name=user.first_name,
                    edit_form.last_name=user.last_name,
                    edit_form.email = user.email,
                    edit_form.organization_name = user.organization_name,
                    edit_form.organization_location = user.organization_location,
                    edit_profile=true">Edit Profile</edit-button>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Full name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ user.first_name }} {{ user.last_name }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Email
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ user.email }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Organization Name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ user.organization_name }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Organization Location
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ user.organization_location }}
                        </dd>
                    </div> 
                </dl>
            </div>
        </div>


        <div class="bg-white shadow overflow-hidden sm:rounded-lg my-8">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Account Setting
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Change Password
                </p>
            </div>

            <div class="border mb-8"></div>

            <div class="flex w-1/2 mx-auto" >
                <form @submit.prevent="changePassword" class="pb-8">
                    <div>
                        <breeze-label for="current_password" value="Current Password" />
                        <breeze-input id="current_password" type="password" class="mt-1 block w-full" v-model="form.current_password" required />
                    </div>

                    <div class="mt-5">
                        <breeze-label for="new_password" value="New Password" />
                        <breeze-input id="new_password" type="password" class="mt-1 block w-full" v-model="form.new_password" required />
                    </div>

                    <div class="mt-4">
                        <breeze-label for="confirm_password" value="Confirm New Password" />
                        <breeze-input id="confirm_password" type="password" class="mt-1 block w-full" v-model="form.confirm_password" required />
                    </div>                    

                    <div class="mt-6">
                        <breeze-button class="w-full" type="submit">
                            Update Password
                        </breeze-button>
                    </div>
                </form> 
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button'
import EditButton from '@/Components/ButtonEdit'
import BreezeInput from '@/Components/Input'
import BreezeLabel from '@/Components/Label'

export default {
    components: {
        Layout,
        BreezeInput,
        BreezeButton,
        BreezeLabel,
        EditButton
    },
    props: {
        user: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                current_password: '',
                new_password: '',
                confirm_password: '',
            }),
            edit_form: this.$inertia.form({
                first_name: '',
                last_name: '',
                email: '',
                organization_name: '',
                organization_location: '',
            }),
            edit_profile: false
        }
    },
    
    methods: {
        changePassword() {
            this.$inertia.post('/update-password', this.form);
        },
        updateProfile() {
            this.$inertia.post('/update-profile', this.edit_form);
            this.edit_profile = false
        }
    },
}
</script>