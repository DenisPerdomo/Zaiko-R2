<template>
<div>

    <Head title="Create New Register" />


    <h1 class="text-3xl text-center font-bold">Create a New Register</h1>


    <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">

    <div class="mb-6">

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" >
                    Sites
                </label>
                <div class="mb-3 xl:w-96">
                    
                    <select v-model="selectedsite" @change="getUbications()" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                        <option v-for="site in sites" :value="site.id" :key="site.id">{{site.name}}</option>
                    </select>
                </div>

                <div v-if="form.errors.site" v-text="form.errors.site" class="text-red-500 text-xs italic mt-2"></div>

            </div>

            <div class="mb-6">

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" >
                    Ubication
                </label>
                <div class="mb-3 xl:w-96">
                    
                    <select v-model="form.ubication"  class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                        <option v-for="ubication in ubications" :value="ubication.id" :key="ubication.id">{{ubication.name}}</option>
                    </select>
                </div>

                <div v-if="form.errors.ubication" v-text="form.errors.ubication" class="text-red-500 text-xs italic mt-2"></div>

            </div>

            <div class="mb-6">

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" >
                    Department
                </label>
                <div class="mb-3 xl:w-96">
                    
                    <select v-model="form.department" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                        <option v-for="department in departments" :value="department.id" :key="department.id">{{department.name}}</option>
                    </select>
                </div>

                <div v-if="form.errors.department" v-text="form.errors.department" class="text-red-500 text-xs italic mt-2"></div>

            </div>
  
            <div class="mb-6">

                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" >                        
                        User
                    </label>

                    <div class="mb-3 xl:w-96">
                    <input v-model="form.user" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="text" name="user">
                    </div>

                    <div v-if="form.errors.user" v-text="form.errors.user" class="text-red-500 text-xs italic mt-2"></div>
                
            </div>

            <div class="mb-6">

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" >
                    Comment(Optional)
                </label>

                
                <div class="mb-3 xl:w-96">
                <input v-model="form.comment" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="textarea" name="comment">
                <div v-if="form.errors.comment" v-text="form.errors.comment" class="text-red-500 text-xs italic mt-2"></div>
                </div>
            </div>

            <div class="mb-6">

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" >
                    Modification Date (Optional)
                </label>


                <div class="mb-3 xl:w-96">
                <input v-model="form.modification_date" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="date" name="modificationdate">
                <div v-if="form.errors.modification_date" v-text="form.errors.modification_date" class="text-red-500 text-xs italic mt-2"></div>

                </div>
            </div>

             <div class="mb-6">

                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 text-center" :disabled="form.processing">Create Register</button>

        </div>
    </form>

</div>
</template>


<script setup>

    import axios from 'axios';
    import { useForm } from '@inertiajs/inertia-vue3';
    import {ref, onMounted } from 'vue';


    const sites = ref([]);
    const ubications = ref([]);
    const selectedsite= ref(1);

    const getSites = async () => {

        await axios.get('/api/sites').then(response => {
            sites.value = response.data;
        });

    };

    const getUbications = async () => {

        await axios.get(`/api/ubications/${selectedsite.value}`).then(response => {
            ubications.value = response.data;
        });
    
    };

     const props = defineProps({

        errors: Object,
        departments: Object,
        id: String,
    });


    let form = useForm({

        user:'',
        comment:'',
        modification_date:'',
        site:selectedsite,
        department:'',
        ubication:'',
    
    })

    
     let submit = () => {

        form.post(`/register/create/${props.id}`);

    }

    onMounted(() => {
        getSites();
        getUbications();
    });





</script>
        