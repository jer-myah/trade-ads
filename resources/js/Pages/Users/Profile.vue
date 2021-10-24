<template>
    <validation-errors></validation-errors>
    <Layout>
        <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.success }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <div class="my-8">
            <form @submit.prevent="updateAvatar">
                <Input type="file" @input="form.avatar = $event.target.files[0]" class="mr-4" required />
                <breeze-button>Update Profile Image</breeze-button>
            </form>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Personal Information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Detail Information for user 
                    </p>
                </div>

                <div>
                    <edit-button >Edit </edit-button>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Full Name
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
                            Referral
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span v-if="user.referral != null"> {{ user.referral.ref_code }} </span>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Joined Since
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ moment(user.created_at).format("DD, MMM YYYY") }}
                        </dd>
                    </div> 
                </dl>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-8">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Settings
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Change Account Password
                    </p>
                </div>

                <div>
                    <!-- <edit-button >Edit </edit-button> -->
                </div>
            </div>
            <form @submit.prevent="changePassword()" class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Old Password
                        </dt>
                        <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
                            <Input v-model="password_form.old_password" type="password" required></Input>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            New Password
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <Input v-model="password_form.password" type="password" required></Input>
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Confirm New Password
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <Input v-model="password_form.password_confirmation" type="password" required></Input>
                            <InputError :message="password_mismatch"></InputError>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <breeze-button>Update Password</breeze-button>
                        </dd>
                    </div> 
                </dl>
            </form>
        </div>

    </Layout>
</template>

<script>
import Layout from '@/Layouts/Authenticated';
import moment from 'moment';
import Input from '@/Components/Input';
import BreezeButton from '@/Components/Button';
import ValidationErrors from '@/Components/ValidationErrors';
import InputError from '@/Components/InputError';

export default {
    layout: Layout,
    components: {
        Input,
        BreezeButton,
        ValidationErrors,
        InputError
    },
    data() {
        return {
            toast: true,
            password_mismatch: '',
            moment: moment,
            form: this.$inertia.form({
                avatar: ''
            }),
            password_form: this.$inertia.form({
                old_password: '',
                password: '',
                password_confirmation: ''
            })
        }
    },
    setup() {
        
    },
    props: {
        available_links: Object,
        user: Object,
    },
    methods: {
        updateAvatar(){
            this.$inertia.post('/update-avatar', this.form, {
                onFinish: () => this.form.reset(),
            })
        },
        changePassword(){
            if(this.password_form.password === this.password_form.password_confirmation){
                this.$inertia.post('/update-password', this.password_form, {
                    onFinish: () => this.form.reset('old_password', 'password', 'password_confirmation'),
                })
            }else{
                this.password_mismatch = 'Password Missmatch!';
            }
        }
    }
}
</script>