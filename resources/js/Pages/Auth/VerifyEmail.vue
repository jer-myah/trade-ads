<template>
    <bg-img class="">
        <div class="w-11/12 mx-auto sm:w-2/3 md:w-1/2 pt-16">
            <div class="bg-gray-50 p-8 rounded-md shadow-md">
                <div class="mb-4 text-sm text-gray-600">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </div>

                <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
                    A new verification link has been sent to the email address you provided during registration.
                </div>

                <form @submit.prevent="submit">
                    <div class="mt-4 flex items-center justify-between">
                        <breeze-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Resend Verification Email
                        </breeze-button>

                        <inertia-link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Log Out</inertia-link>
                    </div>
                </form>
            </div>
        </div>
    </bg-img>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from "@/Layouts/Guest"
    import BgImg from '@/Components/Background'

    export default {
        layout: BreezeGuestLayout,

        components: {
            BreezeButton,
            BgImg
        },

        props: {
            auth: Object,
            errors: Object,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form()
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('verification.send'))
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    }
</script>
