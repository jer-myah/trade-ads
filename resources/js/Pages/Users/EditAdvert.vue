<template>
    <div>
        <validation-errors></validation-errors>

        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer p-5 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-0 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <Layout>
            <!-- <div class="w-full border-b"></div> -->

            <!--  -->
            <div class="flex flex-col py-8">
                
                <div class="w-10/12 mx-auto pb-8 pt-5 bg-gray-200 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="w-4/5 mx-auto py-5">
                        <Label class="uppercase font-bold font-sans text-xl text-gray-100" value="Update Advert" />
                    </div>

                    <div class="my-5 border-b border-gray-300"></div>

                    <form @submit.prevent="submit" class="w-3/5 mx-auto py-5">

                        <div class="mt-4">
                            <Label for="plan" value="Plan" />
                            <Input disabled :value="plan.name" type="text" class="mt-1 block w-full" />
                        </div>
                    
                        <div class="mt-4">
                            <Label for="plan" value="Category" />
                            <Input disabled :value="category.name" type="text" class="mt-1 block w-full" />
                        </div>

                        <div class="mt-4">
                            <Label for="title" value="Advert Title" />
                            <Input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autocomplete="title" />
                        </div>

                        <div class="mt-4">
                            <Label for="description" value="Description" />
                            <textarea id="description" class="w-full border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm py-3" v-model="form.description" required autocomplete="description"></textarea>
                        </div>

                        <div class="mt-5">
                            <Label for="image" value="Image" />
                            <Input id="image" type="file" @input="form.image = $event.target.files[0]" class="mt-1 block w-full" required />
                        </div>

                        <div class="mt-5">
                            <Label for="video" value="Optional Video" />
                            <!-- <Input id="video" type="file" @input="form.video = $event.target.files[0]" class="mt-1 block w-full" v-bind="form.video" /> -->
                            <Input id="video" type="file" @input="form.video = $event.target.files[0]" class="mt-1 block w-full" accept="video/.mpeg" />
                        </div>

                        <div class="mt-4">
                            <Label for="phone" value="Contact Phone Number" />
                            <Input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autocomplete="phone" />
                        </div> 

                        <div class="my-8"></div>

                        <div class="flex items-center justify-center mt-4">                            
                            <Button class="w-full focus:outline-none" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <span class="w-11/12 mx-auto">Update Advert</span>
                            </Button>
                        </div>
                    </form>
                </div>
            </div>

        </Layout>
    </div>
</template>

<script>
import Layout from '@/Layouts/Authenticated'
import Button from '@/Components/Button'
import Input from '@/Components/Input'
import Label from '@/Components/Label'
import ValidationErrors from '@/Components/ValidationErrors'

export default {
    components: {
        Layout,
        Button,
        Input,
        Label,
        ValidationErrors,
    },

    props: {
        advert: Object,
        category: Object,
        plan: Object
    },

    data() {
        return {
            show_form: false,
            toast: true,
            form: this.$inertia.form({
                selected: '',
                package_id: '',
                package_name: '',
                category: '',
                title: this.advert.title,
                description: this.advert.description,
                phone: this.advert.phone,
                image: '',
                video: '',
            }),

        }
    },
    methods: {
        
        submit() {
            this.$inertia.post('/user/update-advert', this.form);
        }
    }
}
</script>
