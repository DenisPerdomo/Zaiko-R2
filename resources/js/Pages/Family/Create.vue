<template>
<div>

    <Head title="Create Family" />


    <h1 class="text-3xl text-center font-bold">Create a New Family</h1>


    <form @submit.prevent="submit" action="/" class="max-w-md mx-auto mt-8">
        
        
            <div class="mb-6">


                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">
                    Name
                </label>


                <input v-model="form.name" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="text" name="name" id="name" autofocus> 

                <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs italic mt-2"></div>

            </div>

             <div class="mb-6">


                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">
                    Device
                </label>
               
                    <select v-model="form.device" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                        <option>PCS</option>
                        <option>Monitors</option>
                        <option>PDA</option>
                        <option>Phones</option>
                        <option>Network Devices</option>
                        <option>Printers</option>
                        <option>Other</option>
                    </select>

                <div v-if="form.errors.device" v-text="form.errors.device" class="text-red-500 text-xs italic mt-2"></div>

            </div>





              <div class="mb-6">

                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing" >Create</button>


            </div>
    </form>

</div>
    

</template>


<script setup>

import { useForm} from "@inertiajs/inertia-vue3";


defineProps({

    errors: Object

});

let form = useForm({
    name: '',
    device:''
});


let submit = () => {

    form.post('/family/create');
};



</script>
