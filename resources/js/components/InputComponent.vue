<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <p>Check the sentences you want to draw.</p>
            </div>
            <!-- <div v-if="formErrors" class="col-md-4">
                <div class="col-md-4" v-for="(error, index) in errors.all" :key="index">
                    {{ error }}
                </div>
            </div> -->
        </div>
        <div class="row justify-content-center">
            
            <!-- <form @submit.prevent="submitForm"> -->
            <!-- <form action="/make-disp" method="post" @submit="submitForm"> -->           
            <!-- <form action="/make-disp" method="post"> -->

                <form action="/make-disp" method="post" @submit.prevent="submitForm">

                <input type="hidden" name="_token" :value="csrf">
                <div class="row justify-content-center my-2">
                    <div class="row align-items-center my-1" v-for="(inptLineCnt, index) in inputLineCount" :key="index">

                        <!-- <input class="col-md-2 form-check form-check-input" type="checkbox" name="checkboxes[]" :value=inptLineCnt placeholder=""> -->
                        <input class="col-md-2 form-check form-check-input" type="checkbox" v-model="checkboxes[index]"
                            :value=inptLineCnt placeholder="">
                        <div class="col-md-10">
                            <!-- <input class="form-control" type="text" name="texts[]" placeholder=""> -->
                            <input class="form-control" type="text" v-model='texts[index]' placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center my-2">
                    <div class="col-auto">
                        <input class="btn btn-primary" type="submit" value="Make Picture" :disabled="isLoading">
                    </div>
                </div>
                <div v-if="isLoading">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</template>

<script>
// import { router } from '@/router'; // routerをインポートする

export default {
    props: {
        inputLineCount: Array
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            checkboxes: [],
            texts: [],
            isLoading: false,
        };
    },
    mounted() {
        console.log('Component mounted.')
    },
}
</script>