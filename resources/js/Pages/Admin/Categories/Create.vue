<template>
    <div>
        <Layout>

            <validation-errors />
            <!-- This example requires Tailwind CSS v2.0+ -->
            <!-- <div class="mb-8 border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">                            
                            <p class="ml-3 font-medium text-gray-700 truncate">
                                Create Category
                            </p>
                        </div>
                        <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                            <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-green-600 bg-white hover:bg-green-50">
                            New Category
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col py-8">
                
                <div class="w-10/12 mx-auto pb-8 pt-5 bg-gray-200 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="w-4/5 mx-auto py-5">
                        <Label class="uppercase font-bold font-sans text-xl text-gray-100" value="Create Category" />
                    </div>

                    <div class="my-5 border-b border-gray-300"></div>

                    <form @submit.prevent="submit" class="w-3/5 mx-auto py-5">
                        <div>
                            <Label for="name" value="Category Name" />
                            <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <Label for="description" value="Description" />
                            <Input id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autocomplete="description" />
                        </div>

                        <div class="my-8"></div>

                        <div class="flex items-center justify-end mt-4">                            
                            <Button class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create Category
                            </Button>
                        </div>
                    </form>
                </div>
            </div>

        </Layout>
    </div>
</template>

<script>
import Layout from '@/Layouts/AdminLayout'
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
        ValidationErrors
    },

    data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    description: ''
                })
            }
        },

        methods: {
            submit() {
                this.$inertia.post('/admin/store-category', this.form);
            }
        }
}
</script>
