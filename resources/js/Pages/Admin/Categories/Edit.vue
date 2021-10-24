<template>
    <div>
        <validation-errors />
        <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.success }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>
        <Layout>
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col py-8">
                
                <div class="w-10/12 mx-auto pb-8 pt-5 bg-gray-200 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="w-4/5 mx-auto py-5">
                        <Label class="uppercase font-bold font-sans text-xl text-gray-100" value="Edit Category" />
                    </div>

                    <div class="my-5 border-b border-gray-300"></div>

                    <form @submit.prevent="submit" class="w-3/5 mx-auto py-5">
                        <div>
                            <Label for="name" value="Package Name" />
                            <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <Label for="description" value="Description" />
                            <Input id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autocomplete="description" />
                        </div>

                        <div class="mt-4">
                            <Label for="status" value="Category Status" />
                            <div class="flex justify-around">
                                <div class="flex">
                                    <Label for="status" value="Yes" class="mx-3" />
                                    <Input id="status" type="radio" name="status" :checked="category.status==1" class="mt-1 px-3" v-model="form.status" />
                                </div>
                                <div class="flex">
                                    <Label for="status" value="No" class="mx-3" />
                                    <Input id="status" type="radio" name="status" :checked="category.status==0" class="mt-1 px-3" v-model="form.status" />
                                </div>
                            </div>
                        </div>

                        <div class="my-8"></div>

                        <div class="flex items-center justify-end mt-4">                            
                            <Button class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Update Category
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

    props: {
        category: Object
    },

    data() {
        return {
            toast: true,
            form: this.$inertia.form({
                name: this.category.name,
                description: this.category.description,
                status: this.category.status
            })
        }
    },

    methods: {
        submit() {
            this.$inertia.post('/admin/update-category/' + this.category.id, this.form);
        }
    }
}
</script>
